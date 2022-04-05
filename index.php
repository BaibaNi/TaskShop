<?php

require_once "vendor/autoload.php";
session_start();

use App\Redirect;
use App\Repositories\Product\PdoProductsRepository;
use App\Repositories\Product\ProductsRepository;
use App\Repositories\Purchase\PdoPurchasesRepository;
use App\Repositories\Purchase\PurchasesRepository;
use App\View;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use App\Controllers\ProductsController;
use App\Controllers\PurchasesController;


$builder = new DI\ContainerBuilder();
$builder->addDefinitions([
    ProductsRepository::class => DI\create(PdoProductsRepository::class),
    PurchasesRepository::class => DI\create(PdoPurchasesRepository::class)
]);
$container = $builder->build();


$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r) {
    $r->addRoute('GET', '/products', [ProductsController::class, 'index']);
    $r->addRoute('GET', '/products/{id:\d+}', [ProductsController::class, 'show']);
    $r->addRoute('GET', '/products/add', [ProductsController::class, 'addForm']);
    $r->addRoute('POST', '/products', [ProductsController::class, 'add']);
    $r->addRoute('POST', '/products/{id:\d+}/buy', [ProductsController::class, 'buy']);

    $r->addRoute('GET', '/products/{id:\d+}/buy', [PurchasesController::class, 'show']);
    $r->addRoute('POST', '/products/{id:\d+}/pay', [PurchasesController::class, 'pay']);


});

$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        //var_dump('404 Not Found');
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        //var_dump('405 Method Not Allowed');
        break;
    case FastRoute\Dispatcher::FOUND:
        $controller = $routeInfo[1][0];
        $method = $routeInfo[1][1];
        $vars = $routeInfo[2];

        /** @var View $response */
        $response = (new $controller($container))->$method($vars);

        $loader = new FilesystemLoader('app/Views');
        $twig = new Environment($loader);
//        $twig->addExtension(new CssInlinerExtension());
//        $twig->addGlobal('session', $_SESSION);
//        $twig->addFunction(
//            new TwigFunction('errors', function(string $url) { return Errors::getAll(); })
//        );


        if($response instanceof View)
        {
            echo $twig->render($response->getPath() . '.html', $response->getVariables());
        }

        if($response instanceof Redirect)
        {
            header('Location: ' . $response->getLocation());
            exit;
        }

        break;
}