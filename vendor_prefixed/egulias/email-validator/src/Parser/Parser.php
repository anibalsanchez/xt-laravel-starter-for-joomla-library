<?php
/* This file has been prefixed by <PHP-Prefixer> for "XT Laravel Starter for Joomla" */

namespace Extly\Egulias\EmailValidator\Parser;

use Extly\Egulias\EmailValidator\EmailLexer;
use Extly\Egulias\EmailValidator\Exception\AtextAfterCFWS;
use Extly\Egulias\EmailValidator\Exception\ConsecutiveDot;
use Extly\Egulias\EmailValidator\Exception\CRLFAtTheEnd;
use Extly\Egulias\EmailValidator\Exception\CRLFX2;
use Extly\Egulias\EmailValidator\Exception\CRNoLF;
use Extly\Egulias\EmailValidator\Exception\ExpectingQPair;
use Extly\Egulias\EmailValidator\Exception\ExpectingATEXT;
use Extly\Egulias\EmailValidator\Exception\ExpectingCTEXT;
use Extly\Egulias\EmailValidator\Exception\UnclosedComment;
use Extly\Egulias\EmailValidator\Exception\UnclosedQuotedString;
use Extly\Egulias\EmailValidator\Warning\CFWSNearAt;
use Extly\Egulias\EmailValidator\Warning\CFWSWithFWS;
use Extly\Egulias\EmailValidator\Warning\Comment;
use Extly\Egulias\EmailValidator\Warning\QuotedPart;
use Extly\Egulias\EmailValidator\Warning\QuotedString;

abstract class Parser
{
    /**
     * @var array
     */
    protected $warnings = [];

    /**
     * @var EmailLexer
     */
    protected $lexer;

    /**
     * @var int
     */
    protected $openedParenthesis = 0;

    public function __construct(EmailLexer $lexer)
    {
        $this->lexer = $lexer;
    }

    /**
     * @return \Egulias\EmailValidator\Warning\Warning[]
     */
    public function getWarnings()
    {
        return $this->warnings;
    }

    /**
     * @param string $str
     */
    abstract public function parse($str);

    /** @return int */
    public function getOpenedParenthesis()
    {
        return $this->openedParenthesis;
    }

    /**
     * validateQuotedPair
     */
    protected function validateQuotedPair()
    {
        if (!($this->lexer->token['type'] === EmailLexer::INVALID
            || $this->lexer->token['type'] === EmailLexer::C_DEL)) {
            throw new ExpectingQPair();
        }

        $this->warnings[QuotedPart::CODE] =
            new QuotedPart($this->lexer->getPrevious()['type'], $this->lexer->token['type']);
    }

    protected function parseComments()
    {
        $this->openedParenthesis = 1;
        $this->isUnclosedComment();
        $this->warnings[Comment::CODE] = new Comment();
        while (!$this->lexer->isNextToken(EmailLexer::S_CLOSEPARENTHESIS)) {
            if ($this->lexer->isNextToken(EmailLexer::S_OPENPARENTHESIS)) {
                $this->openedParenthesis++;
            }
            $this->warnEscaping();
            $this->lexer->moveNext();
        }

        $this->lexer->moveNext();
        if ($this->lexer->isNextTokenAny(array(EmailLexer::GENERIC, EmailLexer::S_EMPTY))) {
            throw new ExpectingATEXT();
        }

        if ($this->lexer->isNextToken(EmailLexer::S_AT)) {
            $this->warnings[CFWSNearAt::CODE] = new CFWSNearAt();
        }
    }

    /**
     * @return bool
     */
    protected function isUnclosedComment()
    {
        try {
            $this->lexer->find(EmailLexer::S_CLOSEPARENTHESIS);
            return true;
        } catch (\RuntimeException $e) {
            throw new UnclosedComment();
        }
    }

