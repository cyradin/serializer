<?php
declare(strict_types=1);

namespace Cyradin\Serializer\Tests\unit\LetterCaseFormatter\KebabCaseFormatter;

use Codeception\Test\Unit;
use Cyradin\Serializer\LetterCaseFormatter\KebabCaseFormatter;
use PHPUnit\Framework\ExpectationFailedException;

/**
 * Class FormatTest
 *
 * @package Cyradin\Serializer\Tests\unit\LetterCaseFormatter\KebabCaseFormatter
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
        $formatter = new KebabCaseFormatter();

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
            ['property_name', 'property-name'],
            ['property-name', 'property-name'],
            ['PropertyName', 'property-name'],
            ['propertyName', 'property-name'],
            ['longPropertyName', 'long-property-name'],
            ['LongPropertyName', 'long-property-name'],
            ['long-property-name', 'long-property-name'],
            ['long_property_name', 'long-property-name'],
        ];
    }
}
