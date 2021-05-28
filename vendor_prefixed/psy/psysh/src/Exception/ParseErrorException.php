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

namespace Extly\Psy\Exception;

/**
 * A "parse error" Exception for Psy.
 */
class ParseErrorException extends \Extly\PhpParser\Error implements Exception
{
    /**
     * Constructor!
     *
     * @param string $message (default: "")
     * @param int    $line    (default: -1)
     */
    public function __construct($message = '', $line = -1)
    {
        $message = \sprintf('PHP Parse error: %s', $message);
        parent::__construct($message, $line);
    }

    /**
     * Create a ParseErrorException from a PhpParser Error.
     *
     * @param \PhpParser\Error $e
     *
     * @return ParseErrorException
     */
    public static function fromParseError(\Extly\PhpParser\Error $e)
    {
        return new self($e->getRawMessage(), $e->getStartLine());
    }
}
