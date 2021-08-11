<?php
/* This file has been prefixed by <PHP-Prefixer> for "XT Laravel Starter for Joomla" */

declare(strict_types=1);

/*
 * This file is part of the league/commonmark package.
 *
 * (c) Colin O'Dell <colinodell@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Extly\League\CommonMark;

use Extly\League\CommonMark\Environment\Environment;
use Extly\League\CommonMark\Extension\CommonMark\CommonMarkCoreExtension;
use Extly\League\CommonMark\Extension\GithubFlavoredMarkdownExtension;

/**
 * Converts GitHub Flavored Markdown to HTML.
 */
final class GithubFlavoredMarkdownConverter extends MarkdownConverter
{
    /**
     * Create a new Markdown converter pre-configured for GFM
     *
     * @param array<string, mixed> $config
     */
    public function __construct(array $config = [])
    {
        $environment = new Environment($config);
        $environment->addExtension(new CommonMarkCoreExtension());
        $environment->addExtension(new GithubFlavoredMarkdownExtension());

        parent::__construct($environment);
    }

    public function getEnvironment(): Environment
    {
        \assert($this->environment instanceof Environment);

        return $this->environment;
    }
}
