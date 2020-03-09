<?php
declare(strict_types=1);

namespace Cyradin\Serializer\Enum;

/**
 * Class LetterCase
 *
 * @package Cyradin\Serializer\Enum
 */
class LetterCase
{
    public const FORMAT_CAMEL_CASE  = 'camelCase';
    public const FORMAT_PASCAL_CASE = 'PascalCase';
    public const FORMAT_SNAKE_CASE  = 'snake_case';
    public const FORMAT_KEBAB_CASE  = 'kebab-case';

    public const ALLOWED_CASES = [
        self::FORMAT_CAMEL_CASE,
        self::FORMAT_PASCAL_CASE,
        self::FORMAT_SNAKE_CASE,
        self::FORMAT_KEBAB_CASE,
    ];
}
