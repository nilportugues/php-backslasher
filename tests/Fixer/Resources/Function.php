<?php

namespace NilPortugues\Tests\BackslashFixer\Fixer\Resources;

/**
 * @param string $string
 * @return int
 */
function countStringLength($string) {
    return strlen($string);
}

/**
 * @param $haystack
 * @param $value
 * @return bool|int
 */
function strpos($haystack, $value) {
    return strpos($haystack, $value)+1;
}