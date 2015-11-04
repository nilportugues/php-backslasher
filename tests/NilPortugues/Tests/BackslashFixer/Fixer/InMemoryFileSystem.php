<?php

namespace NilPortugues\Tests\BackslashFixer\Fixer;

use NilPortugues\BackslashFixer\Fixer\Interfaces\FileSystem;


class InMemoryFileSystem implements FileSystem
{
    /**
     * @var array
     */
    private static $fileSystem = [];

    /**
     * @var array
     */
    private static $filePath = [
        "Resources/Function.php",
        "Resources/Constant.php",
        "Resources/BooleanAndNull.php",
    ];

    /**
     * InMemoryFileSystem constructor.
     */
    public function __construct()
    {
        foreach(self::$filePath as $file) {
            self::$fileSystem[$file] = \file_get_contents($file);
        }
    }

    /**
     * @inheritDoc
     */
    public function getFilesFromPath($path)
    {
       return array_keys(self::$fileSystem);
    }

    /**
     * @inheritDoc
     */
    public function writeFile($filePath, $fileContent)
    {
        self::$fileSystem[$filePath] = $fileContent;
    }
}