<?php
declare(strict_types=1);

namespace App\Models;

use Carbon\Carbon;

class Currency
{
    private string $symbol;
    private string $priceChange;
    private string $priceChangePercent;
    private string $weightedAvgPrice;
    private string $prevClosePrice;
    private string $lastPrice;
    private string $askPrice;
    private string $volume;
    private string $openTime;
    private string $closeTime;

    public function __construct
    (
        string $symbol,
        string $priceChange,
        string $priceChangePercent,
        string $weightedAvgPrice,
        string $prevClosePrice,
        string $lastPrice,
        string $askPrice,
        string $volume,
        string $openTime,
        string $closeTime
    )
    {
        $this->symbol = $symbol;
        $this->priceChange = $priceChange;
        $this->priceChangePercent = $priceChangePercent;
        $this->weightedAvgPrice = $weightedAvgPrice;
        $this->prevClosePrice = $prevClosePrice;
        $this->lastPrice = $lastPrice;
        $this->askPrice = $askPrice;
        $this->volume = $volume;
        $this->openTime = $openTime;
        $this->closeTime = $closeTime;
    }

    public function getVolume(): string
    {
        return $this->volume;
    }

    public function getSymbol(): string
    {
        return $this->symbol;
    }

    public function getAskPrice(): string
    {
        return $this->askPrice;
    }

    public function getLastPrice(): string
    {
        return $this->lastPrice;
    }

    public function getOpenTime(): string
    {
        return Carbon::createFromTimestamp($this->openTime / 1000)->format('Y/m/d H:i');
    }

    public function getCloseTime(): string
    {
        return Carbon::createFromTimestamp($this->closeTime / 1000)->format('Y/m/d H:i');
    }

    public function getPrevClosePrice(): string
    {
        return $this->prevClosePrice;
    }

    public function getPriceChange(): string
    {
        return $this->priceChange;
    }

    public function getPriceChangePercent(): string
    {
        return $this->priceChangePercent . "%";
    }

    public function getWeightedAvgPrice(): string
    {
        return $this->weightedAvgPrice;
    }
}