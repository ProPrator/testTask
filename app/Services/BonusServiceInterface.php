<?php

namespace App\Services;

interface BonusServiceInterface
{
    public function send(int $userId, int $prizeId): void;
}
