<?php
declare(strict_types=1);

namespace Cyradin\Serializer\Tests\Example;

/**
 * Class Customer
 *
 * @package Cyradin\Serializer\Tests\Example
 */
class Customer
{
    /**
     * @var string
     */
    protected string $name;

    /**
     * @var string|null
     */
    protected ?string $email;

    /**
     * @var string
     */
    protected string $phone;

    /**
     * Customer constructor.
     *
     * @param string      $name
     * @param string|null $email
     * @param string      $phone
     */
    public function __construct(string $name, ?string $email, string $phone)
    {
        $this->name = $name;
        $this->email = $email;
        $this->phone = $phone;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getPhone(): string
    {
        return $this->phone;
    }
}
