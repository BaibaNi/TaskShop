<?php
namespace App\PaymentMethods;

interface PaymentMethod
{
    public function pay(float $amount): void;
}