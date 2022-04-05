<?php
namespace App\Services\Purchase\Show;

use App\Models\Product;
use App\Models\Purchase;

class ShowPurchaseResponse
{
    private Product $product;
    private Purchase $purchase;

    public function __construct(Product $product, Purchase $purchase)
    {
        $this->product = $product;
        $this->purchase = $purchase;
    }

    public function getProduct(): Product
    {
        return $this->product;
    }

    public function getPurchase(): Purchase
    {
        return $this->purchase;
    }
}