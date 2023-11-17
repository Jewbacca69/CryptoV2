<?php
declare(strict_types=1);

namespace App;

use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\HttpClient\HttpClient;
use App\Collections\CurrencyCollection;
use App\Models\Currency;
use stdClass;

class CryptoApi
{
    private HttpClientInterface $client;
    private CurrencyCollection $currencyCollection;

    private const API_URL = "https://api4.binance.com/api/v3/ticker/24hr";

    public function __construct()
    {
        $this->client = HttpClient::create();
        $this->currencyCollection = new CurrencyCollection();
    }

    public function getCurrencies(): CurrencyCollection
    {
        foreach ($this->fetchData() as $currencyPair) {
            $this->currencyCollection->addCurrency
            (
                new Currency
                (
                    $currencyPair->symbol,
                    (string)$currencyPair->priceChange,
                    (string)$currencyPair->priceChangePercent,
                    (string)$currencyPair->weightedAvgPrice,
                    (string)$currencyPair->prevClosePrice,
                    (string)$currencyPair->lastPrice,
                    (string)$currencyPair->askPrice,
                    (string)$currencyPair->volume,
                    (string)$currencyPair->openTime,
                    (string)$currencyPair->closeTime
                )
            );
        }

        return $this->currencyCollection;
    }

    public function searchCurrency(string $pair): ?Currency
    {

        $currencies = $this->getCurrencies();

        $foundCurrency = null;

        foreach ($currencies->getCurrency() as $currency) {
            if ($currency->getSymbol() === $pair) {
                $foundCurrency = $currency;
                break;
            }

            $reversePair = substr($pair, 3) . substr($pair, 0, 3);
            if ($currency->getSymbol() === $reversePair) {
                $foundCurrency = $currency;
                break;
            }
        }

        return $foundCurrency;
    }

    private function fetchData(): stdClass
    {
        $request = $this->client->request("GET", self::API_URL);

        return (object)json_decode($request->getContent());
    }
}