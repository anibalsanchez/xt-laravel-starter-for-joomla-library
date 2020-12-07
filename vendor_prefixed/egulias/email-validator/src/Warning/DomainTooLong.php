<?php
/* This file has been prefixed by <PHP-Prefixer> for "XT Laravel Starter for Joomla" */

namespace Extly\Egulias\EmailValidator\Warning;

class DomainTooLong extends Warning
{
    const CODE = 255;

    public function __construct()
    {
        $this->message = 'Domain is too long, exceeds 255 chars';
        $this->rfcNumber = 5322;
    }
}
