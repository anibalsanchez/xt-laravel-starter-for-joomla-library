<?php /* This file has been prefixed by <PHP-Prefixer> for "XT Laravel Starter for Joomla" */
declare(strict_types=1);

namespace Extly\PhpParser\Lexer\TokenEmulator;

use Extly\PhpParser\Lexer\Emulative;

final class FnTokenEmulator extends KeywordEmulator
{
    public function getPhpVersion(): string
    {
        return Emulative::PHP_7_4;
    }

    public function getKeywordString(): string
    {
        return 'fn';
    }

    public function getKeywordToken(): int
    {
        return \T_FN;
    }
}