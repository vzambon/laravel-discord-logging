<?php

namespace Vzambon\LaravelDiscordLogging;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class DiscordWebhookClient
{
    public function __construct(protected $webhookUrl)
    {
    }

    public function send($data, array $attachments = [])
    {
        $client = Http::asMultipart();

        if(!empty($attachments)){
            foreach($attachments as $key => $attachment) {
                $path = $attachment['path'];
                $contents = File::get($path);
                $client->attach("files[$key]", $contents, $attachment['filename']);
            }

            $attachments = collect($attachments)->map(fn($el, $key) => [
                "id" => $key,
                "path" => Storage::disk(config('backup.backup.destination.disks')[0])->path($el),
                "filename" => File::name($el)
            ]);

            $attachments->each(fn($el) => 
                $client->attach('files['.$el['id'].']', File::get($path), $el['filename'])
            );
        }

        try {
            $client->attach('payload_json', json_encode($data + ['attachments' => $attachments->toArray()]));
            $client->post($this->webhookUrl);

        } catch (\Exception $e) {
            Log::channel('stack')->error('Failed to send Discord message: ' . $e->getMessage());
        }
    }
}
