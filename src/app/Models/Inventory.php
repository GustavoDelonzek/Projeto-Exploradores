<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Inventory extends Model
{
    use HasFactory;

    protected $fillable = [
        'explorer_id',
        'collectible_item_id'
    ];

    public function explorer():BelongsTo
    {
        return $this->belongsTo(Explorer::class);
    }

    public function collectibleItem():BelongsTo
    {
        return $this->BelongsTo(CollectibleItem::class);
    }
}
