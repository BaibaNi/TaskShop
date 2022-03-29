<?php
namespace App\Services\Product\Add;

use App\Models\Product;
use App\Repositories\Product\ProductsRepository;
use Carbon\Carbon;

class AddProductService
{
    private ProductsRepository $productsRepository;

    public function __construct(ProductsRepository $productsRepository)
    {
        $this->productsRepository = $productsRepository;
    }

    public function execute(AddProductRequest $request): Product
    {
        $product = new Product(
            $request->getName(),
            $request->getPrice(),
            $request->getQuantity(),
            Carbon::now()->format('Y-m-d'),
            1
        );

        $this->productsRepository->addProduct($product);

        return $product;
    }
}