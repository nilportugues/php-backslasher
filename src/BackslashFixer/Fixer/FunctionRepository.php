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
    private static $backslashable = [];
    private static $functions = [];

    /**
     *
     */
    public function __construct()
    {
        self::$functions = \array_map('strtolower', \get_defined_functions()['internal']);
        self::$functions = \array_combine(\array_values(self::$functions), self::$functions);
        ksort(self::$functions, SORT_REGULAR);
    }

    /**
     * @param $haystack
     * @param $needle
     * @return bool
     */
    private static function startsWith($haystack, $needle)
    {
        // search backwards starting from haystack length characters from the end
        return $needle === "" || strrpos($haystack, $needle, -strlen($haystack)) !== false;
    }

    /**
     * @return array
     */
    public static function getBackslashableFunctions()
    {
        if (!empty(self::$backslashable)) {
            return self::$backslashable;
        }
        self::$backslashable = [];

        foreach (self::$functions as $name => $value) {
            if (true === self::startsWith('is_', $value)) {
                $backslashable[$name] = $value;
            }
        }

        self::$backslashable['strlen'] = 'strlen';
        self::$backslashable['defined'] = 'defined';
        self::$backslashable['call_user_func'] = 'call_user_func';
        self::$backslashable['call_user_func_array'] = 'call_user_func_array';

        return self::$backslashable;
    }
}
