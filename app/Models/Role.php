<?php

namespace App\Models;
use Spatie\Permission\Models\Role as OriginalRole;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends OriginalRole
{
    // use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'guard_name',
        'updated_at',
        'created_at'
    ];

    protected $dates = ['deleted_at'];
}
