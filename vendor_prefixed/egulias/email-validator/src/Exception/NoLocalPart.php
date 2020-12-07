<?php
/* This file has been prefixed by <PHP-Prefixer> for "XT Laravel Starter for Joomla" */

namespace Extly\Egulias\EmailValidator\Exception;

class NoLocalPart extends InvalidEmail
{
    const CODE = 130;
    const REASON = "No local part";
}
