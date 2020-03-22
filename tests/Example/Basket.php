<?php
declare(strict_types=1);

namespace Cyradin\Serializer\Tests\Example;

use Doctrine\Common\Collections\Collection;

/**
 * Class Basket
 *
 * @package Cyradin\Serializer\Tests\Example
 */
class Basket
{
    /**
     * @var Collection
     */
    protected Collection $products;

    /**
     * @var Customer
     */
    protected Customer $customer;

    /**
     * Basket constructor.
     *
     * @param Collection $products
     * @param Customer   $customer
     */
    public function __construct(Collection $products, Customer $customer)
    {
        $this->products = $products;
        $this->customer = $customer;
    }

    /**
     * @return Collection
     */
    public function getProducts(): Collection
    {
        return $this->products;
    }

    /**
     * @return Customer
     */
    public function getCustomer(): Customer
    {
        return $this->customer;
    }
}
