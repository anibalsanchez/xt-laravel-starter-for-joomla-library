<?php /* This file has been prefixed by <PHP-Prefixer> for "XT Laravel Starter for Joomla" */

/*
 * This file is part of the league/commonmark package.
 *
 * (c) Colin O'Dell <colinodell@gmail.com>
 * (c) Rezo Zero / Ambroise Maupate
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Extly\League\CommonMark\Extension\Footnote\Node;

use Extly\League\CommonMark\Block\Element\AbstractBlock;
use Extly\League\CommonMark\Cursor;
use Extly\League\CommonMark\Reference\ReferenceInterface;

/**
 * @method children() AbstractBlock[]
 */
final class Footnote extends AbstractBlock
{
    /**
     * @var FootnoteBackref[]
     */
    private $backrefs = [];

    /**
     * @var ReferenceInterface
     */
    private $reference;

    public function __construct(ReferenceInterface $reference)
    {
        $this->reference = $reference;
    }

    public function canContain(AbstractBlock $block): bool
    {
        return true;
    }

    public function isCode(): bool
    {
        return false;
    }

    public function matchesNextLine(Cursor $cursor): bool
    {
        return false;
    }

    public function getReference(): ReferenceInterface
    {
        return $this->reference;
    }

    public function addBackref(FootnoteBackref $backref): self
    {
        $this->backrefs[] = $backref;

        return $this;
    }

    /**
     * @return FootnoteBackref[]
     */
    public function getBackrefs(): array
    {
        return $this->backrefs;
    }
}
