<?php

namespace Vzambon\LaravelDiscordLogging\Handlers;

use Vzambon\LaravelDiscordLogging\DiscordMessageJob;
use Vzambon\LaravelDiscordLogging\Formatters\DiscordDefaultFormatter;
use Monolog\Formatter\FormatterInterface;
use Monolog\Handler\AbstractProcessingHandler;
use Monolog\Level;
use Monolog\Logger;
use Monolog\LogRecord;
use Vzambon\LaravelDiscordLogging\DiscordWebhookClient;

class DiscordHandler extends AbstractProcessingHandler
{
    public function __construct(Level $level = Level::Debug)
    {
        $this->level = Logger::toMonologLevel($level) ?? Level::Debug;

        parent::__construct($level, true);
    }

    /**
     * {@inheritDoc}
     */
    protected function write(LogRecord $record): void
    {
        if (! config('logging.channels.discord.options.enable')) {
            return;
        }

        if(config('logging.channels.discord.options.asynchronous')) {
            DiscordMessageJob::dispatch($record['formatted']);
            return;
        }

        (new DiscordWebhookClient(config('logging.channels.discord.webhook_url')))->send($record['formatted']);
    }

    /**
     * Gets the default formatter.
     *
     * Overwrite this if the DiscordFormatter is not a good default for you.
     */
    protected function getDefaultFormatter(): FormatterInterface
    {
        return new DiscordDefaultFormatter();
    }
}
