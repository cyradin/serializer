<?php
declare(strict_types=1);

namespace Cyradin\Serializer\Tests\unit\LetterCaseFormatter\CamelCaseFormatter;

use Codeception\Test\Unit;
use Cyradin\Serializer\LetterCaseFormatter\CamelCaseFormatter;
use PHPUnit\Framework\ExpectationFailedException;

/**
 * Class FormatTest
 *
 * @package Cyradin\Serializer\Tests\unit\LetterCaseFormatter\CamelCaseFormatter
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
        $formatter = new CamelCaseFormatter();

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
            ['property_name', 'propertyName'],
            ['property-name', 'propertyName'],
            ['PropertyName', 'propertyName'],
            ['propertyName', 'propertyName'],
            ['longPropertyName', 'longPropertyName'],
            ['LongPropertyName', 'longPropertyName'],
            ['long-property-name', 'longPropertyName'],
            ['long_property_name', 'longPropertyName'],
        ];
    }
}

