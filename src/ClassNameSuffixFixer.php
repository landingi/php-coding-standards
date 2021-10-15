<?php
declare(strict_types=1);

namespace App;

use PhpCsFixer\Tokenizer\Tokens;

class ClassNameSuffixFixer extends \PhpCsFixer\AbstractFixer
{
    protected function applyFix(\SplFileInfo $file, Tokens $tokens)
    {
        foreach ($tokens as $index => $token) {
            if ($token->getContent === 'class') {
                $className = $tokens[$index + 2]->getContent();

                if(str_contains($className, 'Entity')) {
                    $newToken = str_replace("Entity", "", $className);
                    $tokens[$index + 2] = new \PhpCsFixer\Tokenizer\Token([$newToken, $className]);
                }
                if(str_contains($className, 'Service')) {
                    $newToken = str_replace("Service", "", $className);
                    $tokens[$index + 2] = new \PhpCsFixer\Tokenizer\Token([$newToken, $className]);
                }
            }
        }
    }

    public function isCandidate(Tokens $tokens): bool
    {
        //TODO narazie tak to zostawiam bo chce by sprawdzalo kazdy plik. W przyszlosci sie jakis pattern ogarnie.
        return true;
    }

    public function getDefinition(): \PhpCsFixer\FixerDefinition\FixerDefinitionInterface
    {
        return new \PhpCsFixer\FixerDefinition\FixerDefinition('The suffix `Entity`, `Service` should be not used in class names.', [new \PhpCsFixer\FixerDefinition\CodeSample("<?php\n class AccountEntity")]);
    }
}
