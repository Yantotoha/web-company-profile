<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{

    use HasFactory;
    
    protected $table = "categories";
    protected $guarded = ['id'];
    protected $fillable = ['name', 'image'];

    public function portfolios()
        {
            return $this->hasMany(Portfolio::class, 'category_id');
        }
}
