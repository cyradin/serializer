<?php
declare(strict_types=1);

namespace Cyradin\Serializer\Tests\unit\LetterCaseFormatter\SnakeCaseFormatter;

use Codeception\Test\Unit;
use Cyradin\Serializer\LetterCaseFormatter\SnakeCaseFormatter;
use PHPUnit\Framework\ExpectationFailedException;

/**
 * Class FormatTest
 *
 * @package Cyradin\Serializer\Tests\unit\LetterCaseFormatter\SnakeCaseFormatter
 */
class FormatTest extends Unit
{
    /**
     * @dataProvider propertyNameProvider
     *
     * @param string $text
     * @param string $expected
     *
     * @throws ExpectationFailedException
     */
    public function testCanFormatPropertyName(string $text, string $expected)
    {
        $formatter = new SnakeCaseFormatter();

        $result = $formatter->format($text);

        $this->assertEquals($expected, $result);
    }

    /**
     * @return array
     */
    public function propertyNameProvider(): array
    {
        return [
            ['name', 'name'],
            ['property_name', 'property_name'],
            ['property-name', 'property_name'],
            ['PropertyName', 'property_name'],
            ['propertyName', 'property_name'],
            ['longPropertyName', 'long_property_name'],
            ['LongPropertyName', 'long_property_name'],
            ['long-property-name', 'long_property_name'],
            ['long_property_name', 'long_property_name'],
        ];
    }
}
