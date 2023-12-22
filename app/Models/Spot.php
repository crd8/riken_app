<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Spot extends Model
{
    // use HasFactory;
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
    public function areas()
    {
        return $this->belongsTo(Area::class);
    }

    /**
     * relasi belongsTo ke model location
     * 1 spot hanya bisa mempunya 1 location
    */
    public function locations()
    {
        return $this->belongsTo(Location::class);
    }
}
