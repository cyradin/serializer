<?php
declare(strict_types=1);

namespace Cyradin\Serializer\Tests\benchmark;

use Cyradin\Serializer\Exception\RuntimeException;
use Cyradin\Serializer\Tests\Example\Basket;
use Symfony\Component\Serializer\Exception\CircularReferenceException;
use Symfony\Component\Serializer\Exception\ExceptionInterface;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Normalizer\PropertyNormalizer;
use Symfony\Component\Serializer\Serializer;

/**
 * Class SymfonyBenchmarkTest
 *
 * @package Cyradin\Serializer\Tests\benchmark
 */
class SymfonyBenchmarkTest extends BenchmarkTestCase
{
    /**
     * @dataProvider objectProvider
     *
     * @param Basket $basket
     * @param int    $count
     *
     * @throws CircularReferenceException
     * @throws ExceptionInterface
     */
    public function testBenchmarkSymfonyGetSetNormalizer(Basket $basket, int $count)
    {
        $serializer = new Serializer([new GetSetMethodNormalizer()]);

        $time = microtime(true);
        for ($i = 0; $i < $count; $i++) {
            $serializer->normalize($basket);
        }

        codecept_debug('Time:' . (microtime(true) - $time));
    }

    /**
     * @dataProvider objectProvider
     *
     * @param Basket $basket
     * @param int    $count
     *
     * @throws CircularReferenceException
     * @throws ExceptionInterface
     */
    public function testBenchmarkSymfonyObjectNormalizer(Basket $basket, int $count)
    {
        $serializer = new Serializer([new ObjectNormalizer()]);

        $time = microtime(true);
        for ($i = 0; $i < $count; $i++) {
            $serializer->normalize($basket);
        }

        codecept_debug('Time:' . (microtime(true) - $time));
    }

    /**
     * @dataProvider objectProvider
     *
     * @param Basket $basket
     * @param int    $count
     *
     * @throws CircularReferenceException
     * @throws ExceptionInterface
     */
    public function testBenchmarkSymfonyPropertyNormalizer(Basket $basket, int $count)
    {
        $serializer = new Serializer([new PropertyNormalizer(), new DateTimeNormalizer()]);

        $time = microtime(true);
        for ($i = 0; $i < $count; $i++) {
            $serializer->normalize($basket);
        }

        codecept_debug('Time:' . (microtime(true) - $time));
    }
}
