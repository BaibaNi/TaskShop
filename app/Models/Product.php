<?php
namespace App\Models;

class Product
{
    private string $name;
    private float $price;
    private int $quantity;
    private ?string $createdAt;
    private ?int $id;


    public function __construct(string $name, float $price, int $quantity, ?string $createdAt, ?int $id)
    {
        $this->name = $name;
        $this->price = $price;
        $this->quantity = $quantity;
        $this->createdAt = $createdAt;
        $this->id = $id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    public function getId(): int
    {
        return $this->id;
    }
}