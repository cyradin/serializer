<?php
declare(strict_types=1);

namespace Cyradin\Serializer;

use Cyradin\Serializer\Enum\LetterCase;

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
     * @var string
     */
    protected string $case = LetterCase::FORMAT_CAMEL_CASE;

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

    /**
     * @return string
     */
    public function getCase(): string
    {
        return $this->case;
    }

    /**
     * @param string $case
     *
     * @return Context
     */
    public function setCase(string $case): Context
    {
        $this->case = $case;

        return $this;
    }
}
