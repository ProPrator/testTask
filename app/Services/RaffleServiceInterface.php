<?php

namespace App\Services;

use App\Models\Prize;

interface RaffleServiceInterface
{
    public function createPrize(): Prize;
}
