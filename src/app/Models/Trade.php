<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Trade extends Model
{
    use HasFactory;

    public function explorer():HasMany
    {
        return $this->hasMany(Explorer::class);
    }

    public function tradeItem(): HasMany
    {
        return $this->HasMany(TradeItem::class);
    }

}
