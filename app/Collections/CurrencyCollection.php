<?php
declare(strict_types=1);

namespace App\Collections;

use App\Models\Currency;

class CurrencyCollection
{
    private array $currency;

    public function __construct()
    {
        $this->currency = [];
    }

    public function addCurrency(Currency $currency) {
        $this->currency[] = $currency;
    }

    public function getCurrency(): array
    {
        return $this->currency;
    }
}