    protected function parseFWS()
    {
        $previous = $this->lexer->getPrevious();

        $this->checkCRLFInFWS();

        if ($this->lexer->token['type'] === EmailLexer::S_CR) {
            throw new CRNoLF();
        }

        if ($this->lexer->isNextToken(EmailLexer::GENERIC) && $previous['type']  !== EmailLexer::S_AT) {
            throw new AtextAfterCFWS();
        }

        if ($this->lexer->token['type'] === EmailLexer::S_LF || $this->lexer->token['type'] === EmailLexer::C_NUL) {
            throw new ExpectingCTEXT();
        }

        if ($this->lexer->isNextToken(EmailLexer::S_AT) || $previous['type']  === EmailLexer::S_AT) {
            $this->warnings[CFWSNearAt::CODE] = new CFWSNearAt();
        } else {
            $this->warnings[CFWSWithFWS::CODE] = new CFWSWithFWS();
        }
    }

    protected function checkConsecutiveDots()
    {
        if ($this->lexer->token['type'] === EmailLexer::S_DOT && $this->lexer->isNextToken(EmailLexer::S_DOT)) {
            throw new ConsecutiveDot();
        }
    }

    /**
     * @return bool
     */
    protected function isFWS()
    {
        if ($this->escaped()) {
            return false;
        }

        if ($this->lexer->token['type'] === EmailLexer::S_SP ||
            $this->lexer->token['type'] === EmailLexer::S_HTAB ||
            $this->lexer->token['type'] === EmailLexer::S_CR ||
            $this->lexer->token['type'] === EmailLexer::S_LF ||
            $this->lexer->token['type'] === EmailLexer::CRLF
        ) {
            return true;
        }

        return false;
    }

    /**
     * @return bool
     */
    protected function escaped()
    {
        $previous = $this->lexer->getPrevious();

        if ($previous && $previous['type'] === EmailLexer::S_BACKSLASH
            &&
            $this->lexer->token['type'] !== EmailLexer::GENERIC
        ) {
            return true;
        }

        return false;
    }

    /**
     * @return bool
     */
    protected function warnEscaping()
    {
        if ($this->lexer->token['type'] !== EmailLexer::S_BACKSLASH) {
            return false;
        }

        if ($this->lexer->isNextToken(EmailLexer::GENERIC)) {
            throw new ExpectingATEXT();
        }

        if (!$this->lexer->isNextTokenAny(array(EmailLexer::S_SP, EmailLexer::S_HTAB, EmailLexer::C_DEL))) {
            return false;
        }

        $this->warnings[QuotedPart::CODE] =
            new QuotedPart($this->lexer->getPrevious()['type'], $this->lexer->token['type']);
        return true;

    }

    /**
     * @param bool $hasClosingQuote
     *
     * @return bool
     */
    protected function checkDQUOTE($hasClosingQuote)
    {
        if ($this->lexer->token['type'] !== EmailLexer::S_DQUOTE) {
            return $hasClosingQuote;
        }
        if ($hasClosingQuote) {
            return $hasClosingQuote;
        }
        $previous = $this->lexer->getPrevious();
        if ($this->lexer->isNextToken(EmailLexer::GENERIC) && $previous['type'] === EmailLexer::GENERIC) {
            throw new ExpectingATEXT();
        }

        try {
            $this->lexer->find(EmailLexer::S_DQUOTE);
            $hasClosingQuote = true;
        } catch (\Exception $e) {
            throw new UnclosedQuotedString();
        }
        $this->warnings[QuotedString::CODE] = new QuotedString($previous['value'], $this->lexer->token['value']);

        return $hasClosingQuote;
    }

    protected function checkCRLFInFWS()
    {
        if ($this->lexer->token['type'] !== EmailLexer::CRLF) {
            return;
        }

        if (!$this->lexer->isNextTokenAny(array(EmailLexer::S_SP, EmailLexer::S_HTAB))) {
            throw new CRLFX2();
        }

        if (!$this->lexer->isNextTokenAny(array(EmailLexer::S_SP, EmailLexer::S_HTAB))) {
            throw new CRLFAtTheEnd();
        }
    }
}
