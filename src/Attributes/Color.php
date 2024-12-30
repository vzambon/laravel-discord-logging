<?php

namespace Vzambon\LaravelDiscordLogging\Attributes;

#[\Attribute]
class Color
{
    public string $color;

    public function __construct(public string $type)
    {
        $this->color = config('discord.logging.color.' . $type);
    }
}