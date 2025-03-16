<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Trade extends Model
{
    use HasFactory;

    protected $fillable = [
        'explorer_to_id',
        'explorer_for_id',
        'status'
    ];

    public function explorer_to():BelongsTo
    {
        return $this->belongsTo(Explorer::class, 'explorer_to_id');
    }

    public function explorer_for():BelongsTo
    {
        return $this->belongsTo(Explorer::class, 'explorer_for_id');
    }

    public function tradeItem(): HasMany
    {
        return $this->HasMany(TradeItem::class);
    }

}
