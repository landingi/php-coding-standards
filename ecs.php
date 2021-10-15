<?php
declare(strict_types=1);

use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symplify\EasyCodingStandard\ValueObject\Option;

return static function (ContainerConfigurator $containerConfigurator): void {
    $parameters = $containerConfigurator->parameters();
    $parameters->set(Option::PATHS, [
        \dirname(__DIR__) . '/../../src',
        \dirname(__DIR__) . '/../../tests'
    ]);
    $services = $containerConfigurator->services();

    //Class
    $services->set(ClassNameSuffixFixer::class);

    //ControlStructure
    $services->set(\PhpCsFixer\Fixer\ControlStructure\NoUnneededControlParenthesesFixer::class);
    $services->set(\PhpCsFixer\Fixer\ControlStructure\NoUnneededCurlyBracesFixer::class);
    $services->set(\PhpCsFixer\Fixer\ControlStructure\ElseifFixer::class);
    $services->set(\PhpCsFixer\Fixer\ControlStructure\IncludeFixer::class);
    $services->set(\PhpCsFixer\Fixer\ControlStructure\NoBreakCommentFixer::class);
    $services->set(\PhpCsFixer\Fixer\ControlStructure\NoTrailingCommaInListCallFixer::class);
    $services->set(\PhpCsFixer\Fixer\ControlStructure\NoUnneededControlParenthesesFixer::class);
    $services->set(\PhpCsFixer\Fixer\ControlStructure\SwitchCaseSemicolonToColonFixer::class);
    $services->set(\PhpCsFixer\Fixer\ControlStructure\SwitchCaseSpaceFixer::class);
    $services->set(\PhpCsFixer\Fixer\ControlStructure\TrailingCommaInMultilineFixer::class)->call('configure', [['elements' => [\PhpCsFixer\Fixer\ControlStructure\TrailingCommaInMultilineFixer::ELEMENTS_ARRAYS]]]);
    $services->set(\PhpCsFixer\Fixer\ControlStructure\YodaStyleFixer::class);

    //Import
    $services->set(\PhpCsFixer\Fixer\Import\NoLeadingImportSlashFixer::class);
    $services->set(\PhpCsFixer\Fixer\Import\NoUnusedImportsFixer::class);
    $services->set(\PhpCsFixer\Fixer\Import\SingleLineAfterImportsFixer::class);
    $services->set(\PhpCsFixer\Fixer\Import\NoUnusedImportsFixer::class);
    $services->set(\PhpCsFixer\Fixer\Import\OrderedImportsFixer::class)->call('configure', [['imports_order' => ['class', 'function', 'const']]]);

    //Basic
    $services->set(\PhpCsFixer\Fixer\Basic\NonPrintableCharacterFixer::class);
    $services->set(\PhpCsFixer\Fixer\Basic\EncodingFixer::class);
    $services->set(\PhpCsFixer\Fixer\Basic\BracesFixer::class)->call('configure', [['allow_single_line_closure' => \false, 'position_after_functions_and_oop_constructs' => 'next', 'position_after_control_structures' => 'same', 'position_after_anonymous_constructs' => 'same']]);

    //Semicolon
    $services->set(\PhpCsFixer\Fixer\Semicolon\NoSinglelineWhitespaceBeforeSemicolonsFixer::class);
    $services->set(\PhpCsFixer\Fixer\Semicolon\NoEmptyStatementFixer::class);
    $services->set(\PhpCsFixer\Fixer\Semicolon\NoSinglelineWhitespaceBeforeSemicolonsFixer::class);
    $services->set(\PhpCsFixer\Fixer\Semicolon\SemicolonAfterInstructionFixer::class);
    $services->set(\PhpCsFixer\Fixer\Semicolon\SpaceAfterSemicolonFixer::class)->call('configure', [['remove_in_empty_for_expressions' => \true]]);

    //ArrayNotation
    $services->set(\PhpCsFixer\Fixer\ArrayNotation\ArraySyntaxFixer::class)->call('configure', [['syntax' => 'short']]);
    $services->set(\PhpCsFixer\Fixer\ArrayNotation\WhitespaceAfterCommaInArrayFixer::class);
    $services->set(\PhpCsFixer\Fixer\ArrayNotation\ArraySyntaxFixer::class)->call('configure', [['syntax' => 'short']]);
    $services->set(\PhpCsFixer\Fixer\ArrayNotation\NoMultilineWhitespaceAroundDoubleArrowFixer::class);
    $services->set(\PhpCsFixer\Fixer\ArrayNotation\NoTrailingCommaInSinglelineArrayFixer::class);
    $services->set(\PhpCsFixer\Fixer\ArrayNotation\NoWhitespaceBeforeCommaInArrayFixer::class);
    $services->set(\PhpCsFixer\Fixer\ArrayNotation\NormalizeIndexBraceFixer::class);
    $services->set(\PhpCsFixer\Fixer\ArrayNotation\TrimArraySpacesFixer::class);

    //Operator
    $services->set(\PhpCsFixer\Fixer\Operator\StandardizeIncrementFixer::class);
    $services->set(\PhpCsFixer\Fixer\Operator\TernaryOperatorSpacesFixer::class);
    $services->set(\PhpCsFixer\Fixer\Operator\UnaryOperatorSpacesFixer::class);
    $services->set(\PhpCsFixer\Fixer\Operator\NewWithBracesFixer::class);
    $services->set(\PhpCsFixer\Fixer\Operator\ObjectOperatorWithoutWhitespaceFixer::class);

    //PHPDOC
    $services->set(\PhpCsFixer\Fixer\Phpdoc\PhpdocAnnotationWithoutDotFixer::class);
    $services->set(\PhpCsFixer\Fixer\Phpdoc\PhpdocIndentFixer::class);
    $services->set(\PhpCsFixer\Fixer\Phpdoc\PhpdocNoAccessFixer::class);
    $services->set(\PhpCsFixer\Fixer\Phpdoc\PhpdocNoAliasTagFixer::class);
    $services->set(\PhpCsFixer\Fixer\Phpdoc\PhpdocNoPackageFixer::class);
    $services->set(\PhpCsFixer\Fixer\Phpdoc\PhpdocNoUselessInheritdocFixer::class);
    $services->set(\PhpCsFixer\Fixer\Phpdoc\PhpdocReturnSelfReferenceFixer::class);
    $services->set(\PhpCsFixer\Fixer\Phpdoc\PhpdocScalarFixer::class);
    $services->set(\PhpCsFixer\Fixer\Phpdoc\PhpdocSeparationFixer::class);
    $services->set(\PhpCsFixer\Fixer\Phpdoc\PhpdocSingleLineVarSpacingFixer::class);
    $services->set(\PhpCsFixer\Fixer\Phpdoc\PhpdocSummaryFixer::class);
    $services->set(\PhpCsFixer\Fixer\Phpdoc\PhpdocToCommentFixer::class);
    $services->set(\PhpCsFixer\Fixer\Phpdoc\PhpdocTrimFixer::class);
    $services->set(\PhpCsFixer\Fixer\Phpdoc\PhpdocTrimConsecutiveBlankLineSeparationFixer::class);
    $services->set(\PhpCsFixer\Fixer\Phpdoc\PhpdocTypesFixer::class);
    $services->set(\PhpCsFixer\Fixer\Phpdoc\PhpdocTypesOrderFixer::class)->call('configure', [['null_adjustment' => 'always_last', 'sort_algorithm' => 'none']]);
    $services->set(\PhpCsFixer\Fixer\Phpdoc\PhpdocVarWithoutNameFixer::class);
    $services->set(\PhpCsFixer\Fixer\Phpdoc\NoBlankLinesAfterPhpdocFixer::class);
    $services->set(\PhpCsFixer\Fixer\Phpdoc\NoEmptyPhpdocFixer::class);

    //Casing
    $services->set(\PhpCsFixer\Fixer\Casing\LowercaseKeywordsFixer::class);
    $services->set(\PhpCsFixer\Fixer\Casing\LowercaseStaticReferenceFixer::class);
    $services->set(\PhpCsFixer\Fixer\Casing\MagicConstantCasingFixer::class);
    $services->set(\PhpCsFixer\Fixer\Casing\MagicMethodCasingFixer::class);
    $services->set(\PhpCsFixer\Fixer\Casing\NativeFunctionCasingFixer::class);
    $services->set(\PhpCsFixer\Fixer\Casing\NativeFunctionTypeDeclarationCasingFixer::class);
    $services->set(\PhpCsFixer\Fixer\Casing\ConstantCaseFixer::class);

    //PhpTag
    $services->set(\PhpCsFixer\Fixer\PhpTag\FullOpeningTagFixer::class);
    $services->set(\PhpCsFixer\Fixer\PhpTag\NoClosingTagFixer::class);

    //ClassNotation
    $services->set(\PhpCsFixer\Fixer\ClassNotation\ProtectedToPrivateFixer::class);
    $services->set(\PhpCsFixer\Fixer\ClassNotation\NoBlankLinesAfterClassOpeningFixer::class);
    $services->set(\PhpCsFixer\Fixer\ClassNotation\VisibilityRequiredFixer::class)->call('configure', [['elements' => ['const', 'method', 'property']]]);


    //CastNotation
    $services->set(\PhpCsFixer\Fixer\CastNotation\ShortScalarCastFixer::class);
    $services->set(\PhpCsFixer\Fixer\CastNotation\LowercaseCastFixer::class);
    $services->set(\PhpCsFixer\Fixer\CastNotation\ModernizeTypesCastingFixer::class);
    $services->set(\PhpCsFixer\Fixer\CastNotation\CastSpacesFixer::class);
    $services->set(\PhpCsFixer\Fixer\CastNotation\NoShortBoolCastFixer::class);

    //FunctionNotation
    $services->set(\PhpCsFixer\Fixer\FunctionNotation\MethodArgumentSpaceFixer::class);
    $services->set(\PhpCsFixer\Fixer\FunctionNotation\FopenFlagOrderFixer::class);
    $services->set(\PhpCsFixer\Fixer\FunctionNotation\FopenFlagsFixer::class)->call('configure', [['b_mode' => \false]]);
    $services->set(\PhpCsFixer\Fixer\FunctionNotation\ImplodeCallFixer::class);
    $services->set(\PhpCsFixer\Fixer\FunctionNotation\FunctionDeclarationFixer::class);
    $services->set(\PhpCsFixer\Fixer\FunctionNotation\FunctionTypehintSpaceFixer::class);
    $services->set(\PhpCsFixer\Fixer\FunctionNotation\NoSpacesAfterFunctionNameFixer::class);
    $services->set(\PhpCsFixer\Fixer\FunctionNotation\ReturnTypeDeclarationFixer::class);

    //Whitespace
    $services->set(\PhpCsFixer\Fixer\Whitespace\NoSpacesAroundOffsetFixer::class);
    $services->set(\PhpCsFixer\Fixer\Whitespace\NoSpacesInsideParenthesisFixer::class);
    $services->set(\PhpCsFixer\Fixer\Whitespace\NoWhitespaceInBlankLineFixer::class);
    $services->set(\PhpCsFixer\Fixer\Whitespace\SingleBlankLineAtEofFixer::class);
    $services->set(\PhpCsFixer\Fixer\Whitespace\NoTrailingWhitespaceFixer::class);
    $services->set(\PhpCsFixer\Fixer\Whitespace\BlankLineBeforeStatementFixer::class)->call('configure', [['statements' => ['return']]]);
    $services->set(\PhpCsFixer\Fixer\Whitespace\IndentationTypeFixer::class);
    $services->set(\PhpCsFixer\Fixer\Whitespace\LineEndingFixer::class);
    $services->set(\PhpCsFixer\Fixer\Whitespace\NoExtraBlankLinesFixer::class)->call('configure', [['tokens' => ['curly_brace_block', 'extra', 'parenthesis_brace_block', 'square_brace_block', 'throw', 'use']]]);

    //NamespaceNotation
    $services->set(\PhpCsFixer\Fixer\NamespaceNotation\SingleBlankLineBeforeNamespaceFixer::class);
    $services->set(\PhpCsFixer\Fixer\NamespaceNotation\BlankLineAfterNamespaceFixer::class);
    $services->set(\PhpCsFixer\Fixer\NamespaceNotation\NoLeadingNamespaceWhitespaceFixer::class);

    //PhpUnit
    $services->set(\PhpCsFixer\Fixer\PhpUnit\PhpUnitFqcnAnnotationFixer::class);
    $services->set(\PhpCsFixer\Fixer\PhpUnit\PhpUnitConstructFixer::class);
    $services->set(\PhpCsFixer\Fixer\PhpUnit\PhpUnitMockShortWillReturnFixer::class);

    //ClassNotation
    $services->set(\PhpCsFixer\Fixer\ClassNotation\NoUnneededFinalMethodFixer::class);
    $services->set(\PhpCsFixer\Fixer\ClassNotation\SelfAccessorFixer::class);
    $services->set(\PhpCsFixer\Fixer\ClassNotation\SingleTraitInsertPerStatementFixer::class);
    $services->set(\PhpCsFixer\Fixer\ClassNotation\VisibilityRequiredFixer::class);
    $services->set(\PhpCsFixer\Fixer\ClassNotation\SingleClassElementPerStatementFixer::class);
    $services->set(\PhpCsFixer\Fixer\ClassNotation\NoBlankLinesAfterClassOpeningFixer::class);
    $services->set(\PhpCsFixer\Fixer\ClassNotation\ClassDefinitionFixer::class)->call('configure', [['single_line' => \true]]);

    //Comment
    $services->set(\PhpCsFixer\Fixer\Comment\NoEmptyCommentFixer::class);
    $services->set(\PhpCsFixer\Fixer\Comment\NoTrailingWhitespaceInCommentFixer::class);
    $services->set(\PhpCsFixer\Fixer\Comment\SingleLineCommentStyleFixer::class)->call('configure', [['comment_types' => ['hash']]]);

    //LanguageConstruct
    $services->set(\PhpCsFixer\Fixer\LanguageConstruct\DeclareEqualNormalizeFixer::class)->call('configure', [['space' => 'none']]);
    $services->set(\PhpCsFixer\Fixer\LanguageConstruct\DirConstantFixer::class);
    $services->set(\PhpCsFixer\Fixer\LanguageConstruct\FunctionToConstantFixer::class)->call('configure', [['functions' => ['get_called_class', 'get_class', 'get_class_this', 'php_sapi_name', 'phpversion', 'pi']]]);
    $services->set(\PhpCsFixer\Fixer\LanguageConstruct\ErrorSuppressionFixer::class);
    $services->set(\PhpCsFixer\Fixer\LanguageConstruct\IsNullFixer::class);
    $services->set(\PhpCsFixer\Fixer\ConstantNotation\NativeConstantInvocationFixer::class)->call('configure', [['fix_built_in' => \false, 'include' => ['DIRECTORY_SEPARATOR', 'PHP_SAPI', 'PHP_VERSION_ID'], 'scope' => 'namespaced']]);

    //Alias
    $services->set(\PhpCsFixer\Fixer\Alias\NoMixedEchoPrintFixer::class);
    $services->set(\PhpCsFixer\Fixer\Alias\EregToPregFixer::class);
    $services->set(\PhpCsFixer\Fixer\Alias\NoAliasFunctionsFixer::class);
    $services->set(\PhpCsFixer\Fixer\Alias\SetTypeToCastFixer::class);

    //Other
    $services->set(\PhpCsFixer\Fixer\Naming\NoHomoglyphNamesFixer::class);
    $services->set(\PhpCsFixer\Fixer\StringNotation\SingleQuoteFixer::class);
    $services->set(\Symplify\CodingStandard\Fixer\Commenting\ParamReturnAndVarTagMalformsFixer::class);
};
