<?php /* This file has been prefixed by <PHP-Prefixer> for "XT Laravel Starter for Joomla" */
declare(strict_types=1);

namespace Extly\PhpParser\Node\Expr\BinaryOp;

use Extly\PhpParser\Node\Expr\BinaryOp;

class Plus extends BinaryOp
{
    public function getOperatorSigil() : string {
        return '+';
    }
    
    public function getType() : string {
        return 'Expr_BinaryOp_Plus';
    }
}
