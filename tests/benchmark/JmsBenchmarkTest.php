<?php
declare(strict_types=1);

namespace Cyradin\Serializer\Tests\benchmark;

use Cyradin\Serializer\Tests\Example\Basket;
use JMS\Serializer\ArrayTransformerInterface;
use JMS\Serializer\SerializerBuilder;

/**
 * Class JmsBenchmarkTest
 *
 * @package Cyradin\Serializer\Tests\benchmark
 */
class JmsBenchmarkTest extends BenchmarkTestCase
{
    /**
     * @dataProvider objectProvider
     *
     * @param Basket $basket
     * @param int    $count
     */
    public function testBenchmarkJmsArrayTransformer(Basket $basket, int $count)
    {
        /** @var ArrayTransformerInterface $serializer */
        $serializer = SerializerBuilder::create()->build();

        $time = microtime(true);
        for ($i = 0; $i < $count; $i++) {
            $serializer->toArray($basket);
        }

        codecept_debug('Time:' . (microtime(true) - $time));
    }
}
