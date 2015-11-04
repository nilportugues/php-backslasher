<?php

namespace NilPortugues\Tests\BackslashFixer\Fixer\Resources;

/**
 * Class Constant
 * @package NilPortugues\Tests\BackslashFixer\Fixer\Resources
 */
class Constant
{
    const DIRECTORY_SEPARATOR = ';';

    /**
     * @var string
     */
    private $a;

    /**
     * @var string
     */
    private $b;

    /**
     * ConstantTest constructor.
     */
    public function __construct()
    {
        $this->a = self::DIRECTORY_SEPARATOR;
        $this->b = DIRECTORY_SEPARATOR;
    }
}