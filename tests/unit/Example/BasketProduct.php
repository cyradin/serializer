<?php
declare(strict_types=1);

namespace Cyradin\Serializer\Tests\unit\Example;

use DateTime;
use DateTimeInterface;
use Exception;

/**
 * Class BasketProduct
 *
 * @package Cyradin\Serializer\Tests\unit\Example
 */
class BasketProduct
{
    /**
     * @var Product
     */
    protected Product $product;

    /**
     * @var Price
     */
    protected Price $price;

    /**
     * @var DateTimeInterface
     */
    protected DateTimeInterface $createdAt;

    /**
     * BasketProduct constructor.
     *
     * @param Product $product
     * @param Price   $price
     *
     * @throws Exception
     */
    public function __construct(Product $product, Price $price)
    {
        $this->product = $product;
        $this->price = $price;
        $this->createdAt = new DateTime();
    }

    /**
     * @return Product
     */
    public function getProduct(): Product
    {
        return $this->product;
    }

    /**
     * @return Price
     */
    public function getPrice(): Price
    {
        return $this->price;
    }

    /**
     * @return DateTimeInterface
     */
    public function getCreatedAt(): DateTimeInterface
    {
        return $this->createdAt;
    }
}
