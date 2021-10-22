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
        $file = fopen("tests/test.php", "w");
        fclose($file);
    }

    public function testDoesNotFix(): void
    {
        $file = new \SplFileInfo('tests/test.php');
        $tokens = Tokens::fromCode($this->getValidPhpCode());
        $this->fixer->fix($file, $tokens);

        static::assertEquals('test.php', $file->getBasename());
        unlink('tests/test.php');
    }

    public function testDoesFix(): void
    {
        $file = new \SplFileInfo('tests/test.php');
        $tokens = Tokens::fromCode($this->getNotValidPhpCode());
        $this->fixer->fix($file, $tokens);
        $file = new \SplFileInfo('tests/TestClass.php');

        static::assertEquals('TestClass.php', $file->getBasename());
        unlink('tests/TestClass.php');
    }

    public function testDoesFixWithFileWithSomeContent(): void
    {
        $file = new \SplFileInfo('tests/test.php');
        $tokens = Tokens::fromCode($this->getNotValidPhpCodeWithContent());
        $this->fixer->fix($file, $tokens);
        $file = new \SplFileInfo('tests/TestClass.php');

        static::assertEquals('TestClass.php', $file->getBasename());
        unlink('tests/TestClass.php');
    }

    private function getValidPhpCode(): string
    {
        return <<<END
        <?php

        class test
        {
        
        }
        END;
    }

    private function getNotValidPhpCode(): string
    {
        return <<<END
        <?php

        class TestClass
        {
        
        }
        END;
    }

    private function getNotValidPhpCodeWithContent(): string
    {
        return <<<END
        <?php

        class TestClass
        {
        public function test(): string {
            return 'test:)';
         }
        }
        END;
    }
}
