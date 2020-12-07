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

return [
    /*
    |--------------------------------------------------------------------------
    | Default Database Connection Name
    |--------------------------------------------------------------------------
    |
    | Here you may specify which of the database connections below you wish
    | to use as your default connection for all database work. Of course
    | you may use many connections at once using the Database library.
    |
    */

    'default' => XT_env('DB_CONNECTION', 'mysql'),

    /*
    |--------------------------------------------------------------------------
    | Database Connections
    |--------------------------------------------------------------------------
    |
    | Here are each of the database connections setup for your application.
    | Of course, examples of configuring each database platform that is
    | supported by Laravel is shown below to make development simple.
    |
    |
    | All database work in Laravel is done through the PHP PDO facilities
    | so make sure you have the driver for your particular database of
    | choice installed on your machine before you begin development.
    |
    */

    'connections' => [
        'sqlite' => [
            'driver' => 'sqlite',
            'url' => XT_env('DATABASE_URL'),
            'database' => XT_env('DB_DATABASE', XT_database_path('database.sqlite')),
            'prefix' => '',
            'foreign_key_constraints' => XT_env('DB_FOREIGN_KEYS', true),
        ],

        'mysql' => [
            'driver' => 'mysql',
            'url' => XT_env('DATABASE_URL'),
            'host' => XT_env('DB_HOST', $config->get('host')),
            'port' => XT_env('DB_PORT', '3306'),
            'database' => XT_env('DB_DATABASE', $config->get('db')),
            'username' => XT_env('DB_USERNAME', $config->get('user')),
            'password' => XT_env('DB_PASSWORD', $config->get('password')),
            'unix_socket' => XT_env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => $config->get('dbprefix'),
            'prefix_indexes' => true,
            'strict' => true,
            'engine' => null,
            'options' => extension_loaded('pdo_mysql') ? array_filter([
                PDO::MYSQL_ATTR_SSL_CA => XT_env('MYSQL_ATTR_SSL_CA'),
            ]) : [],
        ],

        'pgsql' => [
            'driver' => 'pgsql',
            'url' => XT_env('DATABASE_URL'),
            'host' => XT_env('DB_HOST', '127.0.0.1'),
            'port' => XT_env('DB_PORT', '5432'),
            'database' => XT_env('DB_DATABASE', 'forge'),
            'username' => XT_env('DB_USERNAME', 'forge'),
            'password' => XT_env('DB_PASSWORD', ''),
            'charset' => 'utf8',
            'prefix' => '',
            'prefix_indexes' => true,
            'schema' => 'public',
            'sslmode' => 'prefer',
        ],

        'sqlsrv' => [
            'driver' => 'sqlsrv',
            'url' => XT_env('DATABASE_URL'),
            'host' => XT_env('DB_HOST', 'localhost'),
            'port' => XT_env('DB_PORT', '1433'),
            'database' => XT_env('DB_DATABASE', 'forge'),
            'username' => XT_env('DB_USERNAME', 'forge'),
            'password' => XT_env('DB_PASSWORD', ''),
            'charset' => 'utf8',
            'prefix' => '',
            'prefix_indexes' => true,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Migration Repository Table
    |--------------------------------------------------------------------------
    |
    | This table keeps track of all the migrations that have already run for
    | your application. Using this information, we can determine which of
    | the migrations on disk haven't actually been run in the database.
    |
    */

    'migrations' => 'migrations',
];
