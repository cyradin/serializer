<?php
declare(strict_types=1);

namespace Cyradin\Serializer;

/**
 * Class Context
 *
 * @package Cyradin\Serializer
 */
class Context
{
    /**
     * @var bool
     */
    protected bool $serializeNull = false;

    /**
     * @return bool
     */
    public function isSerializeNull(): bool
    {
        return $this->serializeNull;
    }

    /**
     * @param bool $serializeNull
     *
     * @return Context
     */
    public function setSerializeNull(bool $serializeNull): Context
    {
        $this->serializeNull = $serializeNull;

        return $this;
    }
}
