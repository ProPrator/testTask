<?php

namespace App\Http\Controllers;

use App\Services\RaffleServiceInterface;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class RafflePrizeController extends Controller
{
    /**
     * @var RaffleServiceInterface
     */
    private RaffleServiceInterface $raffleService;

    /**
     * @param RaffleServiceInterface $raffleService
     */
    public function __construct(RaffleServiceInterface $raffleService)
    {
        $this->raffleService = $raffleService;
    }
    /**
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
        return view('raffle.index');
    }

    /**
     * @return Factory|View|Application
     */
    public function raffle(): Factory|View|Application
    {
        $prize = $this->raffleService->createPrize();

        return view('raffle.congratulation', ['prize' => $prize]);
    }

    public function convert()
    {
        echo 'h1';
    }

    public function refuse()
    {

    }
}
