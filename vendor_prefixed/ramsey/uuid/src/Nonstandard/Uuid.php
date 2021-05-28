<?php
/* This file has been prefixed by <PHP-Prefixer> for "XT Laravel Starter for Joomla" */

/**
 * This file is part of the ramsey/uuid library
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @copyright Copyright (c) Ben Ramsey <ben@benramsey.com>
 * @license http://opensource.org/licenses/MIT MIT
 */

declare(strict_types=1);

namespace Extly\Ramsey\Uuid\Nonstandard;

use Extly\Ramsey\Uuid\Codec\CodecInterface;
use Extly\Ramsey\Uuid\Converter\NumberConverterInterface;
use Extly\Ramsey\Uuid\Converter\TimeConverterInterface;
use Extly\Ramsey\Uuid\Uuid as BaseUuid;
use Extly\Ramsey\Uuid\UuidInterface;

/**
 * Nonstandard\Uuid is a UUID that doesn't conform to RFC 4122
 *
 * @psalm-immutable
 */
final class Uuid extends BaseUuid implements UuidInterface
{
    public function __construct(
        Fields $fields,
        NumberConverterInterface $numberConverter,
        CodecInterface $codec,
        TimeConverterInterface $timeConverter
    ) {
        parent::__construct($fields, $numberConverter, $codec, $timeConverter);
    }
}
