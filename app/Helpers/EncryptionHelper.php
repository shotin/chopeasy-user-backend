<?php

namespace App\Helpers;

class EncryptionHelper
{
    public static function encryptWithKey($data)
    {
        $cipherMethod = 'AES-256-CBC'; // AES-256 encryption
        $key = env('CUSTOM_ENCRYPTION_KEY'); // Get the key from .env
        $iv = substr(hash('sha256', $key), 0, 16); // Initialization vector from the key
        
        // Encrypt the data
        $encrypted = openssl_encrypt($data, $cipherMethod, $key, 0, $iv);
        
        return base64_encode($encrypted); // Return the encrypted data as base64
    }

    public static function decryptWithKey($encryptedData)
    {
        $cipherMethod = 'AES-256-CBC'; // AES-256 encryption
        $key = env('CUSTOM_ENCRYPTION_KEY'); // Get the key from .env
        $iv = substr(hash('sha256', $key), 0, 16); // Initialization vector from the key
        
        // Decrypt the data
        $decrypted = openssl_decrypt(base64_decode($encryptedData), $cipherMethod, $key, 0, $iv);
        
        return $decrypted;
    }
}
