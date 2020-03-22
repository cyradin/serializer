<?php
declare(strict_types=1);

namespace Cyradin\Serializer\Tests\unit\Serializer;

use Codeception\Stub\Expected;
use Codeception\Test\Unit;
use Cyradin\Serializer\Exception\RuntimeException;
use Cyradin\Serializer\Factory\ContextFactoryInterface;
use Cyradin\Serializer\Normalizer\NormalizerInterface;
use Cyradin\Serializer\Serializer;
use Cyradin\Serializer\ValueObject\SerializerContext;
use Exception;
use PHPUnit\Framework\ExpectationFailedException;
use ReflectionException;
use stdClass;

/**
 * Class ToArrayTest
 *
 * @package Cyradin\Serializer\Tests\unit\Serializer
 */
class ToArrayTest extends Unit
{
    /**
     * @throws RuntimeException
     * @throws ExpectationFailedException
     * @throws ReflectionException
     * @throws Exception
     */
    public function testCanTransformObjectToArray()
    {
        $expected = ['test'];
        $object = new stdClass();
        /** @var SerializerContext $context */
        $context = $this->makeEmpty(SerializerContext::class);
        /** @var ContextFactoryInterface $factory */
        $factory = $this->makeEmpty(
            ContextFactoryInterface::class,
            [
                'createSerializationContext' => Expected::never(),
            ]
        );
        /** @var NormalizerInterface $normalizer */
        $normalizer = $this->makeEmpty(
            NormalizerInterface::class,
            [
                'normalize' => Expected::once($expected),
            ]
        );

        $serializer = new Serializer($factory, $normalizer);
        $result = $serializer->toArray($object, $context);

        $this->assertSame($expected, $result);
    }

    /**
     * @throws RuntimeException
     * @throws ExpectationFailedException
     * @throws ReflectionException
     * @throws Exception
     */
    public function testCanTransformObjectToArrayWithoutContext()
    {
        $expected = ['test'];
        $object = new stdClass();
        $context = $this->makeEmpty(SerializerContext::class);
        /** @var ContextFactoryInterface $factory */
        $factory = $this->makeEmpty(
            ContextFactoryInterface::class,
            [
                'createSerializationContext' => Expected::once($context),
            ]
        );
        /** @var NormalizerInterface $normalizer */
        $normalizer = $this->makeEmpty(
            NormalizerInterface::class,
            [
                'normalize' => Expected::once($expected),
            ]
        );

        $serializer = new Serializer($factory, $normalizer);
        $result = $serializer->toArray($object);

        $this->assertSame($expected, $result);
    }
}
