<?php
/* This file has been prefixed by <PHP-Prefixer> for "XT Laravel Starter for Joomla" */

/**
 * This file is part of the Carbon package.
 *
 * (c) Brian Nesbitt <brian@nesbot.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Extly\Carbon\Exceptions;

use Extly\Carbon\CarbonInterface;
use Exception;
use InvalidArgumentException as BaseInvalidArgumentException;

class NotACarbonClassException extends BaseInvalidArgumentException implements InvalidArgumentException
{
    /**
     * Constructor.
     *
     * @param string         $className
     * @param int            $code
     * @param Exception|null $previous
     */
    public function __construct($className, $code = 0, Exception $previous = null)
    {
        parent::__construct(sprintf(
            'Given class does not implement %s: %s',
            CarbonInterface::class,
            $className
        ), $code, $previous);
    }
}
