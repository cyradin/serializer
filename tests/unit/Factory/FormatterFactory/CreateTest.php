<?php
declare(strict_types=1);

namespace Cyradin\Serializer\Tests\unit\Factory\FormatterFactory;

use Codeception\Test\Unit;
use Cyradin\Serializer\Enum\LetterCase;
use Cyradin\Serializer\Exception\InvalidLetterCaseException;
use Cyradin\Serializer\LetterCaseFormatter\CamelCaseFormatter;
use Cyradin\Serializer\Factory\FormatterFactory;
use Cyradin\Serializer\LetterCaseFormatter\KebabCaseFormatter;
use Cyradin\Serializer\LetterCaseFormatter\PascalCaseFormatter;
use Cyradin\Serializer\LetterCaseFormatter\SnakeCaseFormatter;
use PHPUnit\Framework\ExpectationFailedException;

/**
 * Class CreateTest
 *
 * @package Cyradin\Serializer\Tests\unit\LetterCaseFormatter\FormatterFactory
 */
class CreateTest extends Unit
{
    /**
     * @dataProvider caseProvider
     *
     * @param string $case
     * @param string $expected
     *
     * @throws InvalidLetterCaseException
     * @throws ExpectationFailedException
     */
    public function testCanCreateFormatter(string $case, string $expected)
    {
        $formatter = FormatterFactory::create($case);

        $this->assertEquals($expected, get_class($formatter));
    }

    /**
     * @throws InvalidLetterCaseException
     */
    public function testCannotCreateUnknownFormatter()
    {
        $case = 'qwerty';

        $this->expectException(InvalidLetterCaseException::class);
        FormatterFactory::create($case);
    }

    /**
     * @return array
     */
    public function caseProvider(): array
    {
        return [
            [LetterCase::FORMAT_SNAKE_CASE, SnakeCaseFormatter::class],
            [LetterCase::FORMAT_KEBAB_CASE, KebabCaseFormatter::class],
            [LetterCase::FORMAT_PASCAL_CASE, PascalCaseFormatter::class],
            [LetterCase::FORMAT_CAMEL_CASE, CamelCaseFormatter::class],
        ];
    }
}
