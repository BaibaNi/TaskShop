<?php
namespace App\Services\Purchase\Show;

use App\Models\Product;
use App\Models\Purchase;
use App\Repositories\Product\ProductsRepository;
use App\Repositories\Purchase\PurchasesRepository;

class ShowPurchaseService
{
    private ProductsRepository $productsRepository;
    private PurchasesRepository $purchaseRepository;

    public function __construct(ProductsRepository $productsRepository, PurchasesRepository $purchaseRepository)
    {
        $this->productsRepository = $productsRepository;
        $this->purchaseRepository = $purchaseRepository;
    }

    public function execute(ShowPurchaseRequest $request): ShowPurchaseResponse
    {
        $productInfo = $this->productsRepository->getProductById($request->getProductId());
        $product = new Product(
            $productInfo['name'],
            (float) $productInfo['price'],
            (int) $productInfo['quantity'],
            $productInfo['createdAt'],
            (int) $productInfo['id']
        );

        $purchaseInfo = $this->purchaseRepository->getPurchaseById($request->getProductId());
        $purchase = new Purchase(
            (int) $purchaseInfo['product_id'],
            (int) $purchaseInfo['quantity'],
            $purchaseInfo['createdAt'],
            (int) $purchaseInfo['id']
        );


        return new ShowPurchaseResponse(
            $product,
            $purchase
        );
    }

}
