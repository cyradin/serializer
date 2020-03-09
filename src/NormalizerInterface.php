<?php
declare(strict_types=1);

namespace Cyradin\Serializer;

use Cyradin\Serializer\Exception\RuntimeException;
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
     * @throws RuntimeException
     * @return array|string|int|float|bool|null
     */
    public function normalize($value);
}
