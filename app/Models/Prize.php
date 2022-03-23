<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;


class Prize extends Base
{
    use HasFactory;

    public function getPrizeDetails(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        $model = match ($this->type) {
            EntityType::BONUS => $this->bonus(),
            EntityType::MONEY => $this->money(),
            EntityType::ITEM => $this->item(),
            default => null,
        };
        return $model;
    }

    public function getPrizeDetailsDescription(): int|string|null
    {
        $details = $this->getPrizeDetails;
        if (!$details) {
            return null;
        }

        if ($details instanceof Money) {
            return $details->cents;
        }
        if ($details instanceof Bonus) {
            return $details->count;
        }
        if ($details instanceof Item) {
            return $details->name;
        }
    }

    public function money(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Money::class);
    }

    public function bonus(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Bonus::class);
    }

    public function item(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Item::class);
    }
}
