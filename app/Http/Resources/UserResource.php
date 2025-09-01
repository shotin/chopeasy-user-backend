<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'         => $this->id,
            'username'   => $this->username,
            'email'      => $this->email,
            'firstname'  => $this->firstname,
            'lastname'   => $this->lastname,
            'avatar'     => $this->avatar,
            'status'     => $this->status,
            'role'       => $this->roles->pluck('name')->first(),
            'permissions' => $this->roles->flatMap->permissions->pluck('name')->unique(),
            'middlename'        => $this->middlename,
            'guardianname'      => $this->guardianname,
            'phoneno'           => $this->phoneno,
            'address'           => $this->address,
            'lga'               => $this->lga,
            'state'             => $this->state,
            'country'           => $this->country,
            'email'             => $this->email,
            'gender'            => $this->gender,
            'image'             => $this->image,
            'cover_photo'       => $this->cover_photo,
            'date_of_birth'     => $this->date_of_birth,
            'last_login'        => $this->last_login,
            'email_verified_at' => $this->email_verified_at,
            'fcm_token'         => $this->fcm_token,
            'ip_address'        => $this->ip_address,
            'continent'         => $this->continent,
            'is_verified'       => $this->is_verified,
            'is_active'         => $this->is_active,
            'is_default'        => $this->is_default,
            'can_login'         => $this->can_login,
            'two_fa'            => $this->two_fa,
            'deleted_at'        => $this->deleted_at,
            'created_at'        => $this->created_at,
            'updated_at'        => $this->updated_at,
              'shipping_addresses' => $this->shippingAddresses->map(function ($address) {
                return [
                    'id' => $address->id,
                    'first_name' => $address->first_name,
                    'last_name' => $address->last_name,
                    'phone_number' => $address->phone_number,
                    'email' => $address->email,
                    'company' => $address->company,
                    'address_line_1' => $address->address_line_1,
                    'address_line_2' => $address->address_line_2,
                    'city' => $address->city,
                    'state' => $address->state,
                    'country' => $address->country,
                    'postal_code' => $address->postal_code,
                    'is_default' => (bool) $address->is_default,
                ];
            }),
        ];
    }
}
