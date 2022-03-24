<?php

namespace App\Http\Controllers;

use App\Services\RaffleServiceInterface;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

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
        $userId = Auth::id();

        $prize = $this->raffleService->createPrize($userId);

        return view('raffle.congratulation', ['prize' => $prize]);
    }

    /**
     * @param int $id
     * @return Factory|View|Application
     */
    public function convert(int $id): Factory|View|Application
    {
        $userId = Auth::id();

        $this->raffleService->convertPrize($id, $userId);

        return view('raffle.index');
    }

    /**
     * @param int $id
     * @return Factory|View|Application
     */
    public function refuse(int $id): Factory|View|Application
    {
        $this->raffleService->refusePrize($id);

        return view('raffle.index');
    }
}
