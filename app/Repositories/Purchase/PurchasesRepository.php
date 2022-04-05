<?php
namespace App\Repositories\Purchase;


interface PurchasesRepository
{
    public function getPurchaseById(int $productId): array;
}