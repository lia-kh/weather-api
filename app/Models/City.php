<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class City extends Model
{
    use HasFactory;

    /**
     *  The attributes that are mass assignable.
     * @var string[]
     */
    protected $fillable = [
        'name',
        'lat',
        'lon',
    ];
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Get the informations for the city.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function informations():HasMany
    {
        return $this->hasMany(Information::class);
    }

    /**
     * Get the users of a city
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users():BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }


}
