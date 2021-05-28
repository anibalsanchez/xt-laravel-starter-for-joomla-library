<?php /* This file has been prefixed by <PHP-Prefixer> for "XT Laravel Starter for Joomla" */

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

class MarkdownConverter extends Converter
{
    /** @var EnvironmentInterface */
    protected $environment;

    public function __construct(EnvironmentInterface $environment)
    {
        $this->environment = $environment;

        parent::__construct(new DocParser($environment), new HtmlRenderer($environment));
    }

    public function getEnvironment(): EnvironmentInterface
    {
        return $this->environment;
    }
}
