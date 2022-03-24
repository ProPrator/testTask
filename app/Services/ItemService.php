<?php

namespace App\Services;

use App\Models\EntityStatus;
use App\Models\EntityType;
use App\Models\Prize;

class ItemService implements ItemServiceInterface
{

    public function send(int $id): void
    {
        $prize = Prize::where(['id' => $id, 'type' => EntityType::ITEM])->first();

        $prize->status = EntityStatus::DONE;
        $prize->save();
    }
}
