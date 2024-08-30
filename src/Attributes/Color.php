<?php

namespace Vzambon\LaravelDiscordLogging\Attributes;

#[\Attribute]
class Color
{
    public function __construct(public string $color)
    { 
    }
}