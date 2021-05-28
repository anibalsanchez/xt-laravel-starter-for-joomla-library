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

namespace Extly\Ramsey\Uuid\Builder;

use Extly\Ramsey\Collection\AbstractCollection;
use Extly\Ramsey\Collection\CollectionInterface;
use Extly\Ramsey\Uuid\Converter\Number\GenericNumberConverter;
use Extly\Ramsey\Uuid\Converter\Time\GenericTimeConverter;
use Extly\Ramsey\Uuid\Converter\Time\PhpTimeConverter;
use Extly\Ramsey\Uuid\Guid\GuidBuilder;
use Extly\Ramsey\Uuid\Math\BrickMathCalculator;
use Extly\Ramsey\Uuid\Nonstandard\UuidBuilder as NonstandardUuidBuilder;
use Extly\Ramsey\Uuid\Rfc4122\UuidBuilder as Rfc4122UuidBuilder;
use Traversable;

/**
 * A collection of UuidBuilderInterface objects
 */
class BuilderCollection extends AbstractCollection implements CollectionInterface
{
    public function getType(): string
    {
        return UuidBuilderInterface::class;
    }

    /**
     * @psalm-mutation-free
     * @psalm-suppress ImpureMethodCall
     * @psalm-suppress InvalidTemplateParam
     */
    public function getIterator(): Traversable
    {
        return parent::getIterator();
    }

    /**
     * Re-constructs the object from its serialized form
     *
     * @param string $serialized The serialized PHP string to unserialize into
     *     a UuidInterface instance
     *
     * @phpcsSuppress SlevomatCodingStandard.TypeHints.ParameterTypeHint.MissingNativeTypeHint
     */
    public function unserialize($serialized): void
    {
        /** @var mixed[] $data */
        $data = unserialize($serialized, [
            'allowed_classes' => [
                BrickMathCalculator::class,
                GenericNumberConverter::class,
                GenericTimeConverter::class,
                GuidBuilder::class,
                NonstandardUuidBuilder::class,
                PhpTimeConverter::class,
                Rfc4122UuidBuilder::class,
            ],
        ]);

        $this->data = $data;
    }
}
