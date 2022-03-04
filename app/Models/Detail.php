<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'country',
        'city',
        'postcode',
        'street_number',
        'street_name',
        'coord_lat',
        'coord_lon',
        'timezone',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'country' => 'string',
        'city' => 'string',
        'postcode'=> 'integer',
        'street_number' => 'integer',
        'street_name' => 'string',
        'coord_lat' => 'string',
        'coord_lon' => 'string',
        'timezone' => 'string',
        'user_id' => 'integer'
    ];
}
