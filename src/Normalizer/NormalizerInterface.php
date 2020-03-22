<?php
declare(strict_types=1);

namespace Cyradin\Serializer\Normalizer;

use Cyradin\Serializer\Exception\RuntimeException;
use Cyradin\Serializer\ValueObject\SerializerContext;
use ReflectionException;

/**
 * Class Serializer
 *
 * @package Cyradin\Serializer
 */
interface NormalizerInterface
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
    public function normalize($value, SerializerContext $context): array;
}
