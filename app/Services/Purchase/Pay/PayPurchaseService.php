<?php
namespace App\Services\Purchase\Pay;

use App\PaymentMethods\CreditCardPaymentMethod;
use App\PaymentMethods\PaymentProcessor;
use App\PaymentMethods\PayPalPaymentMethod;

class PayPurchaseService
{
    // orders repository

    public function execute(PayPurchaseRequest $request)
    {
        $selectedPaymentMethod = $request->getPaymentMethod();
        $paymentMethod = '';
        $amount = $request->getAmount();
        $payload = $request->getPayload();


        switch ($selectedPaymentMethod)
        {
            case 'paypal':
                $paymentMethod = new PayPalPaymentMethod($payload['email']);
                break;
            case 'credit_card':
                $paymentMethod = new CreditCardPaymentMethod($payload['number'], $payload['cvc'], $payload['name']);
                break;
            default:
                var_dump('No payment method selected.');
                break;
        }


        (new PaymentProcessor($paymentMethod))->handle($amount);
    }
}