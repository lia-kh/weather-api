<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Temperature extends Model
{
    use HasFactory;

    /**
     *  The attributes that are mass assignable.
     * @var string[]
     */
    protected $fillable = [
        'date',
        'temperature',
        'city_id'
    ];

    /**
     * Get the city
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }
}
