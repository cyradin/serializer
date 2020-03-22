<?php
declare(strict_types=1);

namespace Cyradin\Serializer\Tests\benchmark;

use Cyradin\Serializer\Exception\RuntimeException;
use Cyradin\Serializer\Factory\ContextFactory;
use Cyradin\Serializer\Factory\FormatterFactory;
use Cyradin\Serializer\Normalizer\ReflectionNormalizer;
use Cyradin\Serializer\Serializer;
use Cyradin\Serializer\Tests\Example\Basket;
use ReflectionException;

/**
 * Class PackageBenchmark
 *
 * @package Cyradin\Serializer\Tests\benchmark
 */
class PackageBenchmarkTest extends BenchmarkTestCase
{
    /**
     * @dataProvider objectProvider
     *
     * @param Basket $basket
     * @param int    $count
     *
     * @throws RuntimeException
     * @throws ReflectionException
     */
    public function testBenchmarkPackageReflectionNormalizer(Basket $basket, int $count)
    {
        $serializer = new Serializer(new ContextFactory(new FormatterFactory()), new ReflectionNormalizer());

        $time = microtime(true);
        for ($i = 0; $i < $count; $i++) {
            $serializer->toArray($basket);
        }

        codecept_debug('Time:' . (microtime(true) - $time));
    }
}
