<?php

namespace App\Traits;

use Exception;
use Illuminate\Support\Facades\Log;

/**
 *
 */
trait PushNotification
{
    public function sendNotification($player_id, $message)
    {
        $content = array(
            "en" => $message
        );

        $fields = array(
            'app_id' => config('app.onesignal_app_id'),
            'include_player_ids' => array($player_id),
            'headings' => ['en' => 'MedLegalSafeKeep'],
            'data' => [
                "type" => 1,
            ],
            'contents' => $content
        );

        $fields = json_encode($fields);
        // print("\nJSON sent:\n");
        // print($fields);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json; charset=utf-8',
            'Authorization: Basic ' . config('app.onesignal_rest_api_key')
        ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $response = curl_exec($ch);
        curl_close($ch);

        Log::info("PlayerId = " . $player_id);
        Log::debug($response);

        return $response;
    }
}
