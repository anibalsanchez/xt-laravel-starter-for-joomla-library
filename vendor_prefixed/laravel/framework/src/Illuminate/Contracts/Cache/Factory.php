<?php
/* This file has been prefixed by <PHP-Prefixer> for "XT Laravel Starter for Joomla" */

namespace Extly\Illuminate\Contracts\Cache;

interface Factory
{
    /**
     * Get a cache store instance by name.
     *
     * @param  string|null  $name
     * @return \Illuminate\Contracts\Cache\Repository
     */
    public function store($name = null);
}
