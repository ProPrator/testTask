<?php

namespace App\Http\Controllers;

use App\Models\MoneyTransportInterface;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class MoneyController extends Controller
{
    /**
     * @var MoneyTransportInterface
     */
    private MoneyTransportInterface $transport;

    /**
     * @param MoneyTransportInterface $transport
     */
    public function __construct(MoneyTransportInterface $transport)
    {
        $this->transport = $transport;
    }

    /**
     * @param Request $request
     * @return Factory|View|Application
     */
    public function send(Request $request): Factory|View|Application
    {
        $cardNumber = $request->input('cardNumber');
        $moneyId = $request->input('moneyId');

        if ($this->transport->send($cardNumber, $moneyId)) {
            $message = 'success';
        } else {
            $message = 'error';
        }

        return view('raffle.index', ['message', $message]);
    }

}
