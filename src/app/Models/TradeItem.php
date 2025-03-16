<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class TradeItem extends Model
{
    use HasFactory;

    public function trade(): BelongsTo
    {
        return $this->belongsTo(Trade::class);
    }

    public function collectibleItem():HasOne
    {
        return $this->hasOne(CollectibleItem::class);
    }

}
