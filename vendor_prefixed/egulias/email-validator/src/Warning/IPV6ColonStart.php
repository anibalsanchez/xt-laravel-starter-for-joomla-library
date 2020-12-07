<?php
/* This file has been prefixed by <PHP-Prefixer> for "XT Laravel Starter for Joomla" */

namespace Extly\Egulias\EmailValidator\Warning;

class IPV6ColonStart extends Warning
{
    const CODE = 76;

    public function __construct()
    {
        $this->message = ':: found at the start of the domain literal';
        $this->rfcNumber = 5322;
    }
}
