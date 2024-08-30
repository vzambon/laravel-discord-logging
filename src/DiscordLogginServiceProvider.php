<?php

namespace Vzambon\LaravelDiscordLogging;

use Illuminate\Support\ServiceProvider;

class DiscordLogginServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . 'config/discord.php' => config_path('discord.php'),
        ], 'config');

        if ($this->app->runningInConsole()) {
            // $this->commands([]);
        }
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        // Merge package configuration with the application configuration
        $this->mergeConfigFrom(
            __DIR__ . 'config/discord.php', 'discord'
        );
    }
}