<?php /* This file has been prefixed by <PHP-Prefixer> for "XT Laravel Starter for Joomla" */

declare(strict_types=1);

namespace Extly\Doctrine\Inflector\Rules;

class Word
{
    /** @var string */
    private $word;

    public function __construct(string $word)
    {
        $this->word = $word;
    }

    public function getWord() : string
    {
        return $this->word;
    }
}
