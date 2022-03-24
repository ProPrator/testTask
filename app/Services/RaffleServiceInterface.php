<?php

namespace App\Services;

use App\Models\Prize;

interface RaffleServiceInterface
{
    public function createPrize(int $userId): Prize;

    public function convertPrize(int $prizeId, int $userId): void;

    public function refusePrize(int $prizeId): void;
}
