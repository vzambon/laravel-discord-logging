<?php

namespace Vszambon\LaravelDiscordLogging;

use Vszambon\LaravelDiscordLogging\Handlers\DiscordHandler;
use Vszambon\LaravelDiscordLogging\Processors\AddFileLineProcessor;
use Monolog\Level;
use Monolog\Logger;

class DiscordLogger
{
    /**
     * Create a custom Monolog instance.
     */
    public function __invoke(array $config): Logger
    {
        $logger = new Logger('discord', handlers: [
            new DiscordHandler($config['level'] ?? Level::Debug),
        ]);

        $logger->pushProcessor(new AddFileLineProcessor());

        return $logger;
    }

}
