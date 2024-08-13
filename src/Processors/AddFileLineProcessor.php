<?php

namespace Vzambon\LaravelDiscordLogging\Processors;

use Monolog\LogRecord;

class AddFileLineProcessor
{
    public function __invoke(LogRecord $record): LogRecord
    {
        $backtrace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 10);

        foreach ($backtrace as $frame) {
            if (isset($frame['file']) && isset($frame['line']) && strpos($frame['file'], 'vendor/') === false) {
                $record['extra']['file'] = $frame['file'];
                $record['extra']['line'] = $frame['line'];
                break;
            }
        }

        return $record;
    }
}
