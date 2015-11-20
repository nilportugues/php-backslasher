<?php


namespace NilPortugues\BackslashFixer\Console;

use NilPortugues\BackslashFixer\Command\FixerCommand;
use NilPortugues\BackslashFixer\Command\RemoverCommand;

class Application extends \Symfony\Component\Console\Application
{
    /**
     * Construct method
     */
    public function __construct()
    {
        parent::__construct('PHP BackSlasher');
    }

    /**
     * Initializes all the composer commands
     *
     * @return \Symfony\Component\Console\Command\Command[]
     */
    protected function getDefaultCommands()
    {
        $commands = parent::getDefaultCommands();
        $commands[] = new FixerCommand();
        $commands[] = new RemoverCommand();

        return $commands;
    }
}
