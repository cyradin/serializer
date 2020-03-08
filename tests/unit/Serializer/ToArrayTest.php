<?php
declare(strict_types=1);

namespace Cyradin\Serializer\Tests\unit\Serializer;

use Codeception\Test\Unit;
use Cyradin\Serializer\Context;
use Cyradin\Serializer\Serializer;
use Cyradin\Serializer\Tests\unit\Example\Basket;
use Cyradin\Serializer\Tests\unit\Example\BasketProduct;
use Cyradin\Serializer\Tests\unit\Example\Customer;
use Cyradin\Serializer\Tests\unit\Example\Price;
use Cyradin\Serializer\Tests\unit\Example\Product;
use Doctrine\Common\Collections\ArrayCollection;
use Exception;
use PHPUnit\Framework\ExpectationFailedException;
use ReflectionException;

/**
 * Class ToArrayTest
 *
 * @package Cyradin\Serializer\Tests\unit\Serializer
 */
class ToArrayTest extends Unit
{
    /**
     * @dataProvider objectProvider
     *
     * @param array|object $source
     * @param array        $context
     * @param array        $expected
     *
     * @throws ExpectationFailedException
     * @throws ReflectionException
     */
    public function testCanTransformObjectToArray($source, array $context, array $expected)
    {
        $serializerContext = new Context();
        $serializerContext->setSerializeNull($context[0]);
        $serializer = new Serializer($serializerContext);

        $result = $serializer->toArray($source);

        $this->assertEquals($expected, $result);
    }

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
        $productsWithKeys = new ArrayCollection(['key1' => $basketProduct1, 'key2' => $basketProduct2]);

        $basket = new Basket($products, $customer);

        return [
            [
                $basket,
                [
                    true,
                ],
                [
                    'products' => [
                        [
                            'product'   => [
                                'name'        => 'product1',
                                'description' => 'description1',
                            ],
                            'price'     => [
                                'value'    => 100.0,
                                'currency' => 'RUR',
                            ],
                            'createdAt' => $basketProduct1->getCreatedAt()
                                                          ->format(DATE_ATOM),
                        ],
                        [
                            'product'   => [
                                'name'        => 'product2',
                                'description' => 'description2',
                            ],
                            'price'     => [
                                'value'    => 200.0,
                                'currency' => 'RUR',
                            ],
                            'createdAt' => $basketProduct2->getCreatedAt()
                                                          ->format(DATE_ATOM),
                        ],
                    ],
                    'customer' => [
                        'name'  => 'user',
                        'email' => null,
                        'phone' => '123456',
                    ],
                ],
            ],
            [
                $products,
                [
                    true,
                ],
                [
                    [
                        'product'   => [
                            'name'        => 'product1',
                            'description' => 'description1',
                        ],
                        'price'     => [
                            'value'    => 100.0,
                            'currency' => 'RUR',
                        ],
                        'createdAt' => $basketProduct1->getCreatedAt()
                                                      ->format(DATE_ATOM),

                    ],
                    [
                        'product'   => [
                            'name'        => 'product2',
                            'description' => 'description2',
                        ],
                        'price'     => [
                            'value'    => 200.0,
                            'currency' => 'RUR',
                        ],
                        'createdAt' => $basketProduct2->getCreatedAt()
                                                      ->format(DATE_ATOM),
                    ],
                ],
            ],
            [
                $productsWithKeys,
                [
                    true,
                ],
                [
                    'key1' => [
                        'product'   => [
                            'name'        => 'product1',
                            'description' => 'description1',
                        ],
                        'price'     => [
                            'value'    => 100.0,
                            'currency' => 'RUR',
                        ],
                        'createdAt' => $basketProduct1->getCreatedAt()
                                                      ->format(DATE_ATOM),
                    ],
                    'key2' => [
                        'product'   => [
                            'name'        => 'product2',
                            'description' => 'description2',
                        ],
                        'price'     => [
                            'value'    => 200.0,
                            'currency' => 'RUR',
                        ],
                        'createdAt' => $basketProduct2->getCreatedAt()
                                                      ->format(DATE_ATOM),
                    ],
                ],
            ],
            [
                $customer,
                [
                    true,
                ],
                [
                    'name'  => 'user',
                    'email' => null,
                    'phone' => '123456',
                ],
            ],
            [
                $customer,
                [
                    false,
                ],
                [
                    'name'  => 'user',
                    'phone' => '123456',
                ],
            ],
        ];
    }
}
