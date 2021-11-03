<?php
declare(strict_types=1);

namespace Landingi;

use Generator;
use PhpCsFixer\Tokenizer\Tokens;
use PHPUnit\Framework\TestCase;
use SplFileInfo;
use function file_get_contents;

class InterfaceNameSuffixFixerTest extends TestCase
{
    private InterfaceNameSuffixFixer $fixer;

    protected function setUp(): void
    {
        $this->fixer = new InterfaceNameSuffixFixer();
    }

    /**
     * @dataProvider data
     */
    public function testDoesNotFixAnything(string $input, string $expected): void
    {
        $tokens = Tokens::fromCode($input);
        $this->fixer->fix(new SplFileInfo(''), $tokens);

        self::assertEquals($tokens->generateCode(), $expected);
    }

    /**
     * yields [Code to Fix, Expected Result]
     */
    public function data(): Generator
    {
        yield [
            file_get_contents('tests/class_name_suffix_fixer/test_1_interface_input.php'),
            file_get_contents('tests/class_name_suffix_fixer/test_1_interface_output.php'),
        ];
        yield [
            file_get_contents('tests/class_name_suffix_fixer/test_2_interface_input.php'),
            file_get_contents('tests/class_name_suffix_fixer/test_2_interface_output.php'),
        ];
        yield [
            file_get_contents('tests/class_name_suffix_fixer/test_3_interface_input.php'),
            file_get_contents('tests/class_name_suffix_fixer/test_3_interface_output.php'),
        ];
    }
}
