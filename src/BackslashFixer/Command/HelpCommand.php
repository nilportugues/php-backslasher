<?php

namespace NilPortugues\BackslashFixer\Command;

use CLIFramework\Command;

class HelpCommand extends Command
{
    /**
     *
     */
    public function execute()
    {
        $args = func_get_args();
        if (empty($args)) {
            $headline = <<<EOS
Your first command line tool.\n
EOS;
            $this->logger->write($this->formatter->format($headline, 'strong_white'));
        }
    }
}
