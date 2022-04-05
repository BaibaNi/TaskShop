<?php
namespace App\Controllers;

use App\Redirect;
use App\View;
use App\Services\Product\Buy\BuyProductRequest;
use App\Services\Product\Buy\BuyProductService;
use App\Services\Product\Show\ShowProductRequest;
use App\Services\Product\Show\ShowProductService;
use App\Services\Product\Add\AddProductRequest;
use App\Services\Product\Add\AddProductService;
use App\Services\Product\Index\IndexProductService;
use Psr\Container\ContainerInterface;

class ProductsController
{

    private ContainerInterface $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function index(): View
    {
        $service = $this->container->get(IndexProductService::class);
        $products = $service->execute();

        return new View('Products/index', [
            'products' => $products
        ]);
    }

    public function show(array $vars): View
    {
        $productId = (int) $vars['id'];
        $service = $this->container->get(ShowProductService::class);
        $product = $service->execute(new ShowProductRequest($productId));

        return new View('Products/show', [
            'product' => $product
        ]);
    }

    public function addForm(): View
    {
        return new View('Products/add');
    }

    public function add(): Redirect
    {
        $service = $this->container->get(AddProductService::class);
        $service->execute(new AddProductRequest(
                $_POST['name'],
                $_POST['price'],
                $_POST['quantity'],
            )
        );
        return new Redirect('/products');

    }

    public function buy(array $vars): Redirect
    {
        $productId = (int) $vars['id'];

        $service = $this->container->get(BuyProductService::class);
        $service->execute(new BuyProductRequest(
            $productId,
            $_POST['quantity']
        ));

        return new Redirect("/products/{$productId}/buy");
    }

}