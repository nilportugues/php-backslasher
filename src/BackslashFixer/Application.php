<?php

namespace NilPortugues\BackslashFixer;

use CLIFramework\Application as CliApp;
use NilPortugues\BackslashFixer\Command\FixCommand;

class Application extends CliApp
{
    const NAME = 'PHP Function BackSlasher';
    const BIN_NAME = 'php_backslasher';
    const VERSION = '1.0.0';
    const REPOSITORY = 'nilportugues/php_backslasher';

    /**
     * @var bool
     */
    public $showAppSignature = false;

    /**
     * @param $opts
     */
    public function options($opts)
    {
        // parent::options($opts);
    }

    /**
     * @return string
     */
    public function brief()
    {
        $command = new FixCommand();
        return sprintf(
            "\n------------------------------------------------------------------------------\n".
            " %s v %s                             by Nil Portugués".
            "\n------------------------------------------------------------------------------\n".
            "\n%s",
            self::NAME,
            self::VERSION,
            $command->brief()
        );
    }


    /**
     *
     */
    public function init()
    {
        parent::init();

        $this->command('fix');
        $this->command('self-update');
    }
}
