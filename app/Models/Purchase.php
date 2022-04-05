<?php
namespace App\Models;

class Purchase
{
    private int $productId;
    private int $quantity;
    private ?string $createdAt;
    private ?int $id;

    public function __construct(int $productId, int $quantity, ?string $createdAt, ?int $id)
    {
        $this->productId = $productId;
        $this->quantity = $quantity;
        $this->createdAt = $createdAt;
        $this->id = $id;
    }

    public function getProductId(): int
    {
        return $this->productId;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function getCreatedAt(): ?string
    {
        return $this->createdAt;
    }

    public function getId(): ?int
    {
        return $this->id;
    }
}