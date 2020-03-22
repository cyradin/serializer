<?php
declare(strict_types=1);

namespace Cyradin\Serializer\Factory;

use Cyradin\Serializer\ValueObject\DeserializerContext;
use Cyradin\Serializer\ValueObject\SerializerContext;

/**
 * Interface ContextFactoryInterface
 *
 * @package Cyradin\Serializer\Factory
 */
interface ContextFactoryInterface
{
    /**
     * @return SerializerContext
     */
    public function createSerializerContext(): SerializerContext;

    /**
     * @return DeserializerContext
     */
    public function createDeserializerContext(): DeserializerContext;
}
