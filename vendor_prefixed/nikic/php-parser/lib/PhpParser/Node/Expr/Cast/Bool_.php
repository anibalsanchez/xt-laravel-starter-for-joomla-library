<?php /* This file has been prefixed by <PHP-Prefixer> for "XT Laravel Starter for Joomla" */
declare(strict_types=1);

namespace Extly\PhpParser\Node\Expr\Cast;

use Extly\PhpParser\Node\Expr\Cast;

class Bool_ extends Cast
{
    public function getType() : string {
        return 'Expr_Cast_Bool';
    }
}
