<?php
declare(strict_types=1);

namespace Cyradin\Serializer\LetterCaseFormatter;

/**
 * Class FormatterInterface
 *
 * @package Cyradin\Serializer\LetterCaseFormatter
 */
interface FormatterInterface
{
    /**
     * @param string $text
     *
     * @return string
     */
    public function format(string $text): string;
}
