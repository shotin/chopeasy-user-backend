<?php
// app/Services/SendcloudService.php
namespace App\Services;

use Illuminate\Support\Facades\Http;

class SendcloudService
{
    protected $url;
    protected $public;
    protected $secret;

    public function __construct()
    {
        $this->url = config('services.sendcloud.url');
        $this->public = config('services.sendcloud.public');
        $this->secret = config('services.sendcloud.secret');
    }

    public function createParcel(array $data)
    {
        $response = Http::withBasicAuth($this->public, $this->secret)
            ->post($this->url . 'parcels', [
                'parcel' => [
                    'name' => $data['name'],
                    'company_name' => $data['company_name'] ?? '',
                    'address' => $data['address'],
                    'house_number' => $data['house_number'], 
                    'city' => $data['city'],
                    'postal_code' => $data['postal_code'],
                    'country' => $data['country'],
                    'email' => $data['email'],
                    'telephone' => $data['phone'],
                    'weight' => $data['weight'] ?? 1000,
                    'shipping_method' => $data['shipping_method'],
                ]
            ]);

        return $response->json();
    }


    public function getShippingMethods()
    {
        try {
            $response = Http::withBasicAuth($this->public, $this->secret)
                ->get($this->url . 'shipping_methods');

            return $response->json()['shipping_methods'] ?? [];
        } catch (\Throwable $e) {

            return [];
        }
    }
}
