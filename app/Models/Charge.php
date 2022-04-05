<?php
namespace App\Models;

class Charge
{
    private float $chargeAmount;

    public function __construct(float $chargeAmount)
    {
        $this->chargeAmount = $chargeAmount;
    }

    public function getChargeAmount(): float
    {
        return $this->chargeAmount;
    }
}