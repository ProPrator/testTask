<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Money extends Base implements PrizeDetails
{
    use HasFactory;

    protected $table = 'moneys';

    public function prize(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Prize::class);
    }
}
