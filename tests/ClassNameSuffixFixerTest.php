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

    public function testDoesNotFixClassName(): void
    {
        $tokens = Tokens::fromCode($this->getValidPhpCodeWithSuffixOnStart());
        $this->fixer->fix(new \SplFileInfo(''), $tokens);

        static::assertEquals($tokens->generateCode(), $this->getValidPhpCodeWithSuffixOnStart());
    }

    public function testExample(): void
    {
        $tokens = Tokens::fromCode(file_get_contents(dirname(__DIR__) . '/data/WfirmaTest.php'));
        $this->fixer->fix(new \SplFileInfo(''), $tokens);

        var_dump($tokens->generateCode());
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
