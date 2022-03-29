<?php
namespace App\Services\Product\index;

use App\Models\Product;
use App\Repositories\Product\ProductsRepository;

class IndexProductService
{
    private ProductsRepository $productsRepository;

    public function __construct(ProductsRepository $productsRepository)
    {
        $this->productsRepository = $productsRepository;
    }

    public function execute(): array
    {
        $allProducts = $this->productsRepository->getProductsList();

        $productList = [];
        foreach ($allProducts as $product){
            $productList[] = new Product(
                $product['name'],
                $product['price'],
                $product['quantity'],
                $product['created_at'],
                $product['id']
            );
        }

        return $productList;
    }
}