<?php
/* This file has been prefixed by <PHP-Prefixer> for "XT Laravel Starter for Joomla" */

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Extly\Symfony\Component\Translation\Dumper;

use Extly\Symfony\Component\Translation\MessageCatalogue;

/**
 * DumperInterface is the interface implemented by all translation dumpers.
 * There is no common option.
 *
 * @author Michel Salib <michelsalib@hotmail.com>
 */
interface DumperInterface
{
    /**
     * Dumps the message catalogue.
     *
     * @param array $options Options that are used by the dumper
     */
    public function dump(MessageCatalogue $messages, array $options = []);
}