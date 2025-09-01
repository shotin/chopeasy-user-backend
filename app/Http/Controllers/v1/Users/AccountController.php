<?php

namespace App\Http\Controllers\v1\Users;

use App\Http\Controllers\Controller;
use App\Http\Resources\ShippingAddressResource;
use App\Models\ShippingAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Cookie as SymfonyCookie;

class AccountController extends Controller
{
    protected function getSessionId(Request $request, &$cookie = null): ?string
    {
        $existing = $request->cookie('cart_session_id');

        if ($existing) {
            return $existing;
        }

        $sessionId = Str::uuid()->toString();
        $secure = app()->environment('production') || (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on');
        $sameSite = $secure ? 'None' : 'Lax';

        $cookie = new SymfonyCookie(
            'cart_session_id',
            $sessionId,
            now()->addYear(),
            '/',
            null,
            $secure,
            false,
            false,
            $sameSite
        );

        return $sessionId;
    }

    public function addShippingAddress(Request $request)
    {
        Auth::shouldUse('api');
        $userId = Auth::check() ? Auth::id() : null;
        $sessionId = $userId ? null : $this->getSessionId($request);

        $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'phone_number' => 'required|string',
            'address_line_1' => 'required|string',
            'address_line_2' => 'nullable|string',
            'city' => 'nullable|string',
            'state' => 'nullable|string',
            'country' => 'required|string',
            'email' => 'required|string|email|unique:shipping_addresses,email',
            'postal_code' => 'required|string',
        ]);

        $isDefault = ShippingAddress::where($userId ? ['user_id' => $userId] : ['session_id' => $sessionId])->exists() ? false : true;

        $address = ShippingAddress::create([
            'user_id' => $userId,
            'session_id' => $sessionId,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone_number' => $request->phone_number,
            'address_line_1' => $request->address_line_1,
            'address_line_2' => $request->address_line_2,
            'city' => $request->city,
            'state' => $request->state,
            'country' => $request->country,
            'email' => $request->email,
            'postal_code' => $request->postal_code,
            'is_default' => $request->is_default ?? $isDefault,
        ]);

        if ($address->is_default) {
            ShippingAddress::where(function ($q) use ($userId, $sessionId) {
                $userId ? $q->where('user_id', $userId) : $q->where('session_id', $sessionId);
            })->where('id', '!=', $address->id)->update(['is_default' => false]);
        }

        return response()->json(['message' => 'Address added', 'address' => $address], 201);
    }

    public function updateShippingAddress(Request $request, $id)
    {
        Auth::shouldUse('api');

        $userId = Auth::check() ? Auth::id() : null;
        $sessionId = $userId ? null : $this->getSessionId($request);

        $address = ShippingAddress::where(function ($q) use ($userId, $sessionId) {
            if ($userId) {
                $q->where('user_id', $userId);
            } else {
                $q->where('session_id', $sessionId);
            }
        })->where('id', $id)->first();

        if (!$address) {
            return response()->json(['error' => 'Shipping address not found.'], 404);
        }


        $validated = $request->validate([
            'first_name' => 'sometimes|string',
            'last_name' => 'sometimes|string',
            'phone_number' => 'sometimes|string',
            'address_line_1' => 'sometimes|string',
            'address_line_2' => 'sometimes|string',
            'city' => 'sometimes|string',
            'state' => 'sometimes|string',
            'country' => 'sometimes|string',
            'email' => 'sometimes|string|email|unique:shipping_addresses,email,' . $address->id,
            'postal_code' => 'sometimes|string',
        ]);

        $address->update(array_merge($validated, [
            'is_default' => $request->is_default ?? $address->is_default,
        ]));

        if ($address->is_default) {
            ShippingAddress::where(function ($q) use ($userId, $sessionId) {
                if ($userId) {
                    $q->where('user_id', $userId);
                } else {
                    $q->where('session_id', $sessionId);
                }
            })->where('id', '!=', $id)->update(['is_default' => false]);
        }

        return response()->json(['message' => 'Address updated', 'address' => $address]);
    }


    public function deleteShippingAddress(Request $request, $id)
    {
        Auth::shouldUse('api');
        $userId = Auth::check() ? Auth::id() : null;
        $sessionId = $userId ? null : $this->getSessionId($request);

        $address = ShippingAddress::where(function ($q) use ($userId, $sessionId) {
            $userId ? $q->where('user_id', $userId) : $q->where('session_id', $sessionId);
        })->findOrFail($id);

        if ($address->is_default) {
            $anotherAddress = ShippingAddress::where(function ($q) use ($userId, $sessionId) {
                $userId ? $q->where('user_id', $userId) : $q->where('session_id', $sessionId);
            })->where('id', '!=', $id)->first();

            if ($anotherAddress) {
                $anotherAddress->update(['is_default' => true]);
            }
        }

        $address->delete();

        return response()->json(['message' => 'Address deleted']);
    }

    public function listShippingAddresses(Request $request)
    {
        Auth::shouldUse('api');
        $userId = Auth::check() ? Auth::id() : null;
        $sessionId = $userId ? null : $this->getSessionId($request);

        $addresses = ShippingAddress::with('user')
            ->where(function ($q) use ($userId, $sessionId) {
                $userId ? $q->where('user_id', $userId) : $q->where('session_id', $sessionId);
            })->get();

        return ShippingAddressResource::collection($addresses);
    }

    public function getShippingAddress($id)
    {
        Auth::shouldUse('api');

        $userId = Auth::check() ? Auth::id() : null;
        $sessionId = $userId ? null : $this->getSessionId(request());

        if (!$userId && !$sessionId) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $address = ShippingAddress::where(function ($q) use ($userId, $sessionId) {
            if ($userId) {
                $q->where('user_id', $userId);
            } else {
                $q->where('session_id', $sessionId);
            }
        })->where('id', $id)->first();

        if (!$address) {
            return response()->json(['error' => 'Shipping address not found.'], 404);
        }

        return new ShippingAddressResource($address);
    }
}
