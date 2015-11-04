<?php
/**
 * Author: Nil Portugués Calderó <contact@nilportugues.com>
 * Date: 10/31/15
 * Time: 11:24 PM
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace NilPortugues\BackslashFixer\Fixer;

/**
 * Class FunctionRepository
 * @package NilPortugues\BackslashFixer\Fixer
 */
class FunctionRepository
{
    private static $functions = [];

    /**
     *
     */
    public function __construct()
    {
        self::$functions = \array_map('strtolower', \get_defined_functions()['internal']);
        self::$functions = \array_combine(\array_values(self::$functions), self::$functions);
    }

    /**
     * @return array
     */
    public static function getFunctions()
    {
        return self::$functions;
    }
}
