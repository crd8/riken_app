<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Area extends Model
{
    // use HasFactory;
    use SoftDeletes;
    protected $dates = ['delete_at'];

    protected $fillable = [
        'code',
        'name',
        'address'
    ];

    /**
     * relasi hasMany ke model location
     * 1 area bisa mmumpunyai banyak location
    */
    public function location()
    {
        return $this->hasMany(Location::class);
    }

    /**
     * relasi hasMany ke model spot
     * 1 area bisa mmumpunyai banyak spot
    */
    public function spot()
    {
        return $this->hasMany(Spot::class);
    }
}