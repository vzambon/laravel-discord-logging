<?php

namespace Vzambon\LaravelDiscordLogging;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class DiscordWebhookClient
{
    public function __construct(protected $webhookUrl)
    {
    }

    public function send($data)
    {
        try {
            Http::post($this->webhookUrl, $data);
        } catch (\Exception $e) {
            Log::error('Failed to send Discord message: ' . $e->getMessage());
        }
    }
}
