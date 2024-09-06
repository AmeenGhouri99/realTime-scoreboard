<?php

namespace App\Helpers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class Helper
{

    public static function logMessage($endpoint, $input, $exception)
    {
        Log::info($endpoint);
        Log::debug($input);
        Log::info($exception);
    }

    public  static function getLocaleAttribute(string $attrName)
    {
        return $attrName . (session('locale') ?? 'en');
    }

    public static function getLocaleAttributeApi(string $attrName)
    {
        $request = request();
        $locale = ($request->hasHeader('X-localization')) ? $request->header('X-localization') : 'en'; // set laravel localization

        return $attrName . $locale;
    }

    public function getUsersTimezone($ipAddress)
    {
        try {
            $apiKey = config('app.ipinfo'); // Replace with your actual API key
            $url = "https://ipinfo.io/{$ipAddress}/timezone";

            $client = new \GuzzleHttp\Client();
            $response = $client->request('GET', $url, [
                'headers' => [
                    'Authorization' => "Bearer {$apiKey}",
                ]
            ]);

            $timezone = $response->getBody()->getContents();
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            Helper::logMessage('Time zone', $ipAddress, $e->getMessage());
            $timezone = "Asia/Riyadh";
        }
        return $timezone;
    }

    public static function convertDateTimeFromTimestamp($epoch_time, $format = 'H:i')
    {
        // Convert epoch times to Carbon instances
        $startTime = Carbon::createFromTimestamp($epoch_time / 1000);
        return $startTime->format($format);
    }
}
