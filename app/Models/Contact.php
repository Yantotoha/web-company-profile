<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "contact";
    protected $guarded = ['id'];

    // hash atau encripted isi data base
    protected $casts = [
        'name' => 'encrypted',
        'email' => 'encrypted',
        'phone' => 'encrypted',
    ];
    
}
