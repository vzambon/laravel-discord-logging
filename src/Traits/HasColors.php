<?php

namespace Vzambon\LaravelDiscordLogging\Traits;

use ReflectionEnum;
use Vzambon\LaravelDiscordLogging\Attributes\Color;

trait HasColors
{
    public function getColor(): ?string
    {
        $reflection = new ReflectionEnum(static::class);
        $caseName = $this->name;

        $case = $reflection->getCase($caseName);

        if ($case) {
            $attributes = $case->getAttributes(Color::class);

            if (count($attributes) > 0) {
                $colorAttribute = $attributes[0]->newInstance();
                return $colorAttribute->color;
            }
        }

        return null;
    }
}