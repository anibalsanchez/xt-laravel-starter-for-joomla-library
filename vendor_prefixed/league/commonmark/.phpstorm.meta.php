<?php /* This file has been prefixed by <PHP-Prefixer> for "XT Laravel Starter for Joomla" */

/*
 * This file is part of the league/commonmark package.
 *
 * (c) Colin O'Dell <colinodell@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PHPSTORM_META
{
    expectedArguments(\Extly\League\CommonMark\HtmlElement::__construct(), 0, 'a', 'abbr', 'address', 'area', 'article', 'aside', 'audio', 'b', 'base', 'bdi', 'bdo', 'blockquote', 'body', 'br', 'button', 'canvas', 'caption', 'cite', 'code', 'col', 'colgroup', 'data', 'datalist', 'dd', 'del', 'details', 'dfn', 'dialog', 'div', 'dl', 'dt', 'em', 'embed', 'fieldset', 'figure', 'footer', 'form', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'head', 'header', 'hgroup', 'hr', 'html', 'i', 'iframe', 'img', 'input', 'ins', 'kdb', 'keygen', 'label', 'legend', 'li', 'link', 'main', 'map', 'mark', 'menu', 'menuitem', 'meta', 'meter', 'nav', 'noscript', 'object', 'ol', 'optgroup', 'option', 'output', 'p', 'param', 'pre', 'progress', 'q', 's', 'samp', 'script', 'section', 'select', 'small', 'source', 'span', 'strong', 'style', 'sub', 'summary', 'sup', 'table', 'tbody', 'td', 'template', 'textarea', 'tfoot', 'th', 'thead', 'time', 'tr', 'track', 'u', 'ul', 'var', 'video', 'wbr');

    expectedArguments(\Extly\League\CommonMark\Block\Element\Heading::__construct(), 0, 1, 2, 3, 4, 5, 6);
    expectedReturnValues(\Extly\League\CommonMark\Block\Element\Heading::getLevel(), 1, 2, 3, 4, 5, 6);

    registerArgumentsSet('league_commonmark_htmlblock_types', \Extly\League\CommonMark\Block\Element\HtmlBlock::TYPE_1_CODE_CONTAINER, \Extly\League\CommonMark\Block\Element\HtmlBlock::TYPE_2_COMMENT, \Extly\League\CommonMark\Block\Element\HtmlBlock::TYPE_3, \Extly\League\CommonMark\Block\Element\HtmlBlock::TYPE_4, \Extly\League\CommonMark\Block\Element\HtmlBlock::TYPE_5_CDATA, \Extly\League\CommonMark\Block\Element\HtmlBlock::TYPE_6_BLOCK_ELEMENT, \Extly\League\CommonMark\Block\Element\HtmlBlock::TYPE_7_MISC_ELEMENT);
    expectedArguments(\Extly\League\CommonMark\Block\Element\HtmlBlock::__construct(), 0, argumentsSet('league_commonmark_htmlblock_types'));
    expectedArguments(\Extly\League\CommonMark\Block\Element\HtmlBlock::setType(), 0, argumentsSet('league_commonmark_htmlblock_types'));
    expectedReturnValues(\Extly\League\CommonMark\Block\Element\HtmlBlock::getType(), argumentsSet('league_commonmark_htmlblock_types'));
    expectedArguments(\Extly\League\CommonMark\Util\RegexHelper::getHtmlBlockOpenRegex(), 0, argumentsSet('league_commonmark_htmlblock_types'));
    expectedArguments(\Extly\League\CommonMark\Util\RegexHelper::getHtmlBlockCloseRegex(), 0, argumentsSet('league_commonmark_htmlblock_types'));

    registerArgumentsSet('league_commonmark_newline_types', \Extly\League\CommonMark\Inline\Element\Newline::HARDBREAK, \Extly\League\CommonMark\Inline\Element\Newline::SOFTBREAK);
    expectedArguments(\Extly\League\CommonMark\Inline\Element\Newline::__construct(), 0, argumentsSet('league_commonmark_newline_types'));
    expectedReturnValues(\Extly\League\CommonMark\Inline\Element\Newline::getType(), argumentsSet('league_commonmark_newline_types'));

    registerArgumentsSet('league_commonmark_options', 'renderer', 'enable_em', 'enable_strong', 'use_asterisk', 'use_underscore', 'unordered_list_markers', 'html_input', 'allow_unsafe_links', 'max_nesting_level', 'external_link', 'external_link/nofollow', 'external_link/noopener', 'external_link/noreferrer', 'footnote', 'footnote/backref_class', 'footnote/container_add_hr', 'footnote/container_class', 'footnote/ref_class', 'footnote/ref_id_prefix', 'footnote/footnote_class', 'footnote/footnote_id_prefix', 'heading_permalink', 'heading_permalink/html_class', 'heading_permalink/id_prefix', 'heading_permalink/inner_contents', 'heading_permalink/insert', 'heading_permalink/slug_normalizer', 'heading_permalink/symbol', 'heading_permalink/title', 'table_of_contents', 'table_of_contents/style', 'table_of_contents/normalize', 'table_of_contents/position', 'table_of_contents/html_class', 'table_of_contents/min_heading_level', 'table_of_contents/max_heading_level', 'table_of_contents/placeholder');
    expectedArguments(\Extly\League\CommonMark\EnvironmentInterface::getConfig(), 0, argumentsSet('league_commonmark_options'));
    expectedArguments(\Extly\League\CommonMark\Util\ConfigurationInterface::get(), 0, argumentsSet('league_commonmark_options'));
    expectedArguments(\Extly\League\CommonMark\Util\ConfigurationInterface::set(), 0, argumentsSet('league_commonmark_options'));
}
