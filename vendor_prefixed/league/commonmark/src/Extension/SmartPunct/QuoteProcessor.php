<?php
/* This file has been prefixed by <PHP-Prefixer> for "XT Laravel Starter for Joomla" */

declare(strict_types=1);

/*
 * This file is part of the league/commonmark package.
 *
 * (c) Colin O'Dell <colinodell@gmail.com>
 *
 * Original code based on the CommonMark JS reference parser (http://bitly.com/commonmark-js)
 *  - (c) John MacFarlane
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Extly\League\CommonMark\Extension\SmartPunct;

use Extly\League\CommonMark\Delimiter\DelimiterInterface;
use Extly\League\CommonMark\Delimiter\Processor\DelimiterProcessorInterface;
use Extly\League\CommonMark\Node\Inline\AbstractStringContainer;

final class QuoteProcessor implements DelimiterProcessorInterface
{
    /** @psalm-readonly */
    private string $normalizedCharacter;

    /** @psalm-readonly */
    private string $openerCharacter;

    /** @psalm-readonly */
    private string $closerCharacter;

    private function __construct(string $char, string $opener, string $closer)
    {
        $this->normalizedCharacter = $char;
        $this->openerCharacter     = $opener;
        $this->closerCharacter     = $closer;
    }

    public function getOpeningCharacter(): string
    {
        return $this->normalizedCharacter;
    }

    public function getClosingCharacter(): string
    {
        return $this->normalizedCharacter;
    }

    public function getMinLength(): int
    {
        return 1;
    }

    public function getDelimiterUse(DelimiterInterface $opener, DelimiterInterface $closer): int
    {
        return 1;
    }

    public function process(AbstractStringContainer $opener, AbstractStringContainer $closer, int $delimiterUse): void
    {
        $opener->insertAfter(new Quote($this->openerCharacter));
        $closer->insertBefore(new Quote($this->closerCharacter));
    }

    /**
     * Create a double-quote processor
     */
    public static function createDoubleQuoteProcessor(string $opener = Quote::DOUBLE_QUOTE_OPENER, string $closer = Quote::DOUBLE_QUOTE_CLOSER): self
    {
        return new self(Quote::DOUBLE_QUOTE, $opener, $closer);
    }

    /**
     * Create a single-quote processor
     */
    public static function createSingleQuoteProcessor(string $opener = Quote::SINGLE_QUOTE_OPENER, string $closer = Quote::SINGLE_QUOTE_CLOSER): self
    {
        return new self(Quote::SINGLE_QUOTE, $opener, $closer);
    }
}
