<?php

namespace Vzambon\LaravelDiscordLogging\Enums;

use Monolog\Level;
use Vzambon\LaravelDiscordLogging\Attributes\Color;
use Vzambon\LaravelDiscordLogging\Attributes\Icon;
use Vzambon\LaravelDiscordLogging\Traits\HasColors;
use Vzambon\LaravelDiscordLogging\Traits\HasIcons;

enum LogLevel: int
{
    use HasColors;
    use HasIcons;

    #[Color('debug')]
    #[Icon('debug')]
    case Debug = Level::Debug->value;

    #[Color('info')]
    #[Icon('info')]
    case Info = Level::Info->value;

    #[Color('notice')]
    #[Icon('notice')]
    case Notice = Level::Notice->value;

    #[Color('warning')]
    #[Icon('warning')]
    case Warning = Level::Warning->value;

    #[Color('error')]
    #[Icon('error')]
    case Error = Level::Error->value;

    #[Color('critical')]
    #[Icon('critical')]
    case Critical = Level::Critical->value;

    #[Color('alert')]
    #[Icon('alert')]
    case Alert = Level::Alert->value;

    #[Color('emergency')]
    #[Icon('emergency')]
    case Emergency = Level::Emergency->value;
}
