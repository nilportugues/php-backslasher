<?php

namespace NilPortugues\BackslashFixer\Command;

use Exception;
use NilPortugues\BackslashFixer\Fixer\FileEditor;
use NilPortugues\BackslashFixer\Fixer\FileSystem;
use NilPortugues\BackslashFixer\Fixer\FunctionRepository;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Zend\Code\Generator\FileGenerator;

class FixerCommand extends Command
{
    /**
     * @var string
     *
     * Command name
     */
    const COMMAND_NAME = 'fix';

    /**
     * configure
     */
    protected function configure()
    {
        $this
            ->setName('fix')
            ->setDescription('Adds backslashes to all internal PHP functions')
            ->addArgument(
                'path',
                InputArgument::REQUIRED,
                'Path'
            );
    }

    /**
     * Execute command
     *
     * @param InputInterface  $input  Input
     * @param OutputInterface $output Output
     *
     * @return \int|\null|void
     *
     * @throws Exception
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $path = $input->getArgument('path');

        $fileSystem = new FileSystem();
        $fileEditor = new FileEditor(new FileGenerator(), new FunctionRepository(), $fileSystem);

        foreach ($fileSystem->getFilesFromPath($path) as $file) {
            $fileEditor->addBackslashesToFunctions($file);
        }

        $output->write('Success!', \true);
        return $output;
    }
}
