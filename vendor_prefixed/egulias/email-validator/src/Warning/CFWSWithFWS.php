<?php
/* This file has been prefixed by <PHP-Prefixer> for "XT Laravel Starter for Joomla" */

namespace Extly\Egulias\EmailValidator\Warning;

class CFWSWithFWS extends Warning
{
    const CODE = 18;

    public function __construct()
    {
        $this->message = 'Folding whites space followed by folding white space';
    }
}
