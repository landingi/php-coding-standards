<?php
declare(strict_types=1);

namespace Landingi;

use PhpCsFixer\Tokenizer\Tokens;
use PHPUnit\Framework\TestCase;

class InterfaceNameSuffixFixerTest extends TestCase
{
    private InterfaceNameSuffixFixer $fixer;

    protected function setUp(): void
    {
        $this->fixer = new InterfaceNameSuffixFixer();
    }

    public function testDoesNotFixAnything(): void
    {
        $tokens = Tokens::fromCode(file_get_contents(dirname(__DIR__) . '/data/ExampleInterfaceClass.php'));
        $this->fixer->fix(new \SplFileInfo(''), $tokens);

        static::assertEquals($tokens->generateCode(), file_get_contents(dirname(__DIR__) . '/data/ExampleInterfaceClass.php'));
    }

    public function testDoesFixInterfaceName(): void
    {
        $tokens = Tokens::fromCode(file_get_contents(dirname(__DIR__) . '/data/ExampleClassInterface.php'));
        $this->fixer->fix(new \SplFileInfo(''), $tokens);

        static::assertEquals($tokens->generateCode(), $this->getValidPhpCode());
    }

    public function testDoesFixInterfaceNameWhichStartsWithInterfaceSuffix(): void
    {
        $tokens = Tokens::fromCode(file_get_contents(dirname(__DIR__) . '/data/InterfaceExampleClass.php'));
        $this->fixer->fix(new \SplFileInfo(''), $tokens);

        static::assertEquals($tokens->generateCode(), $this->getValidPhpCodeWithInterfaceOnStart());
    }

    private function getValidPhpCode(): string
    {
        return <<<END
        <?php

        interface ExampleClass
        {

        }
        END;
    }

    private function getValidPhpCodeWithInterfaceOnStart(): string
    {
        return <<<END
        <?php

        interface InterfaceExampleClass
        {

        }
        END;
    }
}
