<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Spot extends Model
{
    // use HasFactory;
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'code',
        'name',
        'description',
        'area_id',
        'location_id'
    ];

    /**
     * relasi belongsTo ke model area
     * 1 spot hanya bisa mempunyai 1 area
    */
    public function area()
    {
        return $this->belongsTo(Area::class);
    }

    /**
     * relasi belongsTo ke model location
     * 1 spot hanya bisa mempunya 1 location
    */
    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    /**
     * relasi hasMany ke model asset
     * 1 spot mempunyai banyak asset
    */
    public function asset()
    {
        return $this->hasMany(Asset::class);
    }
}
