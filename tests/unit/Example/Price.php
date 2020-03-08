<?php
declare(strict_types=1);

namespace Cyradin\Serializer\Tests\unit\Example;

/**
 * Class Price
 *
 * @package Cyradin\Serializer\Tests\unit\Example
 */
class Price
{
    /**
     * @var float
     */
    protected float $value;

    /**
     * @var string
     */
    protected string $currency;

    /**
     * Price constructor.
     *
     * @param float  $value
     * @param string $currency
     */
    public function __construct(float $value, string $currency)
    {
        $this->value = $value;
        $this->currency = $currency;
    }

    /**
     * @return float
     */
    public function getValue(): float
    {
        return $this->value;
    }

    /**
     * @return string
     */
    public function getCurrency(): string
    {
        return $this->currency;
    }
}
