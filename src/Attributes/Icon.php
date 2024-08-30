<?php

namespace Vzambon\LaravelDiscordLogging\Attributes;

#[\Attribute]
class Icon
{
    public function __construct(public string $icon)
    { 
    }
}