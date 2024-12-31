<?php

namespace Vzambon\LaravelDiscordLogging\Formatters;

use Monolog\Formatter\FormatterInterface;
use Monolog\LogRecord;
use Vzambon\LaravelDiscordLogging\Enums\LogLevel;

class DiscordDefaultFormatter implements FormatterInterface
{
    /**
     * {@inheritDoc}
     */
    public function format(LogRecord $record)
    {
        $appname = config('app.name');

        $logLevel = LogLevel::from($record['level']);
        $messageIcon = $logLevel->getIcon();
        $cardIcon =$logLevel->getColor();
        
        $isException = isset($record['context']['exception']);
        $exceptionFile = $isException ? $record['context']['exception']->getFile() : null;
        $exceptionLine = $isException ? $record['context']['exception']->getLine() : null;

        $file = $exceptionFile ?? $record['extra']['file'] ?? null;
        $line = $exceptionLine ?? $record['extra']['line'] ?? null;
        $message = $record['message'];
        $level = $record['level_name'];

        $embeds = [
            [
                'author' => [
                    'name' => $appname,
                    'icon_url' => 'https://raw.githubusercontent.com/vzambon/laravel-discord-logging/assets/gir_robot.png'
                ],
                'title' => "{$messageIcon} {$level}",
                'description' => "`$message`",
                'color' => $cardIcon,
                'timestamp' => $record['datetime'],
                'footer' => [
                    'text' => "{$file}:{$line}",
                ]
            ],
        ];

        if($isException) {
            $embeds[] = [
                'title' => 'Stack Trace:',
                'description' => $record['context']['exception']->getTraceAsString(),
            ];
        }

        return ['embeds' => $embeds];
    }

    /**
     * {@inheritDoc}
     */
    public function formatBatch(array $records)
    {
        $formattedBatch = '';

        foreach ($records as $record) {
            $formattedBatch .= $this->format($record);
        }

        return $formattedBatch;
    }
}
