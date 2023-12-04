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
    */
    public function locations()
    {
        return $this->hasMany(Location::class);
    }
}