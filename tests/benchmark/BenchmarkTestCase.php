<?php
declare(strict_types=1);

namespace Cyradin\Serializer\Tests\benchmark;

use Codeception\Test\Unit;
use Cyradin\Serializer\Tests\Example\Basket;
use Cyradin\Serializer\Tests\Example\BasketProduct;
use Cyradin\Serializer\Tests\Example\Customer;
use Cyradin\Serializer\Tests\Example\Price;
use Cyradin\Serializer\Tests\Example\Product;
use Doctrine\Common\Collections\ArrayCollection;
use Exception;

/**
 * Class BenchmarkTestCase
 *
 * @package Cyradin\Serializer\Tests\benchmark
 */
class BenchmarkTestCase extends Unit
{
    /**
     * @throws Exception
     * @return array
     */
    public function objectProvider(): array
    {
        $product1 = new Product('product1', 'description1');
        $product2 = new Product('product2', 'description2');
        $price1 = new Price(100.0, 'RUR');
        $price2 = new Price(200.0, 'RUR');
        $basketProduct1 = new BasketProduct($product1, $price1);
        $basketProduct2 = new BasketProduct($product2, $price2);
        $customer = new Customer('user', null, '123456');
        $products = new ArrayCollection([$basketProduct1, $basketProduct2]);
        $basket = new Basket($products, $customer);

        return [
            [$basket, 1],
            [$basket, 100],
            [$basket, 10000],
        ];
    }
}
