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

namespace Extly\Symfony\Component\Translation\Provider;

use Extly\Symfony\Component\Translation\TranslatorBag;
use Extly\Symfony\Component\Translation\TranslatorBagInterface;

/**
 * @author Mathieu Santostefano <msantostefano@protonmail.com>
 *
 * @experimental in 5.3
 */
class NullProvider implements ProviderInterface
{
    public function __toString(): string
    {
        return 'null';
    }

    public function write(TranslatorBagInterface $translatorBag, bool $override = false): void
    {
    }

    public function read(array $domains, array $locales): TranslatorBag
    {
        return new TranslatorBag();
    }

    public function delete(TranslatorBagInterface $translatorBag): void
    {
    }
}