<?php
namespace App\Controllers;

use App\Models\Charge;
use App\Models\CreditCardPayload;
use App\Models\Payload;
use App\Models\PayPalPayload;
use App\Services\Purchase\Pay\PayPurchaseRequest;
use App\Services\Purchase\Pay\PayPurchaseService;
use App\Services\Purchase\Show\ShowPurchaseRequest;
use App\Services\Purchase\Show\ShowPurchaseService;
use App\View;
use Psr\Container\ContainerInterface;

class PurchasesController
{

    private ContainerInterface $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function show(array $vars): View
    {
        $productId = (int) $vars['id'];
        $service = $this->container->get(ShowPurchaseService::class);
        $response = $service->execute(new ShowPurchaseRequest($productId));

        return new View('Purchases/show', [
            'product' => $response->getProduct(),
            'purchase' => $response->getPurchase()
        ]);
    }

    public function pay(): void
    {
        $selectedPaymentMethod = 'credit_card';

        $payload = [];
        switch($selectedPaymentMethod)
        {
            case 'paypal':
                $payload = ['email' => 'email@email.com'];
                break;
            case 'credit_card':
                $payload = [
                    'number' => '111112222233333',
                    'cvc' => '123',
                    'name' => 'Test Name'
                ];
                break;
            default:
                var_dump('No data provided.');
                break;
        }


        $service = new PayPurchaseService();
        $service->execute(new PayPurchaseRequest(
            $selectedPaymentMethod,
            3.33,
            $payload
        ));
    }
}