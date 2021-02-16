<?php
declare(strict_types=1);

use PhpCsFixer\Fixer\ClassNotation\ClassAttributesSeparationFixer;
use PhpCsFixer\Fixer\FunctionNotation\NativeFunctionInvocationFixer;
use PhpCsFixer\Fixer\FunctionNotation\SingleLineThrowFixer;
use PhpCsFixer\Fixer\Import\OrderedImportsFixer;
use PhpCsFixer\Fixer\Operator\BinaryOperatorSpacesFixer;
use PhpCsFixer\Fixer\Operator\ConcatSpaceFixer;
use PhpCsFixer\Fixer\Operator\IncrementStyleFixer;
use PhpCsFixer\Fixer\Phpdoc\NoSuperfluousPhpdocTagsFixer;
use PhpCsFixer\Fixer\Phpdoc\PhpdocAlignFixer;
use PhpCsFixer\Fixer\PhpTag\BlankLineAfterOpeningTagFixer;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symplify\EasyCodingStandard\ValueObject\Option;
use Symplify\EasyCodingStandard\ValueObject\Set\SetList;

return static function (ContainerConfigurator $containerConfigurator): void {
    $services = $containerConfigurator->services();
    $services->set(OrderedImportsFixer::class)->call('configure', [
        [
            'importsOrder' => [
                OrderedImportsFixer::IMPORT_TYPE_CONST,
                OrderedImportsFixer::IMPORT_TYPE_CLASS,
                OrderedImportsFixer::IMPORT_TYPE_FUNCTION
            ]
        ]
    ]);
    $parameters = $containerConfigurator->parameters();
    $parameters->set(Option::PATHS, [
        dirname(__DIR__) . '/../../src',
        dirname(__DIR__) . '/../../tests'
    ]);
    $parameters->set(Option::SKIP, [
        BlankLineAfterOpeningTagFixer::class => null,
        NativeFunctionInvocationFixer::class => null,
        ConcatSpaceFixer::class => null,
        ClassAttributesSeparationFixer::class => null,
        NoSuperfluousPhpdocTagsFixer::class => null,
        IncrementStyleFixer::class => null,
        BinaryOperatorSpacesFixer::class => null,
        SingleLineThrowFixer::class => null,
        PhpdocAlignFixer::class => null,
    ]);
    $parameters->set(Option::SETS, [
        SetList::CLEAN_CODE,
        SetList::PSR_12,
        SetList::SYMFONY,
        SetList::SYMFONY_RISKY,
    ]);
};
