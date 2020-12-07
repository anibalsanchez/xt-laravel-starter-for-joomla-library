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

namespace Extly\League\CommonMark\Extension\Footnote;

use Extly\League\CommonMark\ConfigurableEnvironmentInterface;
use Extly\League\CommonMark\Event\DocumentParsedEvent;
use Extly\League\CommonMark\Extension\ExtensionInterface;
use Extly\League\CommonMark\Extension\Footnote\Event\AnonymousFootnotesListener;
use Extly\League\CommonMark\Extension\Footnote\Event\GatherFootnotesListener;
use Extly\League\CommonMark\Extension\Footnote\Event\NumberFootnotesListener;
use Extly\League\CommonMark\Extension\Footnote\Node\Footnote;
use Extly\League\CommonMark\Extension\Footnote\Node\FootnoteBackref;
use Extly\League\CommonMark\Extension\Footnote\Node\FootnoteContainer;
use Extly\League\CommonMark\Extension\Footnote\Node\FootnoteRef;
use Extly\League\CommonMark\Extension\Footnote\Parser\AnonymousFootnoteRefParser;
use Extly\League\CommonMark\Extension\Footnote\Parser\FootnoteParser;
use Extly\League\CommonMark\Extension\Footnote\Parser\FootnoteRefParser;
use Extly\League\CommonMark\Extension\Footnote\Renderer\FootnoteBackrefRenderer;
use Extly\League\CommonMark\Extension\Footnote\Renderer\FootnoteContainerRenderer;
use Extly\League\CommonMark\Extension\Footnote\Renderer\FootnoteRefRenderer;
use Extly\League\CommonMark\Extension\Footnote\Renderer\FootnoteRenderer;

final class FootnoteExtension implements ExtensionInterface
{
    public function register(ConfigurableEnvironmentInterface $environment)
    {
        $environment->addBlockParser(new FootnoteParser(), 51);
        $environment->addInlineParser(new AnonymousFootnoteRefParser(), 35);
        $environment->addInlineParser(new FootnoteRefParser(), 51);

        $environment->addBlockRenderer(FootnoteContainer::class, new FootnoteContainerRenderer());
        $environment->addBlockRenderer(Footnote::class, new FootnoteRenderer());

        $environment->addInlineRenderer(FootnoteRef::class, new FootnoteRefRenderer());
        $environment->addInlineRenderer(FootnoteBackref::class, new FootnoteBackrefRenderer());

        $environment->addEventListener(DocumentParsedEvent::class, [new AnonymousFootnotesListener(), 'onDocumentParsed']);
        $environment->addEventListener(DocumentParsedEvent::class, [new NumberFootnotesListener(), 'onDocumentParsed']);
        $environment->addEventListener(DocumentParsedEvent::class, [new GatherFootnotesListener(), 'onDocumentParsed']);
    }
}
