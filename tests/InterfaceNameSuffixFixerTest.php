<?php
declare(strict_types=1);

namespace Tests;

use Landingi\InterfaceNameSuffixFixer;
use PhpCsFixer\Tokenizer\Tokens;
use PHPUnit\Framework\TestCase;

class InterfaceNameSuffixFixerTest extends TestCase
{
    private InterfaceNameSuffixFixer $fixer;

    protected function setUp(): void
    {
        $this->fixer = new InterfaceNameSuffixFixer();
    }

    private function getValidPhpCode(): string
    {
        return <<<END
        <?php

        interface ExampleClass
        {
        
        };
        END;
    }

    private function getNotValidPhpCode(): string
    {
        return <<<END
        <?php

        interface ExampleClassInterface
        {
        
        };
        END;
    }

    public function testDoesNotFixAnything(): void
    {
        $tokens = Tokens::fromCode($this->getValidPhpCode());
        $this->fixer->fix(new \SplFileInfo(''), $tokens);

        static::assertEquals($tokens->generateCode(), $this->getValidPhpCode());
    }

    public function testDoesFixInterfaceName(): void
    {
        $tokens = Tokens::fromCode($this->getNotValidPhpCode());
        $this->fixer->fix(new \SplFileInfo(''), $tokens);

        static::assertEquals($tokens->generateCode(), $this->getValidPhpCode());
    }
}