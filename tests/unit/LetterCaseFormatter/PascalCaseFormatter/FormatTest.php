<?php
declare(strict_types=1);

namespace Cyradin\Serializer\Tests\unit\LetterCaseFormatter\PascalCaseFormatter;

use Codeception\Test\Unit;
use Cyradin\Serializer\LetterCaseFormatter\PascalCaseFormatter;
use PHPUnit\Framework\ExpectationFailedException;

/**
 * Class FormatTest
 *
 * @package Cyradin\Serializer\Tests\unit\LetterCaseFormatter\PascalCaseFormatter
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
        $formatter = new PascalCaseFormatter();

        $result = $formatter->format($text);

        $this->assertEquals($expected, $result);
    }

    /**
     * @return array
     */
    public function propertyNameProvider(): array
    {
        return [
            ['name', 'Name'],
            ['property_name', 'PropertyName'],
            ['property-name', 'PropertyName'],
            ['PropertyName', 'PropertyName'],
            ['propertyName', 'PropertyName'],
            ['longPropertyName', 'LongPropertyName'],
            ['LongPropertyName', 'LongPropertyName'],
            ['long-property-name', 'LongPropertyName'],
            ['long_property_name', 'LongPropertyName'],
        ];
    }
}
