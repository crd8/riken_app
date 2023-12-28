<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Location extends Model
{
    // use HasFactory;
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'code',
        'name',
        'description',
        'area_id'
    ];

    /**
     * relasi belongsTo ke model area
     * 1 location hanya bisa mempunyai 1 area
    */
    public function area()
    {
        return $this->belongsTo(Area::class);
    }

    /**
     * relasi hasMany ke model spot
     * 1 location bisa mempunyai banyak spot
    */
    public function spot()
    {
        return $this->hasMany(Spot::class);
    }
}
