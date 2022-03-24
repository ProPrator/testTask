<?php

namespace App\Models;

interface MoneyTransportInterface
{
    public function send(string $cardNumber, int $moneyId):bool;
}
