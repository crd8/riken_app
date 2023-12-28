<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Department extends Model
{
    // use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'code',
        'name',
        'description'
    ];

    protected $dates = ['deleted_at'];

    /**
     * define relasi hasMany ke model User
    */
    public function user()
    {
        return $this->hasMany(User::class);
    }
}
