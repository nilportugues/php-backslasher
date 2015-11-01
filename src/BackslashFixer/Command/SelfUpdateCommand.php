<?php

namespace NilPortugues\BackslashFixer\Command;

use NilPortugues\BackslashFixer\Application;
use CLIFramework\Command;
use Exception;
use RuntimeException;

class SelfUpdateCommand extends Command
{
    /**
     * @return string
     */
    public function brief()
    {
        return 'Updates ' . Application::NAME . ' to the latest version';
    }

    /**
     * @throws \RuntimeException
     * @throws \Exception
     */
    public function execute()
    {
        global $argv;
        $script = realpath($argv[0]);

        if (!is_writable($script)) {
            throw new \Exception("$script is not writable.");
        }

        // fetch new version
        $this->logger->info("Updating $script...");

        $pharFile = strtolower(Application::BIN_NAME);
        $url = sprintf('https://github.com/%s/blob/master/bin/%s?raw=true', Application::REPOSITORY, $pharFile);

        $code = system("curl -# -L $url > $script");
        if (false === $code) {
            throw new RuntimeException('Update Failed', 1);
        }

        $this->logger->info('Version updated.');
        system($script . ' --version');
    }
}
