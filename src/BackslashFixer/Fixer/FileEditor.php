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
                $reservedToken = $token[1];

                //isFunction
                if (!empty($functions[$reservedToken])
                    && $previousToken[0] != T_NAMESPACE
                    && $previousToken[0] != T_OBJECT_OPERATOR
                ) {
                    $line = $token[2];
                    $source[$line-1] = str_replace($reservedToken, '\\'.$reservedToken, $source[$line-1]);
                }

                //isConstant
                if (!empty($constants[strtoupper($token[1])])
                    && $previousToken[0] != T_NAMESPACE
                    && !in_array(strtolower($token[1]), ['true', 'false', 'null'])
                ) {
                    $line = $token[2];
                    $source[$line-1] = str_replace($token[1], '\\'.$token[1], $source[$line-1]);
                }
            }

            if (in_array(strtolower($token[1]), ['true', 'false', 'null'])) {
                $line = $token[2];
                $source[$line-1] = str_replace($token[1], '\\'.$token[1], $source[$line-1]);
            }

            $previousToken = $token;
        }

        $source = implode("\n", $source);
        $source = \str_replace("function \\", "function ", $source);
        $source = \str_replace("const \\", "const ", $source);
        $source = \str_replace("::\\", "::", $source);

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
        }

        $c = array_values(self::$constants);

        self::$constants = array_combine($c, $c);

        return self::$constants;
    }

    /**
     * @param $generator
     * @return array
     */
    protected function getReplaceableFunctions($generator)
    {
        $functions = $this->functions->getFunctions();
        $functions = $this->removeUseFunctionsFromBackslashing($generator, $functions);

        return $functions;
    }
}
