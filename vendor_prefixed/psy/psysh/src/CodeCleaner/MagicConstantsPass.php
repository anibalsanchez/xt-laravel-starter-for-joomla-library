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

use Extly\PhpParser\Node;
use Extly\PhpParser\Node\Expr\FuncCall;
use Extly\PhpParser\Node\Name;
use Extly\PhpParser\Node\Scalar\MagicConst\Dir;
use Extly\PhpParser\Node\Scalar\MagicConst\File;
use Extly\PhpParser\Node\Scalar\String_;

/**
 * Swap out __DIR__ and __FILE__ magic constants with our best guess?
 */
class MagicConstantsPass extends CodeCleanerPass
{
    /**
     * Swap out __DIR__ and __FILE__ constants, because the default ones when
     * calling eval() don't make sense.
     *
     * @param Node $node
     *
     * @return FuncCall|String_|null
     */
    public function enterNode(Node $node)
    {
        if ($node instanceof Dir) {
            return new FuncCall(new Name('getcwd'), [], $node->getAttributes());
        } elseif ($node instanceof File) {
            return new String_('', $node->getAttributes());
        }
    }
}
