<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    // use HasFactory;
    protected $fillable = [
        'code',
        'name',
        'description'
    ];

    /**
     * define relasi hasMany ke model User
    */
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
