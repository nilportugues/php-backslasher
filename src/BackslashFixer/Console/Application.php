<?php


namespace NilPortugues\BackslashFixer\Console;

use NilPortugues\BackslashFixer\Command\FixerCommand;
use Symfony\Component\Console\Application as BaseApplication;


/**
 * Class Application
 */
class Application extends BaseApplication
{
    /**
     * Construct method
     */
    public function __construct()
    {
        parent::__construct('PHP Function BackSlasher');
    }

    /**
     * Initializes all the composer commands
     */
    protected function getDefaultCommands()
    {
        $commands = parent::getDefaultCommands();
        $commands[] = new FixerCommand();

        return $commands;
    }
}
