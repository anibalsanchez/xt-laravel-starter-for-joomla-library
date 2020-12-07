<?php
/* This file has been prefixed by <PHP-Prefixer> for "XT Laravel Starter for Joomla" */


namespace Extly\League\Flysystem\Adapter;

/**
 * Adapters that implement this interface let the Filesystem know that files can be overwritten using the write
 * functions and don't need the update function to be called. This can help improve performance when asserts are disabled.
 */
interface CanOverwriteFiles
{
}
