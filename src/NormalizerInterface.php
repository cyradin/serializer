<?php
declare(strict_types=1);

namespace Cyradin\Serializer;

use ReflectionException;

/**
 * Class Serializer
 *
 * @package Cyradin\Serializer
 */
interface NormalizerInterface
{
    /**
     * @param $value
     *
     * @throws ReflectionException
     * @return array|string|int|float|bool|null
     */
    public function normalize($value);
}
