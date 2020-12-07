<?php
/* This file has been prefixed by <PHP-Prefixer> for "XT Laravel Starter for Joomla" */

namespace Extly\Egulias\EmailValidator\Warning;

use Extly\Egulias\EmailValidator\EmailParser;

class EmailTooLong extends Warning
{
    const CODE = 66;

    public function __construct()
    {
        $this->message = 'Email is too long, exceeds ' . EmailParser::EMAIL_MAX_LENGTH;
    }
}
