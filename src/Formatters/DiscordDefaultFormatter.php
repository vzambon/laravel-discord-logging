<?php

namespace Vzambon\LaravelDiscordLogging\Formatters;

use Monolog\Formatter\FormatterInterface;
use Monolog\Level;
use Monolog\LogRecord;

class DiscordDefaultFormatter implements FormatterInterface
{
    public $logLevelColor = [
        Level::Debug->value => '1752220',
        Level::Info->value => '0',
        Level::Notice->value => '10181046',
        Level::Warning->value => '16776960',
        Level::Error->value => '10038562',
        Level::Alert->value => '11342935',
        Level::Emergency->value => '15548997',
	    Level::Critical->value => '15548997',
    ];

    public $logLevelIcon = [
        Level::Debug->value => ':man_technologist::skin-tone-1: :mag_right:',
        Level::Info->value => ':information_source:',
        Level::Notice->value => ':bell:',
        Level::Warning->value => ':warning:',
        Level::Error->value => ':boom:',
        Level::Alert->value => ':bangbang:',
        Level::Emergency->value => ':ambulance:',
        Level::Critical->value => ':rotating_light:'
    ];

    protected $dateFormat;

    protected $printStack;

    public function __construct(string $dateFormat = null, bool $printStack = false)
    {
        $this->printStack = $printStack;
    }

    /**
     * {@inheritDoc}
     */
    public function format(LogRecord $record)
    {
        $appname = config('app.name');
        $messageIcon = $this->logLevelIcon[$record['level']];
        
        $isException = isset($record['context']['exception']);
        $exceptionFile = $isException ? $record['context']['exception']->getFile() : null;
        $exceptionLine = $isException ? $record['context']['exception']->getLine() : null;

        $file = $exceptionFile ?? $record['extra']['file'] ?? null;
        $line = $exceptionLine ?? $record['extra']['line'] ?? null;
        $message = $record['message'];
        $level = $record['level_name'];

        return [
            'embeds' => [
                [
                    'author' => [
                        'name' => $appname,
                        'icon_url' => 'https://raw.githubusercontent.com/vzambon/laravel-discord-logging/assets/gir_robot.png'
                    ],
                    'title' => "{$messageIcon} {$level}",
                    'description' => "`$message`",
                    'color' => $this->logLevelColor[$record['level']],
                    'timestamp' => $record['datetime'],
                    'footer' => [
                        'text' => "{$file}:{$line}",
                    ]
                ],
            ],
        ];
    }

    public function formatBatch(array $records)
    {
        $formattedBatch = '';

        foreach ($records as $record) {
            $formattedBatch .= $this->format($record);
        }

        return $formattedBatch;
    }
}
