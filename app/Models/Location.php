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
    */
    public function area()
    {
        return $this->belongsTo(Area::class);
    }
}
