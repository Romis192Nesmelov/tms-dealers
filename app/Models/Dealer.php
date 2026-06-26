<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Dealer extends Model
{
    protected $fillable = [
        'city_id',
        'address',
        'latitude',
        'longitude',
        'name',
        'contact',
        'phone',
        'mail',
        'site',
        'note',
        'active'
    ];

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }
}
