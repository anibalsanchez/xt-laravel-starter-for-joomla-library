<?php
/* This file has been prefixed by <PHP-Prefixer> for "XT Laravel Starter for Joomla" */

namespace Extly\League\Flysystem;

use LogicException;

class CorruptedPathDetected extends LogicException implements FilesystemException
{
    /**
     * @param string $path
     * @return CorruptedPathDetected
     */
    public static function forPath($path)
    {
        return new CorruptedPathDetected("Corrupted path detected: " . $path);
    }
}
