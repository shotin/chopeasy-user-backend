<?php

namespace App\Http\Controllers\v1\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PostalCodeController extends Controller
{
    /**
     * Validate full address via Postcodes.io
     */
    public function validateFullAddress(Request $request)
    {
        $request->validate([
            'postcode' => 'required|string',
            'city' => 'required|string',
            'street' => 'nullable|string',
        ]);

        $postcode = $request->postcode;
        $city = strtolower(trim($request->city));
        $street = $request->street ? strtolower(trim($request->street)) : null;

        // Lookup postcode details
        $response = Http::get("https://api.postcodes.io/postcodes/{$postcode}");

        if ($response->failed()) {
            return response()->json([
                'success' => false,
                'message' => 'Error validating postcode'
            ], 500);
        }

        $result = $response->json();

        if (!isset($result['result'])) {
            return response()->json([
                'success' => false,
                'valid' => false,
                'message' => 'Invalid postcode'
            ]);
        }

        $postcodeData = $result['result'];

        // Validate city/town
        $cityMatch = strtolower($postcodeData['admin_district']) === $city
            || strtolower($postcodeData['parish']) === $city
            || strtolower($postcodeData['region']) === $city;


        $streetMatch = true;
        if ($street) {
            $parliamentaryCode = $postcodeData['codes']['parliamentary'] ?? '';
            $streetMatch = str_contains(strtolower($parliamentaryCode), $street)
                || str_contains(strtolower($postcodeData['admin_district'] ?? ''), $street);
        }


        return response()->json([
            'success' => true,
            'valid' => $cityMatch && $streetMatch,
            'postcodeData' => $postcodeData,
        ]);
    }

