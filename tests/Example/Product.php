<?php
declare(strict_types=1);

namespace Cyradin\Serializer\Tests\Example;

/**
 * Class Product
 *
 * @package Cyradin\Serializer\Tests\Example
 */
class Product
{
    /**
     * @var string
     */
    protected string $name;

    /**
     * @var string
     */
    protected string $description;

    /**
     * Product constructor.
     *
     * @param string $name
     * @param string $description
     */
    public function __construct(string $name, string $description)
    {
        $this->name = $name;
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }
}
