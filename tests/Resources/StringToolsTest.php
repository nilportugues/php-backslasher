<?php
/**
 * Author: Nil Portugués Calderó <contact@nilportugues.com>
 * Date: 11/1/15
 * Time: 12:01 AM
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace NilPortugues\Tests\BackslashFixer\Resources;

use PHPUnit_Framework_TestCase;

function strlen($string)
{
    $i = 0;
    while (isset($string[$i])) {
        $i++;
    }

    return $i + 1;
}

class StringToolsTest extends PHPUnit_Framework_TestCase
{
    public function testStrLen()
    {
        $this->assertEquals(4, strlen('Nil'));
        $this->assertEquals(3, \strlen('Nil'));
    }
}
