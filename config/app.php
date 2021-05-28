<?php
/* This file has been prefixed by <PHP-Prefixer> for "XT Laravel Starter for Joomla" */

/*
 * @package    XT Laravel Starter for Joomla
 *
 * @author     Extly, CB <team@extly.com>
 * @copyright  Copyright (c)2012-2020 Extly, CB All rights reserved.
 * @license    GNU General Public License version 3 or later; see LICENSE.txt
 * @link       https://www.extly.com
 */

use Joomla\CMS\Factory as CMSFactory;
use Joomla\CMS\Uri\Uri as CMSUri;

$config = CMSFactory::getConfig();
$rootUrl = CMSUri::root();

return [
    /*
    |--------------------------------------------------------------------------
    | Application Name
    |--------------------------------------------------------------------------
    |
    | This value is the name of your application. This value is used when the
    | framework needs to place the application's name in a notification or
    | any other location as required by the application or its packages.
    |
    */

    'name' => XT_env('APP_NAME', $config->get('sitename', 'Laravel')),

    /*
    |--------------------------------------------------------------------------
    | Application Environment
    |--------------------------------------------------------------------------
    |
    | This value determines the "environment" your application is currently
    | running in. This may determine how you prefer to configure various
    | services the application utilizes. Set this in your ".env" file.
    |
    */

    'env' => XT_env('APP_ENV', 'production'),

    /*
    |--------------------------------------------------------------------------
    | Application Debug Mode
    |--------------------------------------------------------------------------
    |
    | When your application is in debug mode, detailed error messages with
    | stack traces will be shown on every error that occurs within your
    | application. If disabled, a simple generic error page is shown.
    |
    */

    'debug' => (bool) XT_env('APP_DEBUG', '1' === $config->get('debug')),

    /*
    |--------------------------------------------------------------------------
    | Application URL
    |--------------------------------------------------------------------------
    |
    | This URL is used by the console to properly generate URLs when using
    | the Artisan command line tool. You should set this to the root of
    | your application so that it is used when running Artisan tasks.
    |
    */

    'url' => XT_env('APP_URL', $rootUrl),

    'asset_url' => XT_env('ASSET_URL', $rootUrl.'/media/lib_xtlaravelstarter/public'),
    'mix_url' => XT_env('MIX_URL', $rootUrl.'/media/lib_xtlaravelstarter/public'),

    /*
    |--------------------------------------------------------------------------
    | Application Timezone
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default timezone for your application, which
    | will be used by the PHP date and date-time functions. We have gone
    | ahead and set this to a sensible default for you out of the box.
    |
    */

    'timezone' => 'UTC',

    /*
    |--------------------------------------------------------------------------
    | Application Locale Configuration
    |--------------------------------------------------------------------------
    |
    | The application locale determines the default locale that will be used
    | by the translation service provider. You are free to set this value
    | to any of the locales which will be supported by the application.
    |
    */

    'locale' => 'en',

    /*
    |--------------------------------------------------------------------------
    | Application Fallback Locale
    |--------------------------------------------------------------------------
    |
    | The fallback locale determines the locale to use when the current one
    | is not available. You may change the value to correspond to any of
    | the language folders that are provided through your application.
    |
    */

    'fallback_locale' => 'en',

    /*
    |--------------------------------------------------------------------------
    | Faker Locale
    |--------------------------------------------------------------------------
    |
    | This locale will be used by the Faker PHP library when generating fake
    | data for your database seeds. For example, this will be used to get
    | localized telephone numbers, street address information and more.
    |
    */

    'faker_locale' => 'en_US',

    /*
    |--------------------------------------------------------------------------
    | Encryption Key
    |--------------------------------------------------------------------------
    |
    | This key is used by the Illuminate encrypter service and should be set
    | to a random, 32 character string, otherwise these encrypted strings
    | will not be safe. Please do this before deploying an application!
    |
    */

    'key' => XT_env('APP_KEY', 'base64:'.base64_encode(substr(sha1($config->get('secret')), 8))),

    'cipher' => 'AES-256-CBC',

    /*
    |--------------------------------------------------------------------------
    | Autoloaded Service Providers
    |--------------------------------------------------------------------------
    |
    | The service providers listed here will be automatically loaded on the
    | request to your application. Feel free to add your own services to
    | this array to grant expanded functionality to your applications.
    |
    */

    'providers' => [
        // Laravel Framework Service Providers...
        \Extly\Illuminate\Auth\AuthServiceProvider::class,
        \Extly\Illuminate\Broadcasting\BroadcastServiceProvider::class,
        \Extly\Illuminate\Bus\BusServiceProvider::class,
        \Extly\Illuminate\Cache\CacheServiceProvider::class,
        \Extly\Illuminate\Foundation\Providers\ConsoleSupportServiceProvider::class,
        \Extly\Illuminate\Cookie\CookieServiceProvider::class,
        \Extly\Illuminate\Database\DatabaseServiceProvider::class,
        \Extly\Illuminate\Encryption\EncryptionServiceProvider::class,
        \Extly\Illuminate\Filesystem\FilesystemServiceProvider::class,
        \Extly\Illuminate\Foundation\Providers\FoundationServiceProvider::class,
        \Extly\Illuminate\Hashing\HashServiceProvider::class,
        \Extly\Illuminate\Mail\MailServiceProvider::class,
        \Extly\Illuminate\Notifications\NotificationServiceProvider::class,
        \Extly\Illuminate\Pagination\PaginationServiceProvider::class,
        \Extly\Illuminate\Pipeline\PipelineServiceProvider::class,
        \Extly\Illuminate\Queue\QueueServiceProvider::class,
        \Extly\Illuminate\Redis\RedisServiceProvider::class,
        \Extly\Illuminate\Auth\Passwords\PasswordResetServiceProvider::class,
        \Extly\Illuminate\Session\SessionServiceProvider::class,
        \Extly\Illuminate\Translation\TranslationServiceProvider::class,
        \Extly\Illuminate\Validation\ValidationServiceProvider::class,
        \Extly\Illuminate\View\ViewServiceProvider::class,

        // Package Service Providers...

        // Application Service Providers...
        XtLaravelStarterApp\Providers\AppServiceProvider::class,
        XtLaravelStarterApp\Providers\AuthServiceProvider::class,
        // App\Providers\BroadcastServiceProvider::class,
        XtLaravelStarterApp\Providers\EventServiceProvider::class,
        XtLaravelStarterApp\Providers\RouteServiceProvider::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Class Aliases
    |--------------------------------------------------------------------------
    |
    | This array of class aliases will be registered when this application
    | is started. However, feel free to register as many as you wish as
    | the aliases are "lazy" loaded so they don't hinder performance.
    |
    */

    'aliases' => [
        'App' => Extly\Illuminate\Support\Facades\App::class,
        'Arr' => Extly\Illuminate\Support\Arr::class,
        'Artisan' => Extly\Illuminate\Support\Facades\Artisan::class,
        'Auth' => Extly\Illuminate\Support\Facades\Auth::class,
        'Blade' => Extly\Illuminate\Support\Facades\Blade::class,
        'Broadcast' => Extly\Illuminate\Support\Facades\Broadcast::class,
        'Bus' => Extly\Illuminate\Support\Facades\Bus::class,
        'Cache' => Extly\Illuminate\Support\Facades\Cache::class,
        'Config' => Extly\Illuminate\Support\Facades\Config::class,
        'Cookie' => Extly\Illuminate\Support\Facades\Cookie::class,
        'Crypt' => Extly\Illuminate\Support\Facades\Crypt::class,
        'DB' => Extly\Illuminate\Support\Facades\DB::class,
        'Eloquent' => Extly\Illuminate\Database\Eloquent\Model::class,
        'Event' => Extly\Illuminate\Support\Facades\Event::class,
        'File' => Extly\Illuminate\Support\Facades\File::class,
        'Gate' => Extly\Illuminate\Support\Facades\Gate::class,
        'Hash' => Extly\Illuminate\Support\Facades\Hash::class,
        'Http' => Extly\Illuminate\Support\Facades\Http::class,
        'Lang' => Extly\Illuminate\Support\Facades\Lang::class,
        'Log' => Extly\Illuminate\Support\Facades\Log::class,
        'Mail' => Extly\Illuminate\Support\Facades\Mail::class,
        'Notification' => Extly\Illuminate\Support\Facades\Notification::class,
        'Password' => Extly\Illuminate\Support\Facades\Password::class,
        'Queue' => Extly\Illuminate\Support\Facades\Queue::class,
        'Redirect' => Extly\Illuminate\Support\Facades\Redirect::class,
        // 'Redis' => Illuminate\Support\Facades\Redis::class,
        'Request' => Extly\Illuminate\Support\Facades\Request::class,
        'Response' => Extly\Illuminate\Support\Facades\Response::class,
        'Route' => Extly\Illuminate\Support\Facades\Route::class,
        'Schema' => Extly\Illuminate\Support\Facades\Schema::class,
        'Session' => Extly\Illuminate\Support\Facades\Session::class,
        'Storage' => Extly\Illuminate\Support\Facades\Storage::class,
        'Str' => Extly\Illuminate\Support\Str::class,
        'URL' => Extly\Illuminate\Support\Facades\URL::class,
        'Validator' => Extly\Illuminate\Support\Facades\Validator::class,
        'View' => Extly\Illuminate\Support\Facades\View::class,
    ],
];
