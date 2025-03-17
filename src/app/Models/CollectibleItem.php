<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class CollectibleItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'latitude',
        'longitude',
        'explorer_id'
    ];

    public function explorer(): BelongsTo
    {
        return $this->BelongsTo(Explorer::class);
    }
}
