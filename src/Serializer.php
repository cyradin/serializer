<?php
declare(strict_types=1);

namespace Cyradin\Serializer;

use Cyradin\Serializer\Exception\InvalidLetterCaseException;
use Cyradin\Serializer\Exception\RuntimeException;
use Cyradin\Serializer\LetterCaseFormatter\FormatterFactory;
use Cyradin\Serializer\LetterCaseFormatter\FormatterInterface;
use DateTimeInterface;
use ReflectionClass;
use ReflectionException;
use ReflectionProperty;

/**
 * Class Serializer
 *
 * @package Cyradin\Serializer
 */
class Serializer implements NormalizerInterface
{
    /**
     * @var Context
     */
    protected Context $context;

    /**
     * Serializer constructor.
     *
     * @param Context $context
     */
    public function __construct(Context $context)
    {
        $this->context = $context;
    }

    /**
     * @param $value
     *
     * @throws ReflectionException
     * @throws RuntimeException
     * @return array|string|int|float|bool|null
     */
    public function normalize($value)
    {
        $formatter = $this->createFormatter();

        return $this->doNormalize($value, $formatter);
    }

    /**
     * @param                    $value
     * @param FormatterInterface $formatter
     *
     * @throws ReflectionException
     * @throws RuntimeException
     * @return array|bool|float|int|string
     */
    protected function doNormalize($value, FormatterInterface $formatter)
    {
        if (is_null($value)) {
            return $value;
        }

        if ($value instanceof DateTimeInterface) {
            return $this->serializeDatetime($value);
        }

        if (is_iterable($value)) {
            $result = [];
            foreach ($value as $key => $item) {
                $result[$key] = $this->normalize($item);
            }

            return $result;
        }

        if (is_object($value)) {
            return $this->serializeObject($value, $formatter);
        }

        return $this->serializeDefault($value);
    }

    /**
     * @param                    $object
     * @param FormatterInterface $formatter
     *
     * @throws ReflectionException
     * @throws RuntimeException
     * @return array|string
     */
    protected function serializeObject($object, FormatterInterface $formatter)
    {
        $result = [];
        $reflection = new ReflectionClass($object);
        foreach ($reflection->getProperties() as $property) {
            $value = $this->extractPropertyValue($property, $object, $formatter);
            if ($value === null && !$this->context->isSerializeNull()) {
                continue;
            }
            $name = $this->formatPropertyName($property->getName(), $formatter);

            $result[$name] = $value;
        }

        return $result;
    }

    /**
     * @param DateTimeInterface $value
     *
     * @return string
     */
    protected function serializeDatetime(DateTimeInterface $value)
    {
        return $value->format(DATE_ATOM);
    }

    /**
     * @param int|bool|string|float $value
     *
     * @return int|bool|string|float
     */
    protected function serializeDefault($value)
    {
        return $value;
    }

    /**
     * @param ReflectionProperty $reflection
     * @param object             $source
     * @param FormatterInterface $formatter
     *
     * @throws ReflectionException
     * @throws RuntimeException
     * @return array|mixed
     */
    protected function extractPropertyValue(ReflectionProperty $reflection, object $source, FormatterInterface $formatter)
    {
        $reflection->setAccessible(true);
        $value = $reflection->getValue($source);
        if ($reflection->isPrivate() || $reflection->isProtected()) {
            $reflection->setAccessible(false);
        }
        $result = $this->doNormalize($value, $formatter);

        return $result;
    }

    /**
     * @param string             $name
     * @param FormatterInterface $formatter
     *
     * @return string
     */
    protected function formatPropertyName(string $name, FormatterInterface $formatter): string
    {
        return $formatter->format($name);
    }

    /**
     * @throws InvalidLetterCaseException
     * @return FormatterInterface
     */
    protected function createFormatter(): FormatterInterface
    {
        return FormatterFactory::create($this->context->getCase());
    }
}
