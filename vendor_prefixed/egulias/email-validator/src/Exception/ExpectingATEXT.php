<?php
/* This file has been prefixed by <PHP-Prefixer> for "XT Laravel Starter for Joomla" */

namespace Extly\Egulias\EmailValidator\Exception;

class ExpectingATEXT extends InvalidEmail
{
    const CODE = 137;
    const REASON = "Expecting ATEXT";
}
