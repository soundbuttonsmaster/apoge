<?php

use Illuminate\Support\Facades\DB;
use Intervention\Image\ImageManagerStatic as Image;
use App\Models\ShippingAddress;
use App\Models\Order;
use App\Models\OrderDetails;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Http;

if (!function_exists('extractYoutubeID')) {
    function extractYoutubeID($url)
    {
        preg_match(
            '/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/i',
            $url,
            $matches
        );
        return $matches[1] ?? '';
    }
}