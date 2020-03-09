<?php
declare(strict_types=1);

namespace Cyradin\Serializer\LetterCaseFormatter;

/**
 * Class SnakeCaseFormatter
 *
 * @package Cyradin\Serializer\LetterCaseFormatter
 */
class SnakeCaseFormatter implements FormatterInterface
{
    /**
     * @param string $text
     *
     * @return string
     */
    public function format(string $text): string
    {
        return ctype_lower($text)
            ? $text
            : strtolower(preg_replace(['~[-_]|[^\w]~', '~(?<!^)[A-Z]~'], ['_', '_$0'], $text));
    }
}
