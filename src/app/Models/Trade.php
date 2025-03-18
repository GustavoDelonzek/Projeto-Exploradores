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
        'user_to_id',
        'user_for_id',
        'status'
    ];

    public function user_to():BelongsTo
    {
        return $this->belongsTo(User::class, 'user_to_id');
    }

    public function user_for():BelongsTo
    {
        return $this->belongsTo(User::class, 'user_for_id');
    }

    public function tradeItem(): HasMany
    {
        return $this->HasMany(TradeItem::class);
    }

}
