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

namespace Extly\League\CommonMark\Extension\Footnote\Parser;

use Extly\League\CommonMark\Extension\Footnote\Node\FootnoteRef;
use Extly\League\CommonMark\Inline\Parser\InlineParserInterface;
use Extly\League\CommonMark\InlineParserContext;
use Extly\League\CommonMark\Normalizer\SlugNormalizer;
use Extly\League\CommonMark\Normalizer\TextNormalizerInterface;
use Extly\League\CommonMark\Reference\Reference;
use Extly\League\CommonMark\Util\ConfigurationAwareInterface;
use Extly\League\CommonMark\Util\ConfigurationInterface;

final class AnonymousFootnoteRefParser implements InlineParserInterface, ConfigurationAwareInterface
{
    /** @var ConfigurationInterface */
    private $config;

    /** @var TextNormalizerInterface */
    private $slugNormalizer;

    public function __construct()
    {
        $this->slugNormalizer = new SlugNormalizer();
    }

    public function getCharacters(): array
    {
        return ['^'];
    }

    public function parse(InlineParserContext $inlineContext): bool
    {
        $container = $inlineContext->getContainer();
        $cursor = $inlineContext->getCursor();
        $nextChar = $cursor->peek();
        if ($nextChar !== '[') {
            return false;
        }
        $state = $cursor->saveState();

        $m = $cursor->match('/\^\[[^\n^\]]+\]/');
        if ($m !== null) {
            if (\preg_match('#\^\[([^\]]+)\]#', $m, $matches) > 0) {
                $reference = $this->createReference($matches[1]);
                $container->appendChild(new FootnoteRef($reference, $matches[1]));

                return true;
            }
        }

        $cursor->restoreState($state);

        return false;
    }

    private function createReference(string $label): Reference
    {
        $refLabel = $this->slugNormalizer->normalize($label);
        $refLabel = \mb_substr($refLabel, 0, 20);

        return new Reference(
            $refLabel,
            '#' . $this->config->get('footnote/footnote_id_prefix', 'fn:') . $refLabel,
            $label
        );
    }

    public function setConfiguration(ConfigurationInterface $config): void
    {
        $this->config = $config;
    }
}
