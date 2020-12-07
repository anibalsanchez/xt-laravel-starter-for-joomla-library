<?php
/* This file has been prefixed by <PHP-Prefixer> for "XT Laravel Starter for Joomla" */

namespace Extly\Egulias\EmailValidator\Exception;

class CommaInDomain extends InvalidEmail
{
    const CODE = 200;
    const REASON = "Comma ',' is not allowed in domain part";
}
