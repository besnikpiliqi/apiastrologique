<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SignAstrologique extends Model
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
        'zodiac_sign',
        'user_id',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'zodiac_sign' => 'string',
        'user_id' => 'integer'
    ];
}
