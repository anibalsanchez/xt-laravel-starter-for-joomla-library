<?php
/* This file has been prefixed by <PHP-Prefixer> for "XT Laravel Starter for Joomla" */

namespace Extly\Egulias\EmailValidator\Validation;

use Extly\Egulias\EmailValidator\EmailLexer;
use Extly\Egulias\EmailValidator\Exception\InvalidEmail;
use Extly\Egulias\EmailValidator\Validation\Error\RFCWarnings;

class NoRFCWarningsValidation extends RFCValidation
{
    /**
     * @var InvalidEmail|null
     */
    private $error;

    /**
     * {@inheritdoc}
     */
    public function isValid($email, EmailLexer $emailLexer)
    {
        if (!parent::isValid($email, $emailLexer)) {
            return false;
        }

        if (empty($this->getWarnings())) {
            return true;
        }

        $this->error = new RFCWarnings();

        return false;
    }

    /**
     * {@inheritdoc}
     */
    public function getError()
    {
        return $this->error ?: parent::getError();
    }
}
