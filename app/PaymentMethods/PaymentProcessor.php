<?php
namespace App\PaymentMethods;

class PaymentProcessor
{
    private PaymentMethod $paymentMethod;

    public function __construct(PaymentMethod $paymentMethod)
    {
        $this->paymentMethod = $paymentMethod;
    }

    public function handle(float $amount)
    {
        $this->paymentMethod->pay($amount);
    }
}