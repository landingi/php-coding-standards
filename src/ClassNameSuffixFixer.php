<?php
declare(strict_types=1);

namespace Landingi;

use PhpCsFixer\Fixer\FixerInterface;
use PhpCsFixer\FixerDefinition\CodeSample;
use PhpCsFixer\FixerDefinition\FixerDefinition;
use PhpCsFixer\FixerDefinition\FixerDefinitionInterface;
use PhpCsFixer\Tokenizer\Token;
use PhpCsFixer\Tokenizer\Tokens;
use SplFileInfo;

class ClassNameSuffixFixer implements FixerInterface
{
    public function isCandidate(Tokens $tokens): bool
    {
        foreach ($tokens as $index => $token) {
            if ($token->getContent() === 'class') {
                return true;
            }
        }

        return false;
    }

    public function isRisky(): bool
    {
        return false;
    }

    public function fix(SplFileInfo $file, Tokens $tokens): void
    {
        foreach ($tokens as $index => $token) {
            if ($token->getContent() === 'class') {
                $class = $tokens[$index + 2]->getContent();

                if (str_ends_with($class, 'Service') || str_ends_with($class, 'Entity')) {
                    $newToken = str_replace(['Service', 'Entity'], '', $class);
                    $tokens[$index + 2] = new Token([$index + 2, $newToken]);
                }
            }
        }
    }

    public function getDefinition(): FixerDefinitionInterface
    {
        $codeSample = <<<PHP
<?php

class PaymentService
{
}
PHP;

        return new FixerDefinition(
            'Removes Service and Entity class suffix',
            [
                new CodeSample($codeSample)
            ]
        );
    }

    public function getName(): string
    {
        return 'class_name_suffix';
    }

    public function getPriority(): int
    {
        return 0;
    }

    public function supports(SplFileInfo $file): bool
    {
        return true;
    }
}
