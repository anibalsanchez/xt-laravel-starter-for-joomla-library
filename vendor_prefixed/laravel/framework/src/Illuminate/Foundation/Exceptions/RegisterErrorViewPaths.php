<?php
/* This file has been prefixed by <PHP-Prefixer> for "XT Laravel Starter for Joomla" */

namespace Extly\Illuminate\Foundation\Exceptions;

use Extly\Illuminate\Support\Facades\View;

class RegisterErrorViewPaths
{
    /**
     * Register the error view paths.
     *
     * @return void
     */
    public function __invoke()
    {
        View::replaceNamespace('errors', XT_collect(XT_config('view.paths'))->map(function ($path) {
            return "{$path}/errors";
        })->push(__DIR__.'/views')->all());
    }
}
