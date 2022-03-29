<?php
namespace App\Services\Product\Show;

use App\Repositories\Product\ProductsRepository;

class ShowProductService
{
    private ProductsRepository $productsRepository;

    public function __construct(ProductsRepository $productsRepository)
    {
        $this->productsRepository = $productsRepository;
    }

    public function execute(ShowProductRequest $request): array
    {
        return $this->productsRepository->getProductById($request->getId());
    }

}
