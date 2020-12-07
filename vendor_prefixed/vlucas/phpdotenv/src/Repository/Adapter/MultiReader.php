<?php
/* This file has been prefixed by <PHP-Prefixer> for "XT Laravel Starter for Joomla" */

declare(strict_types=1);

namespace Extly\Dotenv\Repository\Adapter;

use Extly\PhpOption\None;

final class MultiReader implements ReaderInterface
{
    /**
     * The set of readers to use.
     *
     * @var \Dotenv\Repository\Adapter\ReaderInterface[]
     */
    private $readers;

    /**
     * Create a new multi-reader instance.
     *
     * @param \Dotenv\Repository\Adapter\ReaderInterface[] $readers
     *
     * @return void
     */
    public function __construct(array $readers)
    {
        $this->readers = $readers;
    }

    /**
     * Read an environment variable, if it exists.
     *
     * @param string $name
     *
     * @return \PhpOption\Option<string>
     */
    public function read(string $name)
    {
        foreach ($this->readers as $reader) {
            $result = $reader->read($name);
            if ($result->isDefined()) {
                return $result;
            }
        }

        return None::create();
    }
}
