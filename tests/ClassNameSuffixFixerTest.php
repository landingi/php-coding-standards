<?php
declare(strict_types=1);

namespace Landingi;

use PhpCsFixer\Tokenizer\Tokens;
use PHPUnit\Framework\TestCase;

class ClassNameSuffixFixerTest extends TestCase
{
    private ClassNameSuffixFixer $fixer;

    protected function setUp(): void
    {
        $this->fixer = new ClassNameSuffixFixer();
    }

    public function testDoesNotFixAnything(): void
    {
        $tokens = Tokens::fromCode(file_get_contents(dirname(__DIR__) . '/data/class/ExampleClass.php'));
        $this->fixer->fix(new \SplFileInfo(''), $tokens);

        static::assertEquals($tokens->generateCode(), $this->getValidPhpCode());
    }

    public function testDoesFixClassName(): void
    {
        $tokens = Tokens::fromCode(file_get_contents(dirname(__DIR__) . '/data/class/ExampleClassEntity.php'));
        $this->fixer->fix(new \SplFileInfo(''), $tokens);

        static::assertEquals($tokens->generateCode(), $this->getValidPhpCode());
    }

    public function testDoesNotFixClassName(): void
    {
        $tokens = Tokens::fromCode(file_get_contents(dirname(__DIR__) . '/data/class/EntityExampleClass.php'));
        $this->fixer->fix(new \SplFileInfo(''), $tokens);

        static::assertEquals($tokens->generateCode(), $this->getValidPhpCodeWithSuffixOnStart());
    }

    private function getValidPhpCode(): string
    {
        return <<<END
        <?php

        class ExampleClass
        {
        
        }
        END;
    }

    private function getValidPhpCodeWithSuffixOnStart(): string
    {
        return <<<END
        <?php

        class EntityExampleClass
        {
        
        }
        END;
    }
}
