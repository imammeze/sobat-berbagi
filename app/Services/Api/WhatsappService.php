<?php

namespace App\Services\Api;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WhatsappService
{
    private $apiHost = 'https://my-whatsapp.sobatberbagi.com/api/';

    public function sendMessage($number, $message)
    {
        $formattedNumber = preg_replace('/^0/', '62', $number);


        return Http::post($this->apiHost . "send-message", [
            'api_key' => "408d48ffcad81c8d2fbd99ef48e4d84cc8d2bcbc",
            'receiver' => $formattedNumber,
            'data' => [
                'message' => $message
            ]
        ]);
    }

    public function sendMessageWithImage($number, $imageUrl, $message = '')
    {
        $formattedNumber = preg_replace('/^0/', '62', $number);
        // $image = 'https://sobatberbagi.com/storage/' . $imageUrl;

        return Http::post($this->apiHost . "send-media", [
            'api_key' => "408d48ffcad81c8d2fbd99ef48e4d84cc8d2bcbc",
            'receiver' => $formattedNumber,
            'data' => [
                'url' => $imageUrl ?? '',   // URL gambar
                'media_type' => 'image',  // Jenis media (image)
                'caption' => $message   // Caption untuk gambar
            ]
        ]);
    }
}
