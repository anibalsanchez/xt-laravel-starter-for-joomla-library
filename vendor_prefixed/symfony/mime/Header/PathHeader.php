<?php
/* This file has been prefixed by <PHP-Prefixer> for "XT Laravel Starter for Joomla" */

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Extly\Symfony\Component\Mime\Header;

use Extly\Symfony\Component\Mime\Address;
use Extly\Symfony\Component\Mime\Exception\RfcComplianceException;

/**
 * A Path Header, such a Return-Path (one address).
 *
 * @author Chris Corbyn
 */
final class PathHeader extends AbstractHeader
{
    private $address;

    public function __construct(string $name, Address $address)
    {
        parent::__construct($name);

        $this->setAddress($address);
    }

    /**
     * @param Address $body
     *
     * @throws RfcComplianceException
     */
    public function setBody($body)
    {
        $this->setAddress($body);
    }

    public function getBody(): Address
    {
        return $this->getAddress();
    }

    public function setAddress(Address $address)
    {
        $this->address = $address;
    }

    public function getAddress(): Address
    {
        return $this->address;
    }

    public function getBodyAsString(): string
    {
        return '<'.$this->address->toString().'>';
    }
}
