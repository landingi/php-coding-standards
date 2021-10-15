<?php
declare(strict_types=1);

use PhpCsFixer\Tokenizer\Tokens;

class ClassNameSuffixFixer extends \PhpCsFixer\AbstractFixer
{

    protected function applyFix(\SplFileInfo $file, Tokens $tokens)
    {
    }

    public function isCandidate(Tokens $tokens): bool
    {
        //TODO narazie tak to zostawiam bo chce by sprawdzalo kazdy plik. W przyszlosci sie jakis pattern ogarnie.
        return true;
    }

    public
    function getDefinition(): \PhpCsFixer\FixerDefinition\FixerDefinitionInterface
    {
        return new \PhpCsFixer\FixerDefinition\FixerDefinition('The sufdix `Entity`, `Service` should be not used in class names.', [new \PhpCsFixer\FixerDefinition\CodeSample("<?php\n class AccountEntity")]);
    }
}