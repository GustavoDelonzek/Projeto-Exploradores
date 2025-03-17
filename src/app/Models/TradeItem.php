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

    protected $fillable = [
        'trade_id',
        'collectible_item_id',
        'explorer_id'
    ];

    public function trade(): BelongsTo
    {
        return $this->belongsTo(Trade::class);
    }

    public function collectible_item():HasOne
    {
        return $this->hasOne(CollectibleItem::class);
    }

    public function explorer(): BelongsTo
    {
        return $this->belongsTo(Explorer::class);
    }

}
