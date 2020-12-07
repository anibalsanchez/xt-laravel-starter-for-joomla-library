<?php
/* This file has been prefixed by <PHP-Prefixer> for "XT Laravel Starter for Joomla" */

namespace Extly\Egulias\EmailValidator\Exception;

class ConsecutiveAt extends InvalidEmail
{
    const CODE = 128;
    const REASON = "Consecutive AT";
}
