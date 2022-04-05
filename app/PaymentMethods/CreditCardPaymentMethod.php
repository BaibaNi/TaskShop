<?php
namespace App\PaymentMethods;

class CreditCardPaymentMethod implements PaymentMethod
{

    private string $number;
    private string $cvc;
    private string $cardOwner;

    public function __construct(string $number, string $cvc, string $cardOwner)
    {

        $this->number = $number;
        $this->cvc = $cvc;
        $this->cardOwner = $cardOwner;
    }

    public function pay(float $amount): void
    {
        var_dump($amount . ' EUR' . PHP_EOL . 'Credit Card (' . $this->number . ') payment successful. Thank you, ' . $this->cardOwner . '!');
    }
}