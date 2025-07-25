<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Portfolio extends Model
{
     use HasFactory, SoftDeletes;

    protected $table = "portfolio";
    protected $guarded = ['id'];
    protected $fillable = ['title', 'slug', 'client', 'des', 'category_id', 'image', 'created_by'];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

}
