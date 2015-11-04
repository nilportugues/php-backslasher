<?php
/**
 * Author: Nil Portugués Calderó <contact@nilportugues.com>
 * Date: 11/4/15
 * Time: 8:03 PM
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace NilPortugues\Tests\BackslashFixer\Fixer;

use NilPortugues\BackslashFixer\Fixer\FileEditor;
use NilPortugues\BackslashFixer\Fixer\FunctionRepository;
use Zend\Code\Generator\FileGenerator;


/**
 * Class FileEditorTest
 * @package NilPortugues\Tests\BackslashFixer\Fixer
 */
class FileEditorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var FileEditor
     */
    protected $fileEditor;

    /**
     * @var InMemoryFileSystem
     */
    protected $fileSystem;

    /**
     * @var string
     */
    protected $base;

    protected function setUp()
    {
        $reflector = new \ReflectionClass(get_class($this));
        $this->base =  dirname($reflector->getFileName());

        $this->fileSystem = new InMemoryFileSystem();

        $this->fileEditor = new FileEditor(
            new FileGenerator(),
            new FunctionRepository(),
            $this->fileSystem
        );
    }

    public function testItCanBackSlashBooleansAndAndNull()
    {
        $this->fileEditor->addBackslashes($this->base.'/Resources/BooleanAndNull.php');
        $output = $this->fileSystem->getFile($this->base.'/Resources/BooleanAndNull.php');

        $this->assertContains('\true', $output);
        $this->assertContains('\false', $output);
        $this->assertContains('\null', $output);

    }

    public function testItCanBackSlashConstants()
    {
        $this->fileEditor->addBackslashes($this->base.'/Resources/Constant.php');
        $output = $this->fileSystem->getFile($this->base.'/Resources/Constant.php');

        $this->assertContains('$this->a = self::DIRECTORY_SEPARATOR;', $output);
        $this->assertContains('$this->b = \DIRECTORY_SEPARATOR;', $output);
    }

    public function testItCanBackSlashFunctions()
    {
        $this->fileEditor->addBackslashes($this->base.'/Resources/Function.php');
        $output = $this->fileSystem->getFile($this->base.'/Resources/Function.php');

        $this->assertContains('return \strlen($string)', $output);
    }
} 