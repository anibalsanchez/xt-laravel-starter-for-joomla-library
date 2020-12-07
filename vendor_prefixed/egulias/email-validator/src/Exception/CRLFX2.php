<?php
/* This file has been prefixed by <PHP-Prefixer> for "XT Laravel Starter for Joomla" */

namespace Extly\Egulias\EmailValidator\Exception;

class CRLFX2 extends InvalidEmail
{
    const CODE = 148;
    const REASON = "Folding whitespace CR LF found twice";
}
