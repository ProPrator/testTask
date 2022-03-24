<?php

namespace App\Http\Controllers;

use App\Services\BonusServiceInterface;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class BonusController extends Controller
{
    /**
     * @var BonusServiceInterface
     */
    private BonusServiceInterface $bonusService;

    /**
     * @param BonusServiceInterface $bonusService
     */
    public function __construct(BonusServiceInterface $bonusService)
    {
        $this->bonusService = $bonusService;
    }

    /**
     * @param int $id
     * @return Factory|View|Application
     */
    public function send(int $id): Factory|View|Application
    {
        $userId = Auth::id();

        $this->bonusService->send($userId, $id);

        return view('raffle.index');
    }
}
