<?php

namespace Vzambon\LaravelDiscordLogging\Attributes;

#[\Attribute]
class Icon
{
    public string $icon;

    public function __construct(public string $type)
    {
        $this->icon = config('discord.logging.icons.' . $type);
    }
}