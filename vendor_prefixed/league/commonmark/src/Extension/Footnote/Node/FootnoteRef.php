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

use Extly\League\CommonMark\Inline\Element\AbstractInline;
use Extly\League\CommonMark\Reference\ReferenceInterface;

final class FootnoteRef extends AbstractInline
{
    /** @var ReferenceInterface */
    private $reference;

    /** @var string|null */
    private $content;

    /**
     * @param ReferenceInterface $reference
     * @param string|null        $content
     * @param array<mixed>       $data
     */
    public function __construct(ReferenceInterface $reference, ?string $content = null, array $data = [])
    {
        $this->reference = $reference;
        $this->content = $content;
        $this->data = $data;
    }

    public function getReference(): ReferenceInterface
    {
        return $this->reference;
    }

    public function setReference(ReferenceInterface $reference): FootnoteRef
    {
        $this->reference = $reference;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }
}
