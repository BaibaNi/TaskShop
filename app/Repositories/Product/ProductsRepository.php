<?php
namespace App\Repositories\Product;

use App\Models\Product;

interface ProductsRepository
{
    public function getProductsList(): array;
    public function getProductById(int $productId): array;
    public function addProduct(Product $product): void;
}