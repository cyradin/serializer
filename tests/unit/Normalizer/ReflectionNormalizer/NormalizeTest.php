<?php
declare(strict_types=1);

namespace Cyradin\Serializer\Tests\unit\Normalizer\ReflectionNormalizer;

use Codeception\Test\Unit;
use Cyradin\Serializer\Exception\RuntimeException;
use Cyradin\Serializer\LetterCaseFormatter\FormatterInterface;
use Cyradin\Serializer\Normalizer\ReflectionNormalizer;
use Cyradin\Serializer\Tests\unit\Example\Basket;
use Cyradin\Serializer\Tests\unit\Example\BasketProduct;
use Cyradin\Serializer\Tests\unit\Example\Customer;
use Cyradin\Serializer\Tests\unit\Example\Price;
use Cyradin\Serializer\Tests\unit\Example\Product;
use Cyradin\Serializer\ValueObject\SerializerContext;
use Doctrine\Common\Collections\ArrayCollection;
use Exception;
use PHPUnit\Framework\ExpectationFailedException;
use ReflectionException;

/**
 * Class NormalizeTest
 *
 * @package Cyradin\Serializer\Tests\unit\Serializer
 */
class NormalizeTest extends Unit
{
    /**
     * @dataProvider objectProvider
     *
     * @param array|object $source
     * @param array        $expected
     *
     * @throws ExpectationFailedException
     * @throws RuntimeException
     * @throws ReflectionException
     * @throws Exception
     */
    public function testCanNormalizeObject($source, array $expected)
    {
        $formatter = $this->makeEmpty(
            FormatterInterface::class,
            [
                'format' => fn($value) => $value,
            ]
        );
        /** @var SerializerContext $context */
        $context = $this->makeEmpty(
            SerializerContext::class,
            ['getFormatter' => $formatter]
        );

        $serializer = new ReflectionNormalizer();
        $result = $serializer->normalize($source, $context);

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
                        'phone' => '123456',
                    ],
                ],
            ],
            [
                $products,
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
                    'name'  => 'user',
                    'phone' => '123456',
                ],
            ],
        ];
    }
}
