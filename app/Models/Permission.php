<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;

// import model permission dengan alias OriginalPermission
use Spatie\Permission\Models\Permission as OriginalPermission;

// definisikan model dengan mewarisi dari model Permission
class Permission extends OriginalPermission
{
    // use HasFactory;

    // definisikan kolom yang dapat diisi,
    // ini untuk menentukan kolom mana yang dapat diisi saat menjalankan method store atau update
    protected $fillable = [
        'name',
        'guard_name',
        'updated_at',
        'created_at'
    ];

    
}