<?php

namespace App\Http\Controllers\v1\Auth;

use App\Helpers\GeneralHelper;
use App\Http\Controllers\Controller;
use App\Services\User\UserService;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\UserResource;
use App\Models\Cart;
use App\Models\Order;
use App\Models\User;
use App\Notifications\EmailOtpNotification;
use App\Responser\JsonResponser;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function register(RegisterRequest $request)
    {
        DB::beginTransaction();
        try {
            $user = $this->userService->register($request->validated());
            $dataToLog = [
                'causer_id' => $user->id,
                'action_id' => $user->id,
                'action_type' => "App\Models\User",
                'log_name' => "User registered successfully and email sent for verification",
                'description' => "{$user['firstname']} {$user['lastname']} added successfully",
            ];

            GeneralHelper::storeAuditLog($dataToLog);
            DB::commit();
            return JsonResponser::send(
                false,
                'Registration successful. Please check your email to confirm your account.',
                $user,
                201
            );
        } catch (Exception $e) {
            // Log::info($e);
            DB::rollBack();
            return JsonResponser::send(true, "An error occurred during registration. Please try again later" . $e->getMessage(), [], 500);
        }
    }

    public function login(LoginRequest $request)
    {
        try {
            return $this->userService->login($request, $request->only('email', 'password'));
        } catch (Exception $e) {
            return JsonResponser::send(
                true,
                'An error occurred during login. Please try again later.',
                null,
                500
            );
        }
    }

    public function logout(Request $request)
    {
        try {
            $request->user()->currentAccessToken()->delete();

            return JsonResponser::send(
                false,
                'Successfully logged out',
                null,
                200
            );
        } catch (\Exception $e) {
            return JsonResponser::send(
                true,
                'Failed to logout. Please try again.',
                null,
                500
            );
        }
    }

    public function getUser(Request $request)
    {
        try {
            $user = $request->user();

            if (!$user) {
                return JsonResponser::send(
                    true,
                    'No authenticated user found',
                    null,
                    401
                );
            }

            return JsonResponser::send(
                false,
                'Authenticated user retrieved successfully.',
                $user, // ✅ return raw user model
                200
            );
        } catch (\Exception $e) {
            return JsonResponser::send(
                true,
                'An error occurred while fetching user details.',
                null,
                500
            );
        }
    }


    public function update(Request $request)
    {
        $request->validate([
            'firstname' => 'nullable|string',
            'lastname' => 'nullable|string',
            'email' => 'nullable|email|unique:users,email,' . Auth::id(),
        ]);

        $user = Auth::user();
        $user->update($request->only(['firstname', 'lastname', 'email']));

        return response()->json(['message' => 'User updated', 'user' => new UserResource($user)]);
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp' => 'required|digits:4',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return JsonResponser::send(true, 'Invalid email address.', null, 404);
        }

        if ($user->email_otp !== $request->otp) {
            return JsonResponser::send(true, 'Invalid OTP provided.', null, 422);
        }

        if ($user->otp_expires_at === null || now()->greaterThan($user->otp_expires_at)) {
            return JsonResponser::send(true, 'OTP has expired. Please request a new one.', null, 422);
        }

        $user->update([
            'is_verified' => true,
            'can_login' => true,
            'email_verified_at' => now(),
            'email_otp' => null,
            'otp_expires_at' => null,
        ]);

        return JsonResponser::send(false, 'Email verified successfully.', [
            'user' => ['email' => $user->email],
        ]);
    }


    public function resendOtp(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return JsonResponser::send(true, 'User not found', null, 404);
        }

        $otp = rand(100000, 999999);

        $user->update([
            'email_otp' => $otp,
            'otp_expires_at' => Carbon::now()->addMinutes(10),
        ]);

        $user->notify(new EmailOtpNotification($user, $otp));

        return JsonResponser::send(false, 'OTP resent successfully.');
    }

    public function getAllUsersForAdmin(Request $request)
    {
        $perPage = $request->query('per_page', 10);
        $search = $request->query('search');
        $status = $request->query('status');
        $isActive = $request->query('is_active');
        $minOrders = $request->query('min_orders');
        $maxOrders = $request->query('max_orders');

        $usersQuery = User::query()
            ->withCount('orders')
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('firstname', 'like', "%$search%")
                        ->orWhere('lastname', 'like', "%$search%")
                        ->orWhere('email', 'like', "%$search%");
                });
            })
            ->when($status, function ($query, $status) {
                if ($status === 'verified') {
                    $query->where('is_verified', true);
                } elseif ($status === 'unverified') {
                    $query->where('is_verified', false);
                }
            })
            ->when($isActive !== null, fn($q) => $q->where('is_active', $isActive))
            ->when($minOrders, fn($q) => $q->having('orders_count', '>=', $minOrders))
            ->when($maxOrders, fn($q) => $q->having('orders_count', '<=', $maxOrders))
            ->orderByDesc('created_at');

        $users = $usersQuery->paginate($perPage);

        $formatted = $users->map(function ($user) {
            return [
                'id' => $user->id,
                'name' => $user->firstname . ' ' . $user->lastname,
                'email' => $user->email,
                'orders_count' => $user->orders_count,
                'is_verified' => $user->is_verified ? 'Verified' : 'Unverified',
                'is_active' => $user->is_active ? 'Active' : 'Inactive',
            ];
        });

        return response()->json([
            'data' => $formatted,
            'pagination' => [
                'currentPage' => $users->currentPage(),
                'lastPage' => $users->lastPage(),
                'perPage' => $users->perPage(),
                'total' => $users->total(),
            ],
        ]);
    }

    public function getSingleUserForAdmin($id)
    {
        try {
            $user = User::with([
                'orders' => fn($q) => $q->latest(),
                'shippingAddresses',
            ])->withCount('orders')->findOrFail($id);

            $totalSpent = $user->orders->sum('total_amount');
            $avgOrderValue = $user->orders->avg('total_amount');
            $lastOrder = $user->orders->first();
            $lastOrderDate = optional($lastOrder)->created_at;
            // $customerId = '' . str_pad($user->id, 4, '0', STR_PAD_LEFT);

            return response()->json([
                'customer' => [
                    // 'id' => $user->id,
                    'customer_id' => $user->id,
                    'full_name' => $user->firstname . ' ' . $user->lastname,
                    'email' => $user->email,
                    'phone' => $user->phone_number,
                    'verified' => $user->is_verified ? 'Verified' : 'Unverified',
                    'joined_at' => $user->created_at->format('F d, Y'),
                    'note' => $user->note ?? "No notes available.",
                ],
                'metrics' => [
                    'total_orders' => $user->orders_count,
                    'total_spent' => $totalSpent,
                    'avg_order_value' => round($avgOrderValue, 2),
                    'last_order_date' => $lastOrderDate?->format('M d, Y'),
                    'last_order_days_ago' => $lastOrderDate ? $lastOrderDate->diffForHumans() : null,
                ],
                'orders' => $user->orders->map(function ($order) {
                    return [
                        'id'   => $order->id,
                        'order_id' => $order->order_number,
                        'date' => $order->created_at->format('M d, Y'),
                        'amount' => $order->total_amount,
                        'status' => $order->status,
                    ];
                }),
                'address' => optional($user->shippingAddresses->first(), function ($addr) {
                    return [
                        'company' => $addr->business_name ?? 'N/A',
                        'line1' => $addr->address_line_1,
                        'line2' => $addr->address_line_2,
                        'city' => $addr->city,
                        'state' => $addr->state,
                        'country' => $addr->country,
                    ];
                }),
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'error' => true,
                'message' => "User not found",
            ], 404);
        }
    }
}
