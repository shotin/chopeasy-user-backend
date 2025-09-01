<?php

namespace App\Helpers;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class ImageKitHelper
{
    public static function uploadBase64Image(string $base64Image, string $fileName = null): ?string
    {
        $apiUrl = 'https://upload.imagekit.io/api/v1/files/upload';
        $publicKey = config('services.imagekit.public');
        $privateKey = config('services.imagekit.private');
        $folder = config('services.imagekit.folder') ?? '/blogs';
        $fileName = $fileName ?? 'blog_' . time();

        try {
            $client = new Client();

            $response = $client->post($apiUrl, [
                'auth' => [$privateKey, ''],
                'multipart' => [
                    [
                        'name' => 'file',
                        'contents' => $base64Image,
                    ],
                    [
                        'name' => 'fileName',
                        'contents' => $fileName,
                    ],
                    [
                        'name' => 'folder',
                        'contents' => $folder,
                    ],
                    [
                        'name' => 'useUniqueFileName',
                        'contents' => 'true',
                    ],
                ],
            ]);

            $body = json_decode($response->getBody(), true);
            return $body['url'] ?? null;
        } catch (\Throwable $e) {
            Log::error('ImageKit Upload Failed: ' . $e->getMessage());
            return null;
        }
    }
}
