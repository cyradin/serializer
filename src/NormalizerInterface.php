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
     * @param array|object $object
     *
     * @throws ReflectionException
     * @return array
     */
    public function toArray($object): array;
}
