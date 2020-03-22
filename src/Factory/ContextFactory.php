<?php
declare(strict_types=1);

namespace Cyradin\Serializer\Factory;

use Cyradin\Serializer\ValueObject\DeserializerContext;
use Cyradin\Serializer\ValueObject\SerializerContext;

/**
 * Class ContextFactory
 *
 * @package Cyradin\Serializer\Factory
 */
class ContextFactory implements ContextFactoryInterface
{
    /**
     * @var FormatterFactoryInterface
     */
    protected FormatterFactoryInterface $formatterFactory;

    /**
     * ContextFactory constructor.
     *
     * @param FormatterFactoryInterface $formatterFactory
     */
    public function __construct(FormatterFactoryInterface $formatterFactory)
    {
        $this->formatterFactory = $formatterFactory;
    }

    /**
     * @return SerializerContext
     */
    public function createSerializerContext(): SerializerContext
    {
        return new SerializerContext($this->formatterFactory);
    }

    /**
     * @return DeserializerContext
     */
    public function createDeserializerContext(): DeserializerContext
    {
        return new DeserializerContext();
    }
}
