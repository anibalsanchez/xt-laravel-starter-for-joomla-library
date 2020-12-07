<?php
/* This file has been prefixed by <PHP-Prefixer> for "XT Laravel Starter for Joomla" */

namespace Extly\Illuminate\Database\PDO;

use Extly\Doctrine\DBAL\Driver\AbstractSQLiteDriver;
use Extly\Illuminate\Database\PDO\Concerns\ConnectsToDatabase;

class SQLiteDriver extends AbstractSQLiteDriver
{
    use ConnectsToDatabase;
}
