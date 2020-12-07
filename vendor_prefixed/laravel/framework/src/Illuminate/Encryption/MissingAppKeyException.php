<?php
/* This file has been prefixed by <PHP-Prefixer> for "XT Laravel Starter for Joomla" */

namespace Extly\Illuminate\Encryption;

use RuntimeException;

class MissingAppKeyException extends RuntimeException
{
    /**
     * Create a new exception instance.
     *
     * @return void
     */
    public function __construct($message = 'No application encryption key has been specified.')
    {
        parent::__construct($message);
    }
}
