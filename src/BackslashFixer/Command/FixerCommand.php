<?php

namespace NilPortugues\BackslashFixer\Command;

use Exception;
use NilPortugues\BackslashFixer\Fixer\FileEditor;
use NilPortugues\BackslashFixer\Fixer\PhpFilesRepository;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;


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
     * @return int|\null|void
     *
     * @throws Exception
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $path = $input->getArgument('path');

        $fileEditor = new FileEditor();

        $fileRepository = new PhpFilesRepository();
        $files = $fileRepository->find($path);

        foreach ($files as $file) {
            $fileEditor->addBackslashesToFunctions($file);
        }

        $output->write('Success!', \true);

        return $output;
    }
}
