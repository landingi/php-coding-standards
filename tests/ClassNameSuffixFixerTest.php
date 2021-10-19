<?php
declare(strict_types=1);

namespace Tests;

use Landingi\ClassNameSuffixFixer;
use PhpCsFixer\Tokenizer\Tokens;
use PHPUnit\Framework\TestCase;

class ClassNameSuffixFixerTest extends TestCase
{
    private ClassNameSuffixFixer $fixer;

    protected function setUp(): void
    {
        $this->fixer = new ClassNameSuffixFixer();
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
    private function getNotValidPhpCode(): string
    {
        return <<<END
        <?php

        class ExampleClassEntity
        {
        
        }
        END;
    }

    public function testDoesNotFixAnything(): void
    {
        $tokens = Tokens::fromCode($this->getValidPhpCode());
        $this->fixer->fix(new \SplFileInfo(''), $tokens);

        static::assertEquals($tokens->generateCode(), $this->getValidPhpCode());
    }

    public function testDoesFixClassName(): void
    {
        $tokens = Tokens::fromCode($this->getNotValidPhpCode());
        $this->fixer->fix(new \SplFileInfo(''), $tokens);

        static::assertEquals($tokens->generateCode(), $this->getValidPhpCode());
    }
}
