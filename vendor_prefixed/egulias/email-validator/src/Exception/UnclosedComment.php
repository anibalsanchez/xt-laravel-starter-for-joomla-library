<?php
/* This file has been prefixed by <PHP-Prefixer> for "XT Laravel Starter for Joomla" */

namespace Extly\Egulias\EmailValidator\Exception;

class UnclosedComment extends InvalidEmail
{
    const CODE = 146;
    const REASON = "No closing comment token found";
}
