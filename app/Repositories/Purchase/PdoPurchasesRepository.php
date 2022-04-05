<?php
namespace App\Repositories\Purchase;

use App\Database;

class PdoPurchasesRepository implements PurchasesRepository
{

    public function getPurchaseById(int $productId): array
    {
        $query = Database::connection()
            ->prepare('SELECT * FROM product_purchases where product_id = ? order by created_at desc');
        $query->bindValue(1, $productId);

        return $query
            ->executeQuery()
            ->fetchAssociative();
    }



}