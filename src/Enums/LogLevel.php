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

    #[Color(config('discord.logging.color.debug'))]
    #[Icon(config('discord.logging.icons.debug'))]
    case Debug = Level::Debug->value;

    #[Color(config('discord.logging.color.info'))]
    #[Icon(config('discord.logging.icons.info'))]
    case Info = Level::Info->value;

    #[Color(config('discord.logging.color.notice'))]
    #[Icon(config('discord.logging.icons.notice'))]
    case Notice = Level::Notice->value;

    #[Color(config('discord.logging.color.warning'))]
    #[Icon(config('discord.logging.icons.warning'))]
    case Warning = Level::Warning->value;

    #[Color(config('discord.logging.color.error'))]
    #[Icon(config('discord.logging.icons.error'))]
    case Error = Level::Error->value;

    #[Color(config('discord.logging.color.critical'))]
    #[Icon(config('discord.logging.icons.critical'))]
    case Critical = Level::Critical->value;

    #[Color(config('discord.logging.color.alert'))]
    #[Icon(config('discord.logging.icons.alert'))]
    case Alert = Level::Alert->value;

    #[Color(config('discord.logging.color.emergency'))]
    #[Icon(config('discord.logging.icons.emergency'))]
    case Emergency = Level::Emergency->value;
}
