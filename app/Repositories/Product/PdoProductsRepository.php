<?php
namespace App\Repositories\Product;

use App\Database;
use App\Models\Product;

class PdoProductsRepository implements ProductsRepository
{
    public function getProductsList(): array
    {
        return Database::connection()
            ->prepare('SELECT * FROM products order by created_at desc')
            ->executeQuery()
            ->fetchAllAssociative();
    }

    public function getProductById(int $productId): array
    {
        $query = Database::connection()
            ->prepare('SELECT * FROM products where id = ?');
        $query->bindValue(1, $productId);

        return $query
            ->executeQuery()
            ->fetchAssociative();
    }

    public function addProduct(Product $product): void
    {
        Database::connection()
            ->insert('products', [
                'name' => $product->getName(),
                'price' => $product->getPrice(),
                'quantity' => $product->getQuantity()
            ]);
    }
}