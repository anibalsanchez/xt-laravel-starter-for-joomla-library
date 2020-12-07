<?php
/* This file has been prefixed by <PHP-Prefixer> for "XT Laravel Starter for Joomla" */

/*
 * This file is part of Psy Shell.
 *
 * (c) 2012-2020 Justin Hileman
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Extly\Psy\Output;

use Extly\Symfony\Component\Console\Output\OutputInterface;

/**
 * An output pager is much the same as a regular OutputInterface, but allows
 * the stream to be flushed to a pager periodically.
 */
interface OutputPager extends OutputInterface
{
    /**
     * Close the current pager process.
     */
    public function close();
}
