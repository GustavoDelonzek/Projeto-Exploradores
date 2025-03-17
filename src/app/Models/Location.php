<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Location extends Model
{
    use HasFactory;

    protected $fillable = [
        'explorer_id',
        'latitude',
        'longitude'
    ];

    public function user(): BelongsTo{
        return $this->BelongsTo(Explorer::class);
    }


}