    public function suggestAddress(Request $request)
    {
        $request->validate([
            'query' => 'required|string|min:2',
        ]);

        $query = $request->query('query');
        $googleApiKey = config('services.google_maps.api_key');

        // Try Google Places Autocomplete API first (same as Glovo uses)
        if ($googleApiKey) {
            try {
                $response = Http::get('https://maps.googleapis.com/maps/api/place/autocomplete/json', [
                    'input' => $query,
                    'key' => $googleApiKey,
                    'components' => 'country:ng', // Restrict to Nigeria
                    'types' => 'address', // Focus on addresses
                ]);

                if ($response->successful()) {
                    $data = $response->json();
                    
                    if (isset($data['predictions']) && !empty($data['predictions'])) {
                        // Filter predictions to Lagos addresses first (cheaper than fetching details for all)
                        $lagosPredictions = collect($data['predictions'])->filter(function ($prediction) {
                            $description = strtolower($prediction['description'] ?? '');
                            $terms = collect($prediction['terms'] ?? [])->pluck('value')->implode(' ');
                            $allText = strtolower($description . ' ' . $terms);
                            return strpos($allText, 'lagos') !== false;
                        })->take(10); // Limit to 10 to reduce API calls

                        $suggestions = $lagosPredictions->map(function ($prediction) use ($googleApiKey) {
                            $placeId = $prediction['place_id'];
                            $fullAddress = $prediction['description'];
                            $title = $prediction['structured_formatting']['main_text'] ?? $fullAddress;
                            $subtitle = $prediction['structured_formatting']['secondary_text'] ?? 'Lagos, Nigeria';
                            
                            // Extract basic info from terms (without API call)
                            $terms = collect($prediction['terms'] ?? []);
                            $city = null;
                            $state = null;
                            $country = null;
                            
                            // Try to extract city/state from terms
                            foreach ($terms as $term) {
                                $termValue = strtolower($term['value'] ?? '');
                                if (strpos($termValue, 'lagos') !== false && !$state) {
                                    $state = 'Lagos';
                                }
                                if (!$city && $termValue !== 'lagos' && $termValue !== 'nigeria') {
                                    $city = $term['value'];
                                }
                            }
                            
                            // Fetch place details for coordinates (only for filtered results)
                            $lat = null;
                            $lon = null;
                            $postcode = null;
                            
                            try {
                                $detailsResponse = Http::get('https://maps.googleapis.com/maps/api/place/details/json', [
                                    'place_id' => $placeId,
                                    'key' => $googleApiKey,
                                    'fields' => 'geometry,formatted_address,address_components',
                                ]);

                                if ($detailsResponse->successful()) {
                                    $details = $detailsResponse->json();
                                    if (isset($details['result'])) {
                                        $result = $details['result'];
                                        
                                        // Extract coordinates
                                        if (isset($result['geometry']['location'])) {
                                            $lat = $result['geometry']['location']['lat'];
                                            $lon = $result['geometry']['location']['lng'];
                                        }

                                        // Extract address components
                                        if (isset($result['address_components'])) {
                                            foreach ($result['address_components'] as $component) {
                                                $types = $component['types'] ?? [];
                                                
                                                if (in_array('postal_code', $types)) {
                                                    $postcode = $component['long_name'];
                                                }
                                                if (!$city && (in_array('locality', $types) || in_array('administrative_area_level_2', $types))) {
                                                    $city = $component['long_name'];
                                                }
                                                if (!$state && in_array('administrative_area_level_1', $types)) {
                                                    $state = $component['long_name'];
                                                }
                                                if (!$country && in_array('country', $types)) {
                                                    $country = $component['long_name'];
                                                }
                                            }
                                        }

                                        // Use formatted_address if available
                                        if (isset($result['formatted_address'])) {
                                            $fullAddress = $result['formatted_address'];
                                        }
                                    }
                                }
                            } catch (\Exception $e) {
                                // Continue without details if API call fails
                            }

                            return [
                                'place_id' => $placeId,
                                'display_name' => $fullAddress,
                                'title' => $title,
                                'subtitle' => $subtitle,
                                'city' => $city,
                                'state' => $state ?? 'Lagos',
                                'country' => $country ?? 'Nigeria',
                                'postcode' => $postcode,
                                'lat' => $lat,
                                'lon' => $lon,
                            ];
                        })->filter(); // Remove any null values

                        if ($suggestions->isNotEmpty()) {
                            return response()->json([
                                'success' => true,
                                'suggestions' => $suggestions->values(),
                            ]);
                        }
                    }
                }
            } catch (\Exception $e) {
                // Fall through to OpenStreetMap if Google API fails
            }
        }

        // Fallback to OpenStreetMap Nominatim API
        $query = urlencode($query);
        $response = Http::withHeaders([
            'User-Agent' => 'MyDeliveryApp/1.0 (ilesanmiolushola9@gmail.com)'
        ])->get("https://nominatim.openstreetmap.org/search", [
            'q' => $query,
            'format' => 'json',
            'addressdetails' => 1,
            'limit' => 100,
            'countrycodes' => 'ng', // Nigeria
        ]);

        if ($response->failed()) {
            return response()->json([
                'success' => false,
                'message' => 'Error fetching suggestions',
            ], 500);
        }

        $results = $response->json();

        // Filter to only Lagos addresses
        $lagosResults = collect($results)->filter(function ($item) {
            $address = $item['address'] ?? [];
            $city = strtolower($address['city'] ?? $address['town'] ?? $address['village'] ?? '');
            $state = strtolower($address['state'] ?? '');
            return strpos($city, 'lagos') !== false || strpos($state, 'lagos') !== false;
        });

        $suggestions = $lagosResults->map(function ($item) {
            $address = $item['address'] ?? [];
            $postcode = $address['postcode'] ?? null;

            // Fallback: extract postcode from display_name
            if (!$postcode && preg_match('/[A-Z]{1,2}\d{1,2}[A-Z]?\s*\d[A-Z]{2}/i', $item['display_name'], $matches)) {
                $postcode = $matches[0];
            }

            return [
                'display_name' => $item['display_name'],
                'city' => $address['city'] ?? $address['town'] ?? $address['village'] ?? null,
                'state' => $address['state'] ?? null,
                'country' => $address['country'] ?? null,
                'postcode' => $postcode,
                'lat' => $item['lat'],
                'lon' => $item['lon'],
            ];
        });

        return response()->json([
            'success' => true,
            'suggestions' => $suggestions->values(), // reset array keys
        ]);
    }
}
