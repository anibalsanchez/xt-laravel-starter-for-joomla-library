<?php
/* This file has been prefixed by <PHP-Prefixer> for "XT Laravel Starter for Joomla" */

namespace Extly\Illuminate\Cache\RateLimiting;

class Unlimited extends GlobalLimit
{
    /**
     * Create a new limit instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct(PHP_INT_MAX);
    }
}
