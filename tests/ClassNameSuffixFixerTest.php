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
        return '
        <?php

        class ExampleClass
        {
        
        }';
    }

    public function testDoesNotFixAnything(): void
    {
        $tokens = Tokens::fromCode($this->getValidPhpCode());
        $this->fixer->fix(new \SplFileInfo('test.php'), $tokens);

        static::assertEquals($tokens->generateCode(), $this->getValidPhpCode());
    }
}
