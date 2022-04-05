<?php
namespace App\PaymentMethods;

class PayPalPaymentMethod implements PaymentMethod
{
    private string $email;

    public function __construct(string $email)
    {

        $this->email = $email;
    }

    public function pay(float $amount): void
    {
        var_dump($amount . ' EUR' . PHP_EOL . 'PayPal payment successful. Thank you, ' . $this->email . '!');
    }
}