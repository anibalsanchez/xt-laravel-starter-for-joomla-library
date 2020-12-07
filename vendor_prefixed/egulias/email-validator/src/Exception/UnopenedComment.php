<?php
/* This file has been prefixed by <PHP-Prefixer> for "XT Laravel Starter for Joomla" */

namespace Extly\Egulias\EmailValidator\Exception;

class UnopenedComment extends InvalidEmail
{
    const CODE = 152;
    const REASON = "No opening comment token found";
}
