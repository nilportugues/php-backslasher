<?php

namespace NilPortugues\Tests\BackslashFixer\Fixer\Resources;


/**
 * Class BooleanAndNull
 * @package NilPortugues\Tests\BackslashFixer\Fixer\Resources
 */
class BooleanAndNull
{
    /**
     * @var bool
     */
    private $a;
    /**
     * @var bool
     */
    private $b;
    /**
     * @var null
     */
    private $c;

    /**
     * BooleanAndNull constructor.
     */
    public function __construct()
    {
        $this->a = true;
        $this->b = false;
        $this->c = null;
    }
}