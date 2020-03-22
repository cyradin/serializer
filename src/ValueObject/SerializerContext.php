<?php
declare(strict_types=1);

namespace Cyradin\Serializer\ValueObject;

use Cyradin\Serializer\Enum\LetterCase;
use Cyradin\Serializer\Exception\InvalidLetterCaseException;
use Cyradin\Serializer\Factory\FormatterFactoryInterface;
use Cyradin\Serializer\LetterCaseFormatter\FormatterInterface;

/**
 * Class SerializerContext
 *
 * @package Cyradin\Serializer\ValueObject
 */
class SerializerContext
{
    /**
     * @var FormatterFactoryInterface
     */
    protected FormatterFactoryInterface $formatterFactory;

    /**
     * @var bool
     */
    protected bool $serializeNull = false;

    /**
     * @var string
     */
    protected string $case = LetterCase::FORMAT_CAMEL_CASE;

    /**
     * Context constructor.
     *
     * @param FormatterFactoryInterface $formatterFactory
     */
    public function __construct(FormatterFactoryInterface $formatterFactory)
    {
        $this->formatterFactory = $formatterFactory;
    }

    /**
     * @return bool
     */
    public function isSerializeNull(): bool
    {
        return $this->serializeNull;
    }

    /**
     * @param bool $serializeNull
     *
     * @return SerializerContext
     */
    public function setSerializeNull(bool $serializeNull): SerializerContext
    {
        $this->serializeNull = $serializeNull;

        return $this;
    }

    /**
     * @return string
     */
    public function getCase(): string
    {
        return $this->case;
    }

    /**
     * @param string $case
     *
     * @return SerializerContext
     */
    public function setCase(string $case): SerializerContext
    {
        $this->case = $case;

        return $this;
    }

    /**
     * @throws InvalidLetterCaseException
     * @return FormatterInterface
     */
    public function getFormatter(): FormatterInterface
    {
        return $this->formatterFactory->create($this->case);
    }
}
