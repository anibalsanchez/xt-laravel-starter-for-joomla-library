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

use Extly\Illuminate\Support\Facades\Route;
use XtLaravelStarterApp\Models\Article;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $articles = Article::where('state', 1)
        ->orderBy('title', 'asc')
        ->take(10)
        ->get();

    // Production prefixed mode
    if (function_exists('XT_view')) {
        return XT_view('welcome-prefixed', ['articles' => $articles]);
    }

    // Development mode
    return XT_view('welcome', ['articles' => $articles]);
});
