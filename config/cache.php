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

use Extly\Illuminate\Support\Str;
use Joomla\CMS\Factory as CMSFactory;

$config = CMSFactory::getConfig();
$sitename = $config->get('sitename', 'Laravel');
$appName = XT_env('APP_NAME', $sitename);
$cachePrefix = Str::slug($appName, '_');

return [
    /*
    |--------------------------------------------------------------------------
    | Default Cache Store
    |--------------------------------------------------------------------------
    |
    | This option controls the default cache connection that gets used while
    | using this caching library. This connection is used when another is
    | not explicitly specified when executing a given caching function.
    |
    */

    'default' => XT_env('CACHE_DRIVER', 'file'),

    /*
    |--------------------------------------------------------------------------
    | Cache Stores
    |--------------------------------------------------------------------------
    |
    | Here you may define all of the cache "stores" for your application as
    | well as their drivers. You may even define multiple stores for the
    | same cache driver to group types of items stored in your caches.
    |
    | Supported drivers: "apc", "array", "database", "file",
    |            "memcached", "redis", "dynamodb", "null"
    |
    */

    'stores' => [
        'apc' => [
            'driver' => 'apc',
        ],

        'array' => [
            'driver' => 'array',
            'serialize' => false,
        ],

        'database' => [
            'driver' => 'database',
            'table' => 'cache',
            'connection' => null,
        ],

        'file' => [
            'driver' => 'file',
            'path' => XT_storage_path('framework/cache/data'),
        ],

        'memcached' => [
            'driver' => 'memcached',
            'persistent_id' => XT_env('MEMCACHED_PERSISTENT_ID'),
            'sasl' => [
                XT_env('MEMCACHED_USERNAME'),
                XT_env('MEMCACHED_PASSWORD'),
            ],
            'options' => [
                // Memcached::OPT_CONNECT_TIMEOUT => 2000,
            ],
            'servers' => [
                [
                    'host' => XT_env('MEMCACHED_HOST', '127.0.0.1'),
                    'port' => XT_env('MEMCACHED_PORT', 11211),
                    'weight' => 100,
                ],
            ],
        ],

        'redis' => [
            'driver' => 'redis',
            'connection' => 'cache',
        ],

        'dynamodb' => [
            'driver' => 'dynamodb',
            'key' => XT_env('AWS_ACCESS_KEY_ID'),
            'secret' => XT_env('AWS_SECRET_ACCESS_KEY'),
            'region' => XT_env('AWS_DEFAULT_REGION', 'us-east-1'),
            'table' => XT_env('DYNAMODB_CACHE_TABLE', 'cache'),
            'endpoint' => XT_env('DYNAMODB_ENDPOINT'),
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Cache Key Prefix
    |--------------------------------------------------------------------------
    |
    | When utilizing a RAM based store such as APC or Memcached, there might
    | be other applications utilizing the same cache. So, we'll specify a
    | value to get prefixed to all our keys so we can avoid collisions.
    |
    */

    'prefix' => XT_env('CACHE_PREFIX', $cachePrefix.'_cache'),
];
