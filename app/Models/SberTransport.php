<?php

namespace App\Models;

use Illuminate\Support\Facades\Log;

class SberTransport implements MoneyTransportInterface
{
    /**
     * @var string
     */
    private string $requestUrl = 'https://securepayments.sberbank.cz/payment/send';

    /**
     * @param string $cardNumber
     * @param int $moneyId
     * @return bool
     */
    public function send(string $cardNumber, int $moneyId): bool
    {
        $moneyObj = Money::where('id', $moneyId)->first();
        $moneyCount = $moneyObj->cents;
        return $this->sending($cardNumber, $moneyCount);
    }

    /**
     * @param string $cardNumber
     * @param int $moneyCount
     * @return bool
     */
    private function sending(string $cardNumber, int $moneyCount): bool
    {
        $data = [
            'cardNumber' => $cardNumber,
            'count' => $moneyCount/100,
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$this->requestUrl);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS,  http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec ($ch);
        curl_close ($ch);

        Log::notice($response);

//        return json_encode($response)['code'] == 200;
        return true;
    }
}
