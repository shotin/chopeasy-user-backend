<?php

namespace App\Services\User;

use App\Models\Cart;
use App\Models\Order;
use App\Models\User;
use App\Notifications\EmailOtpNotification;
use App\Repositories\User\UserInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use App\Notifications\VerifyEmail;
use App\Responser\JsonResponser;
use App\Services\GeoLocationService;
use App\Services\ProductReviewed\RecentlyViewedService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Log;

class UserService
{
    protected $userInterface;
    protected $geoLocationService;

    public function __construct(UserInterface $userInterface, GeoLocationService $geoLocationService)
    {
        $this->userInterface = $userInterface;
        $this->geoLocationService = $geoLocationService;
    }

    public function register(array $data): User
    {
        $otp = rand(1000, 9999);
        $data['email_otp'] = $otp;
        $data['otp_expires_at'] = Carbon::now()->addMinutes(10);

        $user = $this->userInterface->create($data);

        try {
            $user->notify(new EmailOtpNotification($user, $otp));
        } catch (\Throwable $e) {
            // Log::error('OTP Email Send Failed: ' . $e->getMessage(), [
            //     'user_id' => $user->id,
            //     'email' => $user->email,
            // ]);
        }

        $user->assignRole('Customer');

        return $user;
    }

    public function login(Request $request, array $credentials)
    {
        if (!$token = Auth::guard('api')->attempt($credentials)) {
            return response()->json([
                'error' => true,
                'message' => 'Invalid credentials',
                'status' => 401,
                'data' => null
            ], 401);
        }

        $userId = Auth::guard('api')->user()->id;
        $user = User::find($userId);
        $sessionId = $request->cookie('cart_session_id');

        if ($sessionId) {
            $this->mergeGuestSessionToUser($user, $sessionId);
            app(RecentlyViewedService::class)->mergeSessionViewsToUser($sessionId, $user->id);
        }
        $this->mergeGuestOrdersByEmail($user);
        $this->mergeGuestShippingAddressByEmail($user);
        if (!$user->is_verified || !$user->can_login) {
            return response()->json([
                'error' => true,
                'message' => 'Please verify your email before logging in.',
                'status' => 403,
                'data' => null
            ], 403);
        }

        $ip = request()->ip();
        $geoInfo = $this->geoLocationService->getGeoInfo($ip);

        $user->last_login = now();
        $user->ip_address = $ip;
        if (is_array($geoInfo)) {
            $user->continent = $geoInfo['continent_name'] ?? null;
            $user->country   = $geoInfo['country_name'] ?? null;
            $user->state     = $geoInfo['state_prov'] ?? null;
        }

        $user->save();

        $jsonResponse = JsonResponser::send(false, 'Login successful.', [
            'token' => $token,
            'user' => $user,
        ], 200);

        return $jsonResponse->withCookie(cookie()->forget('cart_session_id'));
    }


    public function verifyEmail(int $id, string $hash)
    {
        $user = $this->userInterface->find($id);
        if (!$user || !hash_equals($hash, sha1($user->email))) {
            return ['error' => 'Invalid verification link', 'status' => 400];
        }

        if ($user->is_verified) {
            return ['message' => 'Email already verified'];
        }

        $this->userInterface->markEmailAsVerified($id);
        return ['message' => 'Email verified'];
    }

    public function sendPasswordResetLink(string $email)
    {
        $status = Password::sendResetLink(['email' => $email]);

        if ($status === Password::RESET_LINK_SENT) {
            return [
                'error' => false,
                'message' => 'Password reset link sent successfully.',
                'status' => 200,
            ];
        }

        return [
            'error' => true,
            'message' => __($status),
            'status' => 400,
        ];
    }

    public function resendOtp(string $email)
    {
        $status = Password::sendResetLink(['email' => $email]);

        if ($status === Password::RESET_LINK_SENT) {
            return [
                'error' => false,
                'message' => 'Password reset link sent successfully.',
                'status' => 200,
            ];
        }

        return [
            'error' => true,
            'message' => __($status),
            'status' => 400,
        ];
    }


    public function resetPassword(array $data): array
    {
        $user = User::where('email', $data['email'])->first();

        if (!$user) {
            return [
                'error' => true,
                'message' => 'User not found.',
                'status' => 404,
            ];
        }

        if (
            $user->email_otp !== $data['token'] ||
            !$user->otp_expires_at ||
            now()->greaterThan($user->otp_expires_at)
        ) {
            return [
                'error' => true,
                'message' => 'Invalid or expired OTP.',
                'status' => 422,
            ];
        }

        // Reset password
        $user->password = bcrypt($data['password']);
        $user->email_otp = null;
        $user->otp_expires_at = null;
        $user->save();

        return [
            'error' => false,
            'message' => 'Password reset successful.',
            'status' => 200,
        ];
    }


    public function mergeGuestSessionToUser(User $user, string $sessionId)
    {
        $guestCartItems = Cart::where('session_id', $sessionId)->get();
        foreach ($guestCartItems as $guestItem) {
            $existingItem = Cart::where('user_id', $user->id)
                ->where('product_id', $guestItem->product_id)
                ->whereNull('product_variant_id')
                ->first();

            if ($existingItem) {
                $existingItem->quantity += $guestItem->quantity;
                $existingItem->save();
                $guestItem->delete();
            } else {
                $guestItem->update([
                    'user_id' => $user->id,
                    'session_id' => null,
                ]);
            }
        }

        Order::where('session_id', $sessionId)->update([
            'user_id' => $user->id,
            'session_id' => null,
        ]);

        Cookie::queue(Cookie::forget('cart_session_id'));
    }

    private function mergeGuestOrdersByEmail(User $user)
    {
        Order::whereNull('user_id')
            ->whereNotNull('session_id')
            ->where('shipping_address_snapshot->email', $user->email)
            ->update([
                'user_id' => $user->id,
                'session_id' => null,
            ]);
    }

    private function mergeGuestShippingAddressByEmail(User $user)
    {
        $guestAddress = \App\Models\ShippingAddress::whereNull('user_id')
            ->whereNotNull('session_id')
            ->where('email', $user->email)
            ->latest()
            ->first();

        if ($guestAddress) {
            $newAddress = $guestAddress->replicate();
            $newAddress->user_id = $user->id;
            $newAddress->session_id = null;
            $newAddress->is_default = true;
            $newAddress->save();
        }
    }
}
