<?php
declare(strict_types=1);

namespace Cyradin\Serializer\LetterCaseFormatter;

/**
 * Class CamelCaseFormatter
 *
 * @package Cyradin\Serializer\LetterCaseFormatter
 */
class CamelCaseFormatter implements FormatterInterface
{
    /**
     * @param string $text
     *
     * @return string
     */
    public function format(string $text): string
    {
        return lcfirst(
            str_replace(
                ' ',
                '',
                ucwords(preg_replace('~[-_]|[^\w]~', ' ', $text))
            )
        );
    }
}
