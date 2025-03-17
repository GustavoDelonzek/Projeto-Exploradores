<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Explorer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'age',
        'latitude',
        'longitude'
    ];

    public function collectible_item(): HasMany
    {
        return $this->hasMany(CollectibleItem::class);
    }

    public function location():HasMany
    {
        return $this->hasMany(Location::class);
    }


}
