<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Asset extends Model
{
    // use HasFactory;
    use HasUuids, SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'number',
        'name',
        'location',
        'price',
        'purchase_date',
        'status',
        'owner',
        'information',
        'photo'
    ];

    /**
     * relasi belongsTo ke model asset categorie
     * 1 asset hanya bisa mempunyai 1 asset categorie
    */
    public function assetcategorie()
    {
        return $this->belongsTo(AssetCategorie::class);
    }
}
