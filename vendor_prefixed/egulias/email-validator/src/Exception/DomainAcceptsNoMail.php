<?php
/* This file has been prefixed by <PHP-Prefixer> for "XT Laravel Starter for Joomla" */

namespace Extly\Egulias\EmailValidator\Exception;

class DomainAcceptsNoMail extends InvalidEmail
{
    const CODE = 154;
    const REASON = 'Domain accepts no mail (Null MX, RFC7505)';
}