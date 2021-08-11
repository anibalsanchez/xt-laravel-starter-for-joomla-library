<?php
/* This file has been prefixed by <PHP-Prefixer> for "XT Laravel Starter for Joomla" */

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

use Extly\League\CommonMark\Node\Inline\AbstractInline;
use Extly\League\CommonMark\Reference\ReferenceInterface;
use Extly\League\CommonMark\Reference\ReferenceableInterface;

final class FootnoteRef extends AbstractInline implements ReferenceableInterface
{
    private ReferenceInterface $reference;

    /** @psalm-readonly */
    private ?string $content = null;

    /**
     * @param array<mixed> $data
     */
    public function __construct(ReferenceInterface $reference, ?string $content = null, array $data = [])
    {
        parent::__construct();

        $this->reference = $reference;
        $this->content   = $content;

        $this->data->import($data);
    }

    public function getReference(): ReferenceInterface
    {
        return $this->reference;
    }

    public function setReference(ReferenceInterface $reference): void
    {
        $this->reference = $reference;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }
}
