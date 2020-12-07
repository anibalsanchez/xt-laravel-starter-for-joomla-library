<?php
/* This file has been prefixed by <PHP-Prefixer> for "XT Laravel Starter for Joomla" */

namespace Extly\Illuminate\Routing\Exceptions;

use Exception;

class UrlGenerationException extends Exception
{
    /**
     * Create a new exception for missing route parameters.
     *
     * @param  \Illuminate\Routing\Route  $route
     * @return static
     */
    public static function forMissingParameters($route)
    {
        return new static("Missing required parameters for [Route: {$route->getName()}] [URI: {$route->uri()}].");
    }
}
