<?php /* This file has been prefixed by <PHP-Prefixer> for "XT Laravel Starter for Joomla" */

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

use Extly\League\CommonMark\Block\Element\AbstractBlock;
use Extly\League\CommonMark\Block\Element\AbstractStringContainerBlock;
use Extly\League\CommonMark\Block\Element\InlineContainerInterface;
use Extly\League\CommonMark\ContextInterface;
use Extly\League\CommonMark\Cursor;

final class Table extends AbstractStringContainerBlock implements InlineContainerInterface
{
    /** @var TableSection */
    private $head;
    /** @var TableSection */
    private $body;
    /** @var \Closure */
    private $parser;

    public function __construct(\Closure $parser)
    {
        parent::__construct();
        $this->appendChild($this->head = new TableSection(TableSection::TYPE_HEAD));
        $this->appendChild($this->body = new TableSection(TableSection::TYPE_BODY));
        $this->parser = $parser;
    }

    public function canContain(AbstractBlock $block): bool
    {
        return $block instanceof TableSection;
    }

    public function isCode(): bool
    {
        return false;
    }

    public function getHead(): TableSection
    {
        return $this->head;
    }

    public function getBody(): TableSection
    {
        return $this->body;
    }

    public function matchesNextLine(Cursor $cursor): bool
    {
        return call_user_func($this->parser, $cursor, $this);
    }

    public function handleRemainingContents(ContextInterface $context, Cursor $cursor): void
    {
    }
}
