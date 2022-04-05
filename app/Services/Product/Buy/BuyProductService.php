<?php
namespace App\Services\Product\Buy;

use App\Models\Purchase;
use App\Repositories\Product\ProductsRepository;
use Carbon\Carbon;

class BuyProductService
{
    private ProductsRepository $productsRepository;

    public function __construct(ProductsRepository $productsRepository)
    {
        $this->productsRepository = $productsRepository;
    }

    public function execute(BuyProductRequest $request): Purchase
    {
        $purchase = new Purchase(
            $request->getProductId(),
            $request->getQuantity(),
            Carbon::now()->format('Y-m-d'),
            1
        );

        $this->productsRepository->buyProduct($purchase);

        return $purchase;
    }
}