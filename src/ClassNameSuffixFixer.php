<?php
declare(strict_types=1);

namespace Landingi;

use PhpCsFixer\AbstractFixer;
use PhpCsFixer\FixerDefinition\FixerDefinition;
use PhpCsFixer\FixerDefinition\FixerDefinitionInterface;
use PhpCsFixer\Tokenizer\Token;
use PhpCsFixer\Tokenizer\Tokens;

class ClassNameSuffixFixer extends AbstractFixer
{
    protected function applyFix(\SplFileInfo $file, Tokens $tokens)
    {
        foreach ($tokens as $index => $token) {
            if ($token->getContent() == 'class') {
                $class = $tokens[$index + 2]->getContent();

                if (str_contains($class, 'Service') && $this->endsWith($class, 'Service')) {
                    $newToken = str_replace("Service", "", $class);
                    $tokens[$index + 2] = new Token([$index + 2, $newToken]);
                }
                if (str_contains($class, 'Entity') && $this->endsWith($class, 'Entity')) {
                    $newToken = str_replace("Entity", "", $class);
                    $tokens[$index + 2] = new Token([$index + 2, $newToken]);
                }
            }
        }
    }

    public function isCandidate(Tokens $tokens): bool
    {
        //TODO narazie tak to zostawiam bo chce by sprawdzalo kazdy plik. W przyszlosci sie jakis pattern ogarnie.
        return true;
    }

    public function getDefinition(): FixerDefinitionInterface
    {
        return new FixerDefinition('The suffix `Entity`, `Service` should be not used in class names.', [new \PhpCsFixer\FixerDefinition\CodeSample("<?php\n class AccountEntity")]);
    }

    private function endsWith($string, $endString): bool
    {
        $len = strlen($endString);
        if ($len == 0) {
            return true;
        }
        return (substr($string, -$len) === $endString);
    }
}
