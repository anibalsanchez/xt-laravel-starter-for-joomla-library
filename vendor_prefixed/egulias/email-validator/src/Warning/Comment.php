<?php
/* This file has been prefixed by <PHP-Prefixer> for "XT Laravel Starter for Joomla" */

namespace Extly\Egulias\EmailValidator\Warning;

class Comment extends Warning
{
    const CODE = 17;

    public function __construct()
    {
        $this->message = "Comments found in this email";
    }
}
