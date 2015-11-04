<?php
/**
 * Author: Nil Portugués Calderó <contact@nilportugues.com>
 * Date: 11/4/15
 * Time: 8:55 PM
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace NilPortugues\Tests\BackslashFixer\Fixer\Resources;

use const DIRECTORY_SEPARATOR;

/**
 * Class StringClass
 * @package NilPortugues\Tests\BackslashFixer\Fixer\Resources
 */
class ConstantClass
{
    /**
     * @return string
     */
    public function getSeparator()
    {
        return DIRECTORY_SEPARATOR;
    }
} 