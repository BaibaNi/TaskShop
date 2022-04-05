<?php
namespace App\Services\Purchase\Pay;

class PayPurchaseRequest
{
    private string $paymentMethod;
    private float $amount;
    private array $payload;

    public function __construct(string $paymentMethod, float $amount, array $payload)
    {
        $this->paymentMethod = $paymentMethod;
        $this->amount = $amount;
        $this->payload = $payload;
    }


    public function getPaymentMethod(): string
    {
        return $this->paymentMethod;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function getPayload(): array
    {
        return $this->payload;
    }
}