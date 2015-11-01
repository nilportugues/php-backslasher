<?php

namespace NilPortugues\BackslashFixer\Command;

use NilPortugues\BackslashFixer\Fixer\FileEditor;
use NilPortugues\BackslashFixer\Fixer\PhpFilesRepository;
use CLIFramework\Command;

class FixCommand extends Command
{
    /**
     * @return string
     */
    public function brief()
    {
        return 'Adds all PHP internal functions to its namespace by adding backslash to them.';
    }

    /**
     * register your command here
     */
    public function init()
    {
        parent::init();
    }

    /**
     * init your application options here
     */
    public function options($opts)
    {
        $opts->add('v|verbose', 'verbose message');
        $opts->add('required:', 'required option with a value.');
        $opts->add('optional?', 'optional option with a value');
        $opts->add('multiple+', 'multiple value option.');
    }

    /**
     * Run!!
     */
    public function execute()
    {
        $path = func_get_arg(0);

        $fileEditor = new FileEditor();

        $fileRepository = new PhpFilesRepository();
        $files = $fileRepository->find($path);

        foreach ($files as $file) {
            $fileEditor->addBackslashesToFunctions($file);
        }

        return 0;
    }
}
