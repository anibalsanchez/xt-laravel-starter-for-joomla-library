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

namespace Extly\Psy\CodeCleaner;

use Extly\PhpParser\Node\Expr\New_;
use Extly\PhpParser\Node\Name\FullyQualified as FullyQualifiedName;

/**
 * A class used internally by CodeCleaner to represent input, such as
 * non-expression statements, with no return value.
 *
 * Note that user code returning an instance of this class will act like it
 * has no return value, so you prolly shouldn't do that.
 */
class NoReturnValue
{
    /**
     * Get PhpParser AST expression for creating a new NoReturnValue.
     *
     * @return \PhpParser\Node\Expr\New_
     */
    public static function create()
    {
        return new New_(new FullyQualifiedName(self::class));
    }
}
