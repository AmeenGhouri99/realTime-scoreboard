<?php

namespace App\Traits;

use Exception;
use Twilio\Rest\Client;

/**
 *
 */
trait sendMessage
{
    public function sendMessage($message, $recipients)
    {
        $twilioConfig = config('services.twilio');

        $client = new Client($twilioConfig['sid'], $twilioConfig['token']);

        $client->messages->create($recipients, ['from' => $twilioConfig['from'], 'body' => $message]);
    }
}
