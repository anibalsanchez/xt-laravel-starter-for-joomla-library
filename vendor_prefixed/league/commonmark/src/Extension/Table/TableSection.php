<?php
/* This file has been prefixed by <PHP-Prefixer> for "XT Laravel Starter for Joomla" */

declare(strict_types=1);

/*
 * This is part of the league/commonmark package.
 *
 * (c) Martin Hasoň <martin.hason@gmail.com>
 * (c) Webuni s.r.o. <info@webuni.cz>
 * (c) Colin O'Dell <colinodell@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Extly\League\CommonMark\Extension\Table;

use Extly\League\CommonMark\Node\Block\AbstractBlock;

final class TableSection extends AbstractBlock
{
    public const TYPE_HEAD = 'head';
    public const TYPE_BODY = 'body';

    /**
     * @psalm-var self::TYPE_*
     * @phpstan-var self::TYPE_*
     *
     * @psalm-readonly
     */
    private string $type;

    /**
     * @psalm-param self::TYPE_* $type
     *
     * @phpstan-param self::TYPE_* $type
     */
    public function __construct(string $type = self::TYPE_BODY)
    {
        parent::__construct();

        $this->type = $type;
    }

    /**
     * @psalm-return self::TYPE_*
     *
     * @phpstan-return self::TYPE_*
     */
    public function getType(): string
    {
        return $this->type;
    }

    public function isHead(): bool
    {
        return $this->type === self::TYPE_HEAD;
    }

    public function isBody(): bool
    {
        return $this->type === self::TYPE_BODY;
    }
}
