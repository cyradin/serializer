<?php
declare(strict_types=1);

namespace Cyradin\Serializer\Normalizer;

use Cyradin\Serializer\Exception\InvalidLetterCaseException;
use Cyradin\Serializer\Exception\RuntimeException;
use Cyradin\Serializer\LetterCaseFormatter\FormatterInterface;
use Cyradin\Serializer\ValueObject\SerializerContext;
use DateTimeInterface;
use ReflectionClass;
use ReflectionException;
use ReflectionProperty;

/**
 * Class ReflectionNormalizer
 *
 * @package Cyradin\Serializer\Normalizer
 */
class ReflectionNormalizer implements NormalizerInterface
{
    /**
     * @param object[]|object   $value
     *
     * @param SerializerContext $context
     *
     * @throws ReflectionException
     * @throws RuntimeException
     * @return array
     */
    public function normalize($value, SerializerContext $context): array
    {
        if (is_iterable($value)) {
            $result = [];
            foreach ($value as $key => $item) {
                $result[$key] = $this->doNormalize(
                    $item,
                    $context
                );
            }
        } else {
            $result = $this->doNormalize(
                $value,
                $context
            );
        }

        return $result;
    }

    /**
     * @param object            $object
     * @param SerializerContext $context
     *
     * @throws ReflectionException
     * @throws RuntimeException
     * @throws InvalidLetterCaseException
     * @return array
     */
    protected function doNormalize(object $object, SerializerContext $context): array
    {
        $result = [];
        $reflection = new ReflectionClass($object);
        foreach ($reflection->getProperties() as $property) {
            $value = $this->extractPropertyValue($property, $object, $context);
            if ($value === null && !$context->isSerializeNull()) {
                continue;
            }
            $name = $this->formatPropertyName($property->getName(), $context->getFormatter());

            $result[$name] = $value;
        }

        return $result;
    }

    /**
     * @param ReflectionProperty $reflection
     * @param object             $source
     * @param SerializerContext  $context
     *
     * @throws InvalidLetterCaseException
     * @throws ReflectionException
     * @throws RuntimeException
     * @return array|int|float|bool|null
     */
    protected function extractPropertyValue(ReflectionProperty $reflection, object $source, SerializerContext $context)
    {
        $reflection->setAccessible(true);
        $value = $reflection->getValue($source);
        if ($reflection->isPrivate() || $reflection->isProtected()) {
            $reflection->setAccessible(false);
        }

        if (is_iterable($value)) {
            $result = [];
            foreach ($value as $key => $item) {
                $result[$key] = $this->doNormalize($item, $context);
            }
        } elseif ($value instanceof DateTimeInterface) {
            $result = $value->format(DATE_ATOM);
        } elseif (is_object($value)) {
            $result = $this->doNormalize($value, $context);
        } else {
            $result = $value;
        }

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
}
