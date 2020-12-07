<?php
/* This file has been prefixed by <PHP-Prefixer> for "XT Laravel Starter for Joomla" */

namespace Extly\Illuminate\Broadcasting;

class PrivateChannel extends Channel
{
    /**
     * Create a new channel instance.
     *
     * @param  string  $name
     * @return void
     */
    public function __construct($name)
    {
        parent::__construct('private-'.$name);
    }
}
