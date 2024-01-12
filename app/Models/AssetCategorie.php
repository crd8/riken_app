<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class AssetCategorie extends Model
{
    // use HasFactory;
    use HasUuids;
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'name',
        'description'
    ];

    /**
     * relasi hasMany ke model assets
     * 1 categorie asset mempunyai banyak asset
    */
    public function asset()
    {
        return $this->hasMany(Asset::class);
    }
}
