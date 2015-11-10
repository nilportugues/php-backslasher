<?php

namespace NilPortugues\BackslashFixer\Fixer;

use InvalidArgumentException;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;

class FileSystem implements \NilPortugues\BackslashFixer\Fixer\Interfaces\FileSystem
{
    /**
     * @inheritDoc
     */
    public function getFilesFromPath($path)
    {
        if (\false === \is_dir($path) && \false === \is_file($path)) {
            throw new InvalidArgumentException("Provided input is not a file nor a valid directory");
        }

        $files = [];

        $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path));

        /** @var \SplFileInfo $filename */
        foreach ($iterator as $filename) {
            // filter out "." and ".."
            if ($filename->isDir()) {
                continue;
            }

            if ("php" === \strtolower($filename->getExtension())) {
                $files[] = $filename->getRealPath();
            }
        }

        return $files;
    }
    /**
     * @inheritDoc
     */
    public function writeFile($filePath, $fileContent)
    {
        \file_put_contents($filePath, $fileContent);
    }
}
