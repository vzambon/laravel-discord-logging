# Laravel Discord Logging

A Laravel package to send customized log messages to a Discord channel via webhook.

## Installation

You can install the package via Composer:

    composer require vzambon/laravel-discord-loggin

## Configuration

After installation, you need to publish the configuration file to customize some of the package settings:

    php artisan vendor:publish --tag=config
   
   This will publish a `discord.php` configuration file to the `config` directory.

## Logging Configuration

Add the following to the logging.php config file:

    'channels' =>[
	     //..
	    'discord' => [
		    'driver' => 'custom', 
		    'via' => Vzambon\LaravelDiscordLogging\DiscordLogger::class, 
		    'formatter' => 'default', 
		    'webhook_url' => env('DISCORD_LOG_WEBHOOK_URL'), 
		    'options' => [ 
			    'enable' => env('DISCORD_LOG_ENABLE', true), 
			    'asynchronous' => env('DISCORD_LOG_ASYNC', true), 
			], 
		],
	]

In the `.env` file, add the `DISCORD_LOG_WEBHOOK_URL` obtained from Discord by navigating to `Apps → Integrations → Webhooks` and clicking `Copy Webhook URL`.
## Asynchronous Loggin

The `asynchronous` option allows log messages to be sent using a queued job. To utilize this feature, ensure that your default queue worker is running:

    php artisan queue:work
  
If you prefer to send logs synchronously, you can disable this feature by setting `DISCORD_LOG_ASYNC=false` in your `.env` file.

## Usage

To start sending logs to Discord, you just need to log messages using Laravel's built-in Log facade. For example:

    use Illuminate\Support\Facades\Log;
    
	Log::channel('discord')->info('Hello Discord!');

## Examples

![Info Log](https://raw.githubusercontent.com/vzambon/laravel-discord-logging/refs/heads/assets/1_info_log.png)

![Debug Log](https://raw.githubusercontent.com/vzambon/laravel-discord-logging/refs/heads/assets/2_debug_log.png)

![Notice Log](https://raw.githubusercontent.com/vzambon/laravel-discord-logging/refs/heads/assets/3_notice_log.png)

![Warning Log](https://raw.githubusercontent.com/vzambon/laravel-discord-logging/refs/heads/assets/4_warning_log.png)

![Error Log](https://raw.githubusercontent.com/vzambon/laravel-discord-logging/refs/heads/assets/5_error_log.png)

![Critical Log](https://raw.githubusercontent.com/vzambon/laravel-discord-logging/refs/heads/assets/6_critical_log.png)

![Alert Log](https://raw.githubusercontent.com/vzambon/laravel-discord-logging/refs/heads/assets/7_alert_log.png)

![Emergency Log](https://raw.githubusercontent.com/vzambon/laravel-discord-logging/refs/heads/assets/8_emergency_log.png)


## License
This package is open-source software licensed under the MIT license.
