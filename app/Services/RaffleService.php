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
use App\Models\Reserve;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class RaffleService implements RaffleServiceInterface
{
    /**
     * @param int $userId
     * @return Prize
     */
    public function createPrize(int $userId): Prize
    {
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

                    $this->updateItemQuantity(-1);

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

    /**
     * @param int $count
     * @return void
     */
    private function updateItemQuantity(int $count): void
    {
        $itemReserve = Reserve::where('name', EntityType::ITEM)->first();
        $itemReserve->count += $count;
        $itemReserve->save();
    }

    /**
     * @param int $min
     * @param int $max
     * @return int
     */
    private function getRandNumberInInterval(int $min, int $max): int
    {
        $moneyReserve = Reserve::where('name', EntityType::MONEY)->first();
        $moneyCount = $moneyReserve->count;
        if ($max < $moneyCount) {
            $max = $moneyCount;
        }
        $rand = rand($min, $max);
        $moneyReserve->count -= $rand;
        $moneyReserve->save();

        return $rand;
    }

    /**
     * @return string
     */
    private function getTypeOfNewPrize(): string
    {

        $typeList = [
            EntityType::MONEY,
            EntityType::BONUS
        ];
        if (Reserve::isExistsItem()) {
            $typeList[] = EntityType::ITEM;
        }
        if (Reserve::isExistsMoney()) {
            $typeList[] = EntityType::MONEY;
        }


        return $typeList[array_rand($typeList)];
    }

    /**
     * @param int $prizeId
     * @param int $userId
     * @return void
     */
    public function convertPrize(int $prizeId, int $userId): void
    {
        DB::beginTransaction();

            $prize = Prize::where('id', $prizeId)->first();
            $prize->status = EntityStatus::DISABLE;
            $prize->save();

            $user = User::where('id', $userId)->first();
            $user->bonuses = $prize->monye->cents;
            $user->save();

        DB::commit();
    }

    /**
     * @param int $prizeId
     * @return void
     */
    public function refusePrize(int $prizeId): void
    {
        $prize = Prize::where('id', $prizeId)->first();
        $prize->status = EntityStatus::DISABLE;
        $prize->save();

        $this->backToReserve($prize);
    }

    /**
     * @param Prize $prize
     * @return void
     */
    private function backToReserve(Prize $prize): void
    {
        $detail = $prize->getPrizeDetails();

        if($detail instanceof Item) {
            $this->updateItemQuantity(1);
        }
        if ($detail instanceof Money) {
            $this->updateMoneyQuantity($detail->cents);
        }
    }

    /**
     * @param int $count
     * @return void
     */
    private function updateMoneyQuantity(int $count): void
    {
        $itemReserve = Reserve::where('name', EntityType::MONEY)->first();
        $itemReserve->count += $count;
        $itemReserve->save();
    }
}
