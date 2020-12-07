<?php
/* This file has been prefixed by <PHP-Prefixer> for "XT Laravel Starter for Joomla" */

namespace Extly\Illuminate\Foundation\Auth;

use Extly\Illuminate\Auth\Authenticatable;
use Extly\Illuminate\Auth\MustVerifyEmail;
use Extly\Illuminate\Auth\Passwords\CanResetPassword;
use Extly\Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Extly\Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Extly\Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Extly\Illuminate\Database\Eloquent\Model;
use Extly\Illuminate\Foundation\Auth\Access\Authorizable;

class User extends Model implements
    AuthenticatableContract,
    AuthorizableContract,
    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword, MustVerifyEmail;
}
