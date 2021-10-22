<?php
declare(strict_types=1);

namespace Landingi;

use PhpCsFixer\AbstractFixer;
use PhpCsFixer\FixerDefinition\FixerDefinition;
use PhpCsFixer\Tokenizer\Tokens;

class FileNameSameAsClassName extends AbstractFixer
{
    protected function applyFix(\SplFileInfo $file, Tokens $tokens)
    {
        foreach ($tokens as $index => $token) {
            if ($token->getContent() == 'class' || $token->getContent() == 'interface') {
                $className = $tokens[$index + 2]->getContent();

                if ($file->getBasename() != $className) {
                    $directoryPath = str_replace(basename($file->getPathname()), '', $file->getPathname());
                    rename($directoryPath.basename($file->getPathname()), $directoryPath.$className.'.php');
                }
            }
        }
    }

    public function isCandidate(Tokens $tokens): bool
    {
        return true;
    }

    public function getDefinition(): FixerDefinition
    {
        return new FixerDefinition('The name of class cannot be diffrent from the class name');
    }
}
