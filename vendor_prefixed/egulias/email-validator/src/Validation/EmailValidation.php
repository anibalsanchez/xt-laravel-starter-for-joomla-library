<?php
/* This file has been prefixed by <PHP-Prefixer> for "XT Laravel Starter for Joomla" */

namespace Extly\Egulias\EmailValidator\Validation;

use Extly\Egulias\EmailValidator\EmailLexer;
use Extly\Egulias\EmailValidator\Exception\InvalidEmail;
use Extly\Egulias\EmailValidator\Warning\Warning;

interface EmailValidation
{
    /**
     * Returns true if the given email is valid.
     *
     * @param string     $email      The email you want to validate.
     * @param EmailLexer $emailLexer The email lexer.
     *
     * @return bool
     */
    public function isValid($email, EmailLexer $emailLexer);

    /**
     * Returns the validation error.
     *
     * @return InvalidEmail|null
     */
    public function getError();

    /**
     * Returns the validation warnings.
     *
     * @return Warning[]
     */
    public function getWarnings();
}
