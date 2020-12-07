<?php
/* This file has been prefixed by <PHP-Prefixer> for "XT Laravel Starter for Joomla" */

/*
 * This file is part of Psy Shell.
 *
 * (c) 2012-2020 Justin Hileman
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Extly\Psy\Command;

use Extly\PhpParser\NodeTraverser;
use Extly\PhpParser\PrettyPrinter\Standard as Printer;
use Extly\Psy\Input\CodeArgument;
use Extly\Psy\ParserFactory;
use Extly\Psy\Readline\Readline;
use Extly\Psy\Sudo\SudoVisitor;
use Extly\Symfony\Component\Console\Input\InputInterface;
use Extly\Symfony\Component\Console\Output\OutputInterface;

/**
 * Evaluate PHP code, bypassing visibility restrictions.
 */
class SudoCommand extends Command
{
    private $readline;
    private $parser;
    private $traverser;
    private $printer;

    /**
     * {@inheritdoc}
     */
    public function __construct($name = null)
    {
        $parserFactory = new ParserFactory();
        $this->parser = $parserFactory->createParser();

        $this->traverser = new NodeTraverser();
        $this->traverser->addVisitor(new SudoVisitor());

        $this->printer = new Printer();

        parent::__construct($name);
    }

    /**
     * Set the Shell's Readline service.
     *
     * @param Readline $readline
     */
    public function setReadline(Readline $readline)
    {
        $this->readline = $readline;
    }

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('sudo')
            ->setDefinition([
                new CodeArgument('code', CodeArgument::REQUIRED, 'Code to execute.'),
            ])
            ->setDescription('Evaluate PHP code, bypassing visibility restrictions.')
            ->setHelp(
                <<<'HELP'
Evaluate PHP code, bypassing visibility restrictions.

e.g.
<return>>>> $sekret->whisper("hi")</return>
<return>PHP error:  Call to private method Sekret::whisper() from context '' on line 1</return>

<return>>>> sudo $sekret->whisper("hi")</return>
<return>=> "hi"</return>

<return>>>> $sekret->word</return>
<return>PHP error:  Cannot access private property Sekret::$word on line 1</return>

<return>>>> sudo $sekret->word</return>
<return>=> "hi"</return>

<return>>>> $sekret->word = "please"</return>
<return>PHP error:  Cannot access private property Sekret::$word on line 1</return>

<return>>>> sudo $sekret->word = "please"</return>
<return>=> "please"</return>
HELP
            );
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $code = $input->getArgument('code');

        // special case for !!
        if ($code === '!!') {
            $history = $this->readline->listHistory();
            if (\count($history) < 2) {
                throw new \InvalidArgumentException('No previous command to replay');
            }
            $code = $history[\count($history) - 2];
        }

        if (\strpos($code, '<?') === false) {
            $code = '<?php '.$code;
        }

        $nodes = $this->traverser->traverse($this->parse($code));

        $sudoCode = $this->printer->prettyPrint($nodes);
        $shell = $this->getApplication();
        $shell->addCode($sudoCode, !$shell->hasCode());

        return 0;
    }

    /**
     * Lex and parse a string of code into statements.
     *
     * @param string $code
     *
     * @return array Statements
     */
    private function parse($code)
    {
        try {
            return $this->parser->parse($code);
        } catch (\Extly\PhpParser\Error $e) {
            if (\strpos($e->getMessage(), 'unexpected EOF') === false) {
                throw $e;
            }

            // If we got an unexpected EOF, let's try it again with a semicolon.
            return $this->parser->parse($code.';');
        }
    }
}
