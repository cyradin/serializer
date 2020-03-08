<?php
declare(strict_types=1);

namespace Cyradin\Serializer;

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
     * @param array|object $object
     *
     * @throws ReflectionException
     * @return array
     */
    public function toArray($object): array
    {
        $result = [];
        if (is_iterable($object)) {
            foreach ($object as $key => $item) {
                $result[$key] = $this->toArray($item);
            }
        } else {
            $reflection = new ReflectionClass($object);
            foreach ($reflection->getProperties() as $property) {
                $value = $this->serializeProperty($property, $object);
                if ($value === null && !$this->context->isSerializeNull()) {
                    continue;
                }
                $result[$property->getName()] = $value;
            }
        }

        return $result;
    }

    /**
     * @param ReflectionProperty $reflection
     * @param object             $source
     *
     * @throws ReflectionException
     * @return array|mixed
     */
    protected function serializeProperty(ReflectionProperty $reflection, object $source)
    {
        $reflection->setAccessible(true);
        $value = $reflection->getValue($source);
        if ($reflection->isPrivate() || $reflection->isProtected()) {
            $reflection->setAccessible(false);
        }

        if ($value instanceof DateTimeInterface) {
            $result = $value->format(DATE_ATOM);
        } elseif (is_object($value)) {
            $result = $this->toArray($value);
        } else {
            $result = $value;
        }

        return $result;
    }
}
