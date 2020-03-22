<?php
declare(strict_types=1);

namespace Cyradin\Serializer\Factory;

use Cyradin\Serializer\Enum\LetterCase;
use Cyradin\Serializer\Exception\InvalidLetterCaseException;
use Cyradin\Serializer\LetterCaseFormatter\CamelCaseFormatter;
use Cyradin\Serializer\LetterCaseFormatter\FormatterInterface;
use Cyradin\Serializer\LetterCaseFormatter\KebabCaseFormatter;
use Cyradin\Serializer\LetterCaseFormatter\PascalCaseFormatter;
use Cyradin\Serializer\LetterCaseFormatter\SnakeCaseFormatter;

/**
 * Class FormatterFactory
 *
 * @package Cyradin\Serializer\LetterCaseFormatter
 */
class FormatterFactory implements FormatterFactoryInterface
{
    /**
     * @param string $case
     *
     * @throws InvalidLetterCaseException
     * @return FormatterInterface
     */
    public function create(string $case): FormatterInterface
    {
        switch ($case) {
            case LetterCase::FORMAT_CAMEL_CASE:
                $result = new CamelCaseFormatter();
                break;
            case LetterCase::FORMAT_KEBAB_CASE:
                $result = new KebabCaseFormatter();
                break;
            case LetterCase::FORMAT_PASCAL_CASE:
                $result = new PascalCaseFormatter();
                break;
            case LetterCase::FORMAT_SNAKE_CASE:
                $result = new SnakeCaseFormatter();
                break;
            default:
                throw new InvalidLetterCaseException(
                    sprintf(
                        'Invalid case "%s". Must be one of %s',
                        $case,
                        implode(', ', LetterCase::ALLOWED_CASES)
                    )
                );
        }

        return $result;
    }
}
