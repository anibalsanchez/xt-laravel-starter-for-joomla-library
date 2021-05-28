<?php
/* This file has been prefixed by <PHP-Prefixer> for "XT Laravel Starter for Joomla" */

namespace Extly\Cron;

interface FieldFactoryInterface
{
    public function getField(int $position): FieldInterface;
}
