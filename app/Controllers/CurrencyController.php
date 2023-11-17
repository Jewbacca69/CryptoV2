<?php
declare(strict_types=1);

namespace App\Controllers;

use App\CryptoApi;

class CurrencyController extends BaseController
{
    private CryptoApi $cryptoApi;

    public function __construct()
    {
        parent::__construct();
        $this->cryptoApi = new CryptoApi();
    }

    public function index(): string
    {
        $currencies = $this->cryptoApi->getCurrencies()->getCurrency();
        shuffle($currencies);
        $limitedCurrencies = array_slice($currencies, 0, 3);

        return $this->render('index.twig', ['currencies' => $limitedCurrencies]);
    }

    public function search(): string
    {
        $pair = empty($_GET["cryptoPair"]) ? null : $this->cryptoApi->searchCurrency($_GET["cryptoPair"]);
        return $this->render('search.twig', ['currency' => $pair]);
    }
}