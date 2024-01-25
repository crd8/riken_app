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
        'price',
        'purchase_date',
        'status',
        'owner',
        'information',
        'assetcategorie_id',
        'spot_id',
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

    /**
     * relasi belongsTo ke model spot
     * 1 asset hanya bisa mempunyai 1 spot
    */
    public function spot()
    {
        return $this->belongsTo(Spot::class);
    }
}
