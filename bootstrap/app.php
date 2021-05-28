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

$app = new \Extly\Illuminate\Foundation\Application(
    $_ENV['APP_BASE_PATH'] ?? dirname(__DIR__)
);

/*
|--------------------------------------------------------------------------
| Bind Important Interfaces
|--------------------------------------------------------------------------
|
| Next, we need to bind some important interfaces into the container so
| we will be able to resolve them when needed. The kernels serve the
| incoming requests to this application from both the web and CLI.
|
*/

$app->singleton(
    \Extly\Illuminate\Contracts\Http\Kernel::class,
    XtLaravelStarterApp\Http\Kernel::class
);

$app->singleton(
    \Extly\Illuminate\Contracts\Console\Kernel::class,
    XtLaravelStarterApp\Console\Kernel::class
);

$app->singleton(
    \Extly\Illuminate\Contracts\Debug\ExceptionHandler::class,
    XtLaravelStarterApp\Exceptions\Handler::class
);

/*
|--------------------------------------------------------------------------
| Return The Application
|--------------------------------------------------------------------------
|
| This script returns the application instance. The instance is given to
| the calling script so we can separate the building of the instances
| from the actual running of the application and sending responses.
|
*/

$app->bind('path.public', function () {
    return JPATH_ROOT.'/media/lib_xtlaravelstarter/public';
});

return $app;
