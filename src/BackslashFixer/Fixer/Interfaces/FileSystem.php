<?php

namespace NilPortugues\BackslashFixer\Fixer\Interfaces;


interface FileSystem
{
    /**
     * @param string $path
     * @return string[]
     */
    public function getFilesFromPath($path);

    /**
     * @param string $filePath
     * @param string $fileContent
     */
    public function writeFile($filePath, $fileContent);
}