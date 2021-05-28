<?php /* This file has been prefixed by <PHP-Prefixer> for "XT Laravel Starter for Joomla" */
declare(strict_types=1);

namespace Extly\PhpParser\Node\Scalar\MagicConst;

use Extly\PhpParser\Node\Scalar\MagicConst;

class Trait_ extends MagicConst
{
    public function getName() : string {
        return '__TRAIT__';
    }
    
    public function getType() : string {
        return 'Scalar_MagicConst_Trait';
    }
}
