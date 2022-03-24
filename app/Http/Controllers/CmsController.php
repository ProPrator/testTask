<?php

namespace App\Http\Controllers;

use App\Services\ItemServiceInterface;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class CmsController extends Controller
{
    /**
     * @var ItemServiceInterface
     */
    private ItemServiceInterface $itemService;

    /**
     * @param ItemServiceInterface $itemService
     */
    public function __construct(ItemServiceInterface $itemService)
    {
        $this->itemService = $itemService;
    }

    /**
     * @param int $id
     * @return Factory|View|Application
     */
    public function sendItem(int $id): Factory|View|Application
    {
        $this->itemService->send($id);

        return view('raffle.index');
    }
}
