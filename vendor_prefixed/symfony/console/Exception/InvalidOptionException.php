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

namespace Extly\Symfony\Component\Console\Exception;

/**
 * Represents an incorrect option name typed in the console.
 *
 * @author Jérôme Tamarelle <jerome@tamarelle.net>
 */
class InvalidOptionException extends \InvalidArgumentException implements ExceptionInterface
{
}
