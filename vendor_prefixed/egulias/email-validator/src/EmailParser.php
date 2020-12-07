<?php
/* This file has been prefixed by <PHP-Prefixer> for "XT Laravel Starter for Joomla" */

namespace Extly\Egulias\EmailValidator;

use Extly\Egulias\EmailValidator\Exception\ExpectingATEXT;
use Extly\Egulias\EmailValidator\Exception\NoLocalPart;
use Extly\Egulias\EmailValidator\Parser\DomainPart;
use Extly\Egulias\EmailValidator\Parser\LocalPart;
use Extly\Egulias\EmailValidator\Warning\EmailTooLong;

/**
 * EmailParser
 *
 * @author Eduardo Gulias Davis <me@egulias.com>
 */
class EmailParser
{
    const EMAIL_MAX_LENGTH = 254;

    /**
     * @var array
     */
    protected $warnings = [];

    /**
     * @var string
     */
    protected $domainPart = '';

    /**
     * @var string
     */
    protected $localPart = '';
    /**
     * @var EmailLexer
     */
    protected $lexer;

    /**
     * @var LocalPart
     */
    protected $localPartParser;

    /**
     * @var DomainPart
     */
    protected $domainPartParser;

    public function __construct(EmailLexer $lexer)
    {
        $this->lexer = $lexer;
        $this->localPartParser = new LocalPart($this->lexer);
        $this->domainPartParser = new DomainPart($this->lexer);
    }

    /**
     * @param string $str
     * @return array
     */
    public function parse($str)
    {
        $this->lexer->setInput($str);

        if (!$this->hasAtToken()) {
            throw new NoLocalPart();
        }


        $this->localPartParser->parse($str);
        $this->domainPartParser->parse($str);

        $this->setParts($str);

        if ($this->lexer->hasInvalidTokens()) {
            throw new ExpectingATEXT();
        }

        return array('local' => $this->localPart, 'domain' => $this->domainPart);
    }

    /**
     * @return Warning\Warning[]
     */
    public function getWarnings()
    {
        $localPartWarnings = $this->localPartParser->getWarnings();
        $domainPartWarnings = $this->domainPartParser->getWarnings();
        $this->warnings = array_merge($localPartWarnings, $domainPartWarnings);

        $this->addLongEmailWarning($this->localPart, $this->domainPart);

        return $this->warnings;
    }

    /**
     * @return string
     */
    public function getParsedDomainPart()
    {
        return $this->domainPart;
    }

    /**
     * @param string $email
     */
    protected function setParts($email)
    {
        $parts = explode('@', $email);
        $this->domainPart = $this->domainPartParser->getDomainPart();
        $this->localPart = $parts[0];
    }

    /**
     * @return bool
     */
    protected function hasAtToken()
    {
        $this->lexer->moveNext();
        $this->lexer->moveNext();
        if ($this->lexer->token['type'] === EmailLexer::S_AT) {
            return false;
        }

        return true;
    }

    /**
     * @param string $localPart
     * @param string $parsedDomainPart
     */
    protected function addLongEmailWarning($localPart, $parsedDomainPart)
    {
        if (strlen($localPart . '@' . $parsedDomainPart) > self::EMAIL_MAX_LENGTH) {
            $this->warnings[EmailTooLong::CODE] = new EmailTooLong();
        }
    }
}
