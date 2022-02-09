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
use function str_ends_with;
use function str_replace;

class InterfaceNameSuffixFixer implements FixerInterface
{
    public function isCandidate(Tokens $tokens): bool
    {
        return $tokens->isAllTokenKindsFound([T_INTERFACE]);
    }

    public function isRisky(): bool
    {
        return false;
    }

    public function fix(SplFileInfo $file, Tokens $tokens): void
    {
        foreach ($tokens as $index => $token) {
            if ($token->isGivenKind(T_INTERFACE)) {
                $interfaceName = $tokens[$index + 2]->getContent();

                if (str_ends_with($interfaceName, 'Interface') && $interfaceName !== 'CreatorInterface') {
                    $newToken = str_replace('Interface', '', $interfaceName);
                    $tokens[$index + 2] = new Token([$index + 2, $newToken]);
                }
            }
        }
    }


    public function getDefinition(): FixerDefinitionInterface
    {
        $codeSample = <<<PHP
<?php

class PaymentInterface
{
}
PHP;

        return new FixerDefinition(
            'Removes interface suffix from interfaces',
            [
                new CodeSample($codeSample)
            ]
        );
    }

    public function getName(): string
    {
        return 'interface_name_suffix';
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
