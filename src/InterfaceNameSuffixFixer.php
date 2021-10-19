<?php
declare(strict_types=1);

namespace Landingi;

use PhpCsFixer\Tokenizer\Tokens;
use \PhpCsFixer\AbstractFixer;
use \PhpCsFixer\Tokenizer\Token;

class InterfaceNameSuffixFixer extends AbstractFixer
{
    protected function applyFix(\SplFileInfo $file, Tokens $tokens)
    {
        foreach ($tokens as $index => $token) {
            if ($token->getContent() == 'interface') {
                $interfaceName = $tokens[$index + 2]->getContent();

                if (str_contains($interfaceName, 'Interface')) {
                    $newToken = str_replace("Interface", "", $interfaceName);
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

    public function getDefinition(): \PhpCsFixer\FixerDefinition\FixerDefinitionInterface
    {
        return new \PhpCsFixer\FixerDefinition\FixerDefinition('The suffix `Interface`, should be not used in interface names.', [new \PhpCsFixer\FixerDefinition\CodeSample("<?php\n interface AccountRepositoryInterface")]);
    }
}
