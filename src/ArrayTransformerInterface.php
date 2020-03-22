<?php
declare(strict_types=1);

namespace Cyradin\Serializer;

use Cyradin\Serializer\ValueObject\DeserializerContext;
use Cyradin\Serializer\ValueObject\SerializerContext;
use Cyradin\Serializer\Exception\RuntimeException;
use ReflectionException;

/**
 * Interface ArrayTransformerInterface
 *
 * @package Cyradin\Serializer
 */
interface ArrayTransformerInterface
{
    /**
     * @param object|object[] $value
     * @param SerializerContext|null $context
     *
     * @throws ReflectionException
     * @throws RuntimeException
     * @return array
     */
    public function toArray(object $value, SerializerContext $context = null): array;

    /**
     * @param array                    $value
     * @param DeserializerContext|null $context
     *
     * @return array|object
     */
    public function fromArray(array $value, DeserializerContext $context = null);
}
