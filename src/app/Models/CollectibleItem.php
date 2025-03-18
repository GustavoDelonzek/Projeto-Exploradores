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
        'user_id'
    ];

    public function user(): BelongsTo
    {
        return $this->BelongsTo(User::class);
    }
}
