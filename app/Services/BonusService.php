<?php

namespace App\Services;

use App\Models\EntityStatus;
use App\Models\EntityType;
use App\Models\Prize;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class BonusService implements BonusServiceInterface
{

    public function send(int $userId, int $prizeId): void
    {
        $user = User::where('id', $userId)->first();

        $prize = Prize::where(['id' => $prizeId, 'type' => EntityType::BONUS])->first();

        DB::beginTransaction();

            $prize->status = EntityStatus::DONE;
            $prize->save();

            $user->bonuses = $prize->bonus->count;
            $user->save();

        DB::commit();
    }
}
