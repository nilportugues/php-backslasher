<?php
/**
 * Author: Nil Portugués Calderó <contact@nilportugues.com>
 * Date: 11/1/15
 * Time: 12:30 AM
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace NilPortugues\BackslashFixer\Fixer;

use NilPortugues\BackslashFixer\Fixer\Interfaces\FileSystem as FileSystemInterface;
use Zend\Code\Generator\FileGenerator;

class FileEditor
{
    /**
     * @var array
     */
    private static $constants = [];
    /**
     * @var \Zend\Code\Generator\FileGenerator
     */
    private $fileGenerator;
    /**
     * @var FunctionRepository
     */
    private $functions;
    /**
     * @var Interfaces\FileSystem
     */
    private $fileSystem;

    /**
     * FileEditor constructor.
     * @param FileGenerator       $fileGenerator
     * @param FunctionRepository  $functionRepository
     * @param FileSystemInterface $fileSystem
     */
    public function __construct(
        FileGenerator $fileGenerator,
        FunctionRepository $functionRepository,
        FileSystemInterface $fileSystem
    ) {
        $this->fileGenerator = $fileGenerator;
        $this->functions = $functionRepository;
        $this->fileSystem = $fileSystem;
    }

    /**
     * @param $path
     * @return void
     */
    public function addBackslashes($path)
    {
        $generator = $this->fileGenerator->fromReflectedFileName($path);
        $source = explode("\n", $generator->getSourceContent());
        $tokens = token_get_all(file_get_contents($path));

        $previousToken = null;
        $functions = $this->getReplaceableFunctions($generator);
        $constants = $this->getDefinedConstants();

        foreach ($tokens as $token) {
            if (!is_array($token)) {
                $tempToken = $token;
                $token = [0 => 0, 1 => $tempToken, 2 => 0];
            }

            if ($token[0] == T_STRING) {
                $line = $token[2];

                if ($this->isBackslashable($functions, $token, $previousToken, $constants)) {
                    $source[$line-1] = str_replace($token[1], '\\'.$token[1], $source[$line-1]);
                }
            }

            $previousToken = $token;
        }

        $source = $this->applyFinalFixes($source);

        $this->fileSystem->writeFile($path, $source);
    }

    /**
     * If a method exists under a namespace and has been aliased, or has been imported, don't replace.
     *
     * @param FileGenerator $generator
     * @param array         $functions
     *
     * @return array
     */
    private function removeUseFunctionsFromBackslashing(FileGenerator $generator, array $functions)
    {
        foreach ($generator->getUses() as $namespacedFunction) {
            list($functionOrClass) = $namespacedFunction;

            if (\function_exists($functionOrClass)) {
                $function = \explode("\\", $functionOrClass);
                $function = \array_pop($function);

                if (!empty($functions[$function])) {
                    unset($functions[$function]);
                }
            }
        }

        return $functions;
    }

    /**
     * @return array
     */
    private function getDefinedConstants()
    {
        if (empty(self::$constants)) {
            self::$constants = \array_keys(\get_defined_constants(\false));
            $c = array_values(self::$constants);
            self::$constants = array_combine($c, $c);
        }

        return self::$constants;
    }

    /**
     * @param $generator
     * @return array
     */
    protected function getReplaceableFunctions($generator)
    {
        $functions = $this->functions->getBackslashableFunctions();
        $functions = $this->removeUseFunctionsFromBackslashing($generator, $functions);

        return $functions;
    }

    /**
     * @param string $source
     *
     * @return string
     */
    private function applyFinalFixes($source)
    {
        $source = implode("\n", $source);
        $source = \str_replace("function \\", "function ", $source);
        $source = \str_replace("const \\", "const ", $source);
        $source = \str_replace("::\\", "::", $source);

        return (string) $source;
    }

    /**
     * @param $constants
     * @param $token
     * @param $previousToken
     *
     * @return bool
     */
    private function isConstant(array &$constants, array &$token, array &$previousToken)
    {
        return !empty($constants[strtoupper($token[1])]) && $previousToken[0] != T_NAMESPACE;
    }

    /**
     * @param array $functions
     * @param array $token
     * @param array $previousToken
     *
     * @return bool
     */
    private function isFunction(array &$functions, array &$token, array &$previousToken)
    {
        return !empty($functions[$token[1]])
        && $previousToken[0] != T_NAMESPACE
        && $previousToken[0] != T_OBJECT_OPERATOR;
    }

    /**
     * @param array $functions
     * @param array $token
     * @param array $previousToken
     * @param array $constants
     *
     * @return bool
     */
    private function isBackslashable(array &$functions, array &$token, array &$previousToken, array &$constants)
    {
        return $this->isFunction($functions, $token, $previousToken)
        || ($this->isConstant($constants, $token, $previousToken));
    }
}
