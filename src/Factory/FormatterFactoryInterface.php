<?php
declare(strict_types=1);

namespace Cyradin\Serializer\Factory;

use Cyradin\Serializer\Exception\InvalidLetterCaseException;
use Cyradin\Serializer\LetterCaseFormatter\FormatterInterface;

/**
 * Interface FormatterFactoryInterface
 *
 * @package Cyradin\Serializer\Factory
 */
interface FormatterFactoryInterface
{
    /**
     * @param string $case
     *
     * @throws InvalidLetterCaseException
     * @return FormatterInterface
     */
    public function create(string $case): FormatterInterface;
}
