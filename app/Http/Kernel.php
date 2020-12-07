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

namespace XtLaravelStarterApp\Http;

use Extly\Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array
     */
    protected $middleware = [
        \XtLaravelStarterApp\Http\Middleware\TrustHosts::class,
        \XtLaravelStarterApp\Http\Middleware\TrustProxies::class,
        \Extly\Fruitcake\Cors\HandleCors::class,
        \XtLaravelStarterApp\Http\Middleware\PreventRequestsDuringMaintenance::class,
        \Extly\Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \XtLaravelStarterApp\Http\Middleware\TrimStrings::class,
        \Extly\Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'web' => [
            \XtLaravelStarterApp\Http\Middleware\EncryptCookies::class,
            \Extly\Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Extly\Illuminate\Session\Middleware\StartSession::class,
            // \Illuminate\Session\Middleware\AuthenticateSession::class,
            \Extly\Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \XtLaravelStarterApp\Http\Middleware\VerifyCsrfToken::class,
            \Extly\Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],

        'api' => [
            'throttle:api',
            \Extly\Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],
    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth' => \XtLaravelStarterApp\Http\Middleware\Authenticate::class,
        'auth.basic' => \Extly\Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'cache.headers' => \Extly\Illuminate\Http\Middleware\SetCacheHeaders::class,
        'can' => \Extly\Illuminate\Auth\Middleware\Authorize::class,
        'guest' => \XtLaravelStarterApp\Http\Middleware\RedirectIfAuthenticated::class,
        'password.confirm' => \Extly\Illuminate\Auth\Middleware\RequirePassword::class,
        'signed' => \Extly\Illuminate\Routing\Middleware\ValidateSignature::class,
        'throttle' => \Extly\Illuminate\Routing\Middleware\ThrottleRequests::class,
        'verified' => \Extly\Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
    ];
}
