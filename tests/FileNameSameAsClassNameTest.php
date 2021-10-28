<?php
declare(strict_types=1);

namespace Landingi;

use PhpCsFixer\Tokenizer\Tokens;
use PHPUnit\Framework\TestCase;

class FileNameSameAsClassNameTest extends TestCase
{
    private FileNameSameAsClassName $fixer;

    protected function setUp(): void
    {
        $this->fixer = new FileNameSameAsClassName();
    }

    public function testDoesNotFix(): void
    {
        $file = new \SplFileInfo(dirname(__DIR__) . '/data/changename/test.php');
        $tokens = Tokens::fromCode(file_get_contents(dirname(__DIR__) . '/data/changename/test.php'));
        $this->fixer->fix($file, $tokens);

        static::assertEquals('test.php', $file->getBasename());
    }

    public function testDoesFix(): void
    {
        $file = new \SplFileInfo(dirname(__DIR__) . '/data/changename/changenametest.php');
        $tokens = Tokens::fromCode(file_get_contents(dirname(__DIR__) . '/data/changename/changenametest.php'));
        $this->fixer->fix($file, $tokens);
        $file = new \SplFileInfo(dirname(__DIR__) . '/data/changename/changenametest.php');

        static::assertEquals('changenametest.php', $file->getBasename());

        $directoryPath = str_replace(basename($file->getPathname()), '', $file->getPathname());
        rename($directoryPath.basename($file->getPathname()), $directoryPath.'changenametest.php');
    }
}
