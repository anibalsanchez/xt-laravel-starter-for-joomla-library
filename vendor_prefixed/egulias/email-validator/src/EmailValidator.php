<?php
/* This file has been prefixed by <PHP-Prefixer> for "XT Laravel Starter for Joomla" */

namespace Extly\Egulias\EmailValidator;

use Extly\Egulias\EmailValidator\Exception\InvalidEmail;
use Extly\Egulias\EmailValidator\Validation\EmailValidation;

class EmailValidator
{
    /**
     * @var EmailLexer
     */
    private $lexer;

    /**
     * @var Warning\Warning[]
     */
    protected $warnings = [];

    /**
     * @var InvalidEmail|null
     */
    protected $error;

    public function __construct()
    {
        $this->lexer = new EmailLexer();
    }

    /**
     * @param string          $email
     * @param EmailValidation $emailValidation
     * @return bool
     */
    public function isValid($email, EmailValidation $emailValidation)
    {
        $isValid = $emailValidation->isValid($email, $this->lexer);
        $this->warnings = $emailValidation->getWarnings();
        $this->error = $emailValidation->getError();

        return $isValid;
    }

    /**
     * @return boolean
     */
    public function hasWarnings()
    {
        return !empty($this->warnings);
    }

    /**
     * @return array
     */
    public function getWarnings()
    {
        return $this->warnings;
    }

    /**
     * @return InvalidEmail|null
     */
    public function getError()
    {
        return $this->error;
    }
}
