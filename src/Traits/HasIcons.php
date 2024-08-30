<?php

namespace Vzambon\LaravelDiscordLogging\Traits;

use ReflectionEnum;
use Vzambon\LaravelDiscordLogging\Attributes\Icon;

trait HasIcons
{
    public function getIcon(): ?string
    {
        $reflection = new ReflectionEnum(static::class);
        $caseName = $this->name;

        $case = $reflection->getCase($caseName);

        if ($case) {
            $attributes = $case->getAttributes(Icon::class);

            if (count($attributes) > 0) {
                $colorAttribute = $attributes[0]->newInstance();
                return $colorAttribute->icon;
            }
        }

        return null;
    }
}