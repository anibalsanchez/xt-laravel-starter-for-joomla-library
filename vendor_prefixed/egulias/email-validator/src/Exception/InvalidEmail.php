<?php
/* This file has been prefixed by <PHP-Prefixer> for "XT Laravel Starter for Joomla" */

namespace Extly\Egulias\EmailValidator\Exception;

abstract class InvalidEmail extends \InvalidArgumentException
{
    const REASON = "Invalid email";
    const CODE = 0;

    public function __construct()
    {
        parent::__construct(static::REASON, static::CODE);
    }
}
