<?php

namespace App\Models;

class Reserve extends Base
{
    protected $table = 'reserve';

    /**
     * @return bool
     */
    public static function isExistsMoney(): bool
    {
        return Reserve::where('name', EntityType::MONEY)->where('count', '>', MoneyInterval::MIN)->exists();
    }

    /**
     * @return bool
     */
    public static function isExistsItem(): bool
    {
        return Reserve::where('name', EntityType::ITEM)->where('count', '>', 0)->exists();
    }
}
