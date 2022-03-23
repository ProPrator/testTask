<?php

namespace App\Services;

use App\Models\Bonus;
use App\Models\BonusInterval;
use App\Models\EntityStatus;
use App\Models\EntityType;
use App\Models\Item;
use App\Models\ItemList;
use App\Models\Money;
use App\Models\MoneyInterval;
use App\Models\Prize;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RaffleService implements RaffleServiceInterface
{

    public function createPrize(): Prize
    {
        $userId = Auth::id();
        $userId = 1;

        DB::beginTransaction();

            $prize = new Prize();
            $prize->status = EntityStatus::NEW;
            $prize->type = $this->getTypeOfNewPrize();
            $prize->user_id = $userId;

            switch ($prize->type) {
                case EntityType::BONUS:
                    $bonus = new Bonus();
                    $bonus->count = $this->getRandNumberInInterval(BonusInterval::MIN, BonusInterval::MAX);
                    $bonus->save();

                    $prize->bonus_id = $bonus->id;
                    $prize->type = EntityType::BONUS;
                    break;
                case EntityType::MONEY:
                    $money = new Money();
                    $money->cents = $this->getRandNumberInInterval(MoneyInterval::MIN, MoneyInterval::MAX);
                    $money->save();

                    $prize->money_id = $money->id;
                    $prize->type = EntityType::MONEY;
                    break;
                case EntityType::ITEM:
                    $item = new Item();
                    $item->name = $this->getItemTypeOfNewPrize();
                    $item->save();

                    $prize->item_id = $item->id;
                    $prize->type = EntityType::ITEM;
                    break;
            }

            $prize->save();
        DB::commit();

        return $prize;
    }

    /**
     * @return string
     */
    private function getItemTypeOfNewPrize(): string
    {
        return ItemList::VALUE[array_rand(ItemList::VALUE)];
    }

    private function getRandNumberInInterval(int $min, int $max): int
    {
        return rand($min, $max);
    }

    /**
     * @return string
     */
    private function getTypeOfNewPrize(): string
    {
        $typeList = [
            EntityType::ITEM,
            EntityType::MONEY,
            EntityType::BONUS
        ];
        return $typeList[array_rand($typeList)];
    }
}
