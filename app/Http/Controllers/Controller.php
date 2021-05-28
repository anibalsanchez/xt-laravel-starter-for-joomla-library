<?php
/* This file has been prefixed by <PHP-Prefixer> for "XT Laravel Starter for Joomla" */

/*
 * @package    XT Laravel Starter for Joomla
 *
 * @author     Extly, CB <team@extly.com>
 * @copyright  Copyright (c)2012-2020 Extly, CB All rights reserved.
 * @license    GNU General Public License version 3 or later; see LICENSE.txt
 * @link       https://www.extly.com
 */

namespace XtLaravelStarterApp\Http\Controllers;

use Extly\Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Extly\Illuminate\Foundation\Bus\DispatchesJobs;
use Extly\Illuminate\Foundation\Validation\ValidatesRequests;
use Extly\Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests;
    use DispatchesJobs;
    use ValidatesRequests;
}
