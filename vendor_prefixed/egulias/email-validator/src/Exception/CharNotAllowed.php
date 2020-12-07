<?php
/* This file has been prefixed by <PHP-Prefixer> for "XT Laravel Starter for Joomla" */

namespace Extly\Egulias\EmailValidator\Exception;

class CharNotAllowed extends InvalidEmail
{
    const CODE = 201;
    const REASON = "Non allowed character in domain";
}
