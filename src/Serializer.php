<?php
declare(strict_types=1);

namespace Cyradin\Serializer;

use Cyradin\Serializer\Exception\RuntimeException;
use Cyradin\Serializer\Factory\ContextFactoryInterface;
use Cyradin\Serializer\Normalizer\NormalizerInterface;
use Cyradin\Serializer\ValueObject\DeserializerContext;
use Cyradin\Serializer\ValueObject\SerializerContext;
use ReflectionException;

/**
 * Class Serializer
 *
 * @package Cyradin\Serializer
 */
class Serializer implements ArrayTransformerInterface, ContextFactoryInterface
{
    /**
     * @var ContextFactoryInterface
     */
    protected ContextFactoryInterface $contextFactory;

    /**
     * @var NormalizerInterface
     */
    protected NormalizerInterface $normalizer;

    /**
     * Serializer constructor.
     *
     * @param ContextFactoryInterface $contextFactory
     * @param NormalizerInterface     $normalizer
     */
    public function __construct(
        ContextFactoryInterface $contextFactory,
        NormalizerInterface $normalizer
    ) {
        $this->contextFactory = $contextFactory;
        $this->normalizer = $normalizer;
    }

    /**
     * @return SerializerContext
     */
    public function createSerializerContext(): SerializerContext
    {
        return $this->contextFactory->createSerializerContext();
    }

    /**
     * @return DeserializerContext
     */
    public function createDeserializerContext(): DeserializerContext
    {
        return $this->contextFactory->createDeserializerContext();
    }

    /**
     * @param object|object[]   $value
     * @param SerializerContext $context
     *
     * @throws ReflectionException
     * @throws RuntimeException
     *
     * @return array
     */
    public function toArray(object $value, SerializerContext $context = null): array
    {
        return $this->normalizer->normalize(
            $value,
            $context ?? $this->contextFactory->createSerializerContext()
        );
    }

    /**
     * @param array                    $value
     * @param DeserializerContext|null $context
     *
     * @return array|object
     */
    public function fromArray(array $value, DeserializerContext $context = null)
    {
        // TODO: Implement fromArray() method.
    }
}
