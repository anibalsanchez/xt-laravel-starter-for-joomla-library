<?php
/* This file has been prefixed by <PHP-Prefixer> for "XT Laravel Starter for Joomla" */

namespace Extly\League\Flysystem;

interface PluginInterface
{
    /**
     * Get the method name.
     *
     * @return string
     */
    public function getMethod();

    /**
     * Set the Filesystem object.
     *
     * @param FilesystemInterface $filesystem
     */
    public function setFilesystem(FilesystemInterface $filesystem);
}
