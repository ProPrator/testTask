<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Item extends Base implements PrizeDetails
{
    use HasFactory;

    public function prize(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Prize::class);
    }
}
