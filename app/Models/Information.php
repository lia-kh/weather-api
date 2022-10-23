<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Information extends Model
{
    use HasFactory;

    /**
     *  The attributes that are mass assignable.
     * @var string[]
     */
    protected $fillable = [
        'date',
        'temp',
        'city_id',
    ];
    /**
     * @var array
     */
    protected $casts = [
        'temp'=>'json'
    ];
    protected $table = 'informations';

    /**
     * Get the city
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }
}
