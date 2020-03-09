<?php
declare(strict_types=1);

namespace Cyradin\Serializer\LetterCaseFormatter;

/**
 * Class PascalCaseFormatter
 *
 * @package Cyradin\Serializer\LetterCaseFormatter
 */
class PascalCaseFormatter implements FormatterInterface
{
    /**
     * @param string $text
     *
     * @return string
     */
    public function format(string $text): string
    {
        return str_replace(
            ' ',
            '',
            ucwords(preg_replace('~[-_]|[^\w]~', ' ', $text))
        );
    }
}
