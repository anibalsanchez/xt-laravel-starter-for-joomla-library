<?php
/* This file has been prefixed by <PHP-Prefixer> for "XT Laravel Starter for Joomla" */

namespace Extly\League\Flysystem\Plugin;

class ListPaths extends AbstractPlugin
{
    /**
     * Get the method name.
     *
     * @return string
     */
    public function getMethod()
    {
        return 'listPaths';
    }

    /**
     * List all paths.
     *
     * @param string $directory
     * @param bool   $recursive
     *
     * @return string[] paths
     */
    public function handle($directory = '', $recursive = false)
    {
        $result = [];
        $contents = $this->filesystem->listContents($directory, $recursive);

        foreach ($contents as $object) {
            $result[] = $object['path'];
        }

        return $result;
    }
}
