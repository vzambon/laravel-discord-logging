<?php

namespace Vzambon\LaravelDiscordLogging;

use Illuminate\Bus\Queueable as BusQueueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;

class DiscordMessageJob implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use BusQueueable;

    public function __construct(protected array $data)
    {
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $webhookUrl = config('logging.channels.discord.webhook_url');
        (new DiscordWebhookClient($webhookUrl))->send($this->data);
    }

}
