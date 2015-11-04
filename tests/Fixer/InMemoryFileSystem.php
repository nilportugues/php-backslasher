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

    private $base;

    /**
     * InMemoryFileSystem constructor.
     */
    public function __construct()
    {
        $reflector = new \ReflectionClass(get_class($this));
        $this->base =  dirname($reflector->getFileName());

        foreach(self::$filePath as $file) {
            $path = $this->base.DIRECTORY_SEPARATOR.$file;
            self::$fileSystem[$path] = \file_get_contents($path);
        }
    }

    public function getFile($file)
    {
        return self::$fileSystem[$file];
    }

    /**
     * @inheritDoc
     */
    public function getFilesFromPath($path)
    {
        $files = [];
        foreach(array_keys(self::$fileSystem) as $file) {
            $path = $this->base.DIRECTORY_SEPARATOR.$file;
            $files[$path] = $path;
        }

        return $files;
    }

    /**
     * @inheritDoc
     */
    public function writeFile($filePath, $fileContent)
    {
        self::$fileSystem[$filePath] = $fileContent;
    }
}