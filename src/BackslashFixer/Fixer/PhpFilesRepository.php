<?php
/**
 * Author: Nil Portugués Calderó <contact@nilportugues.com>
 * Date: 11/1/15
 * Time: 12:15 AM
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace NilPortugues\BackslashFixer\Fixer;

use InvalidArgumentException;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;

class PhpFilesRepository
{
    public function find($path)
    {
        if (false === \is_dir($path) && false === \is_file($path)) {
            throw new InvalidArgumentException("Provided input is not a file nor a valid directory");
        }

        $files = [];

        $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path));

        /** @var \SplFileInfo $filename */
        foreach ($iterator as $filename) {
            // filter out "." and ".."
            if ($filename->isDir()) {
                continue;
            }

            if ("php" === \strtolower($filename->getExtension())) {
                $files[] = $filename->getRealPath();
            }
        }

        return $files;
    }
}
