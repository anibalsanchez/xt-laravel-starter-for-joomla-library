<?php
/* This file has been prefixed by <PHP-Prefixer> for "XT Laravel Starter for Joomla" */

namespace Extly\Egulias\EmailValidator\Validation;

use Extly\Egulias\EmailValidator\EmailLexer;
use Extly\Egulias\EmailValidator\Exception\InvalidEmail;
use Extly\Egulias\EmailValidator\Validation\Error\SpoofEmail;
use \Spoofchecker;

class SpoofCheckValidation implements EmailValidation
{
    /**
     * @var InvalidEmail|null
     */
    private $error;

    public function __construct()
    {
        if (!extension_loaded('intl')) {
            throw new \LogicException(sprintf('The %s class requires the Intl extension.', __CLASS__));
        }
    }

    /**
     * @psalm-suppress InvalidArgument
     */
    public function isValid($email, EmailLexer $emailLexer)
    {
        $checker = new Spoofchecker();
        $checker->setChecks(Spoofchecker::SINGLE_SCRIPT);

        if ($checker->isSuspicious($email)) {
            $this->error = new SpoofEmail();
        }

        return $this->error === null;
    }

    /**
     * @return InvalidEmail|null
     */
    public function getError()
    {
        return $this->error;
    }

    public function getWarnings()
    {
        return [];
    }
}
