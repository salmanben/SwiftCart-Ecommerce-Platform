<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;
    public $fillable = [
        'name',
        'category_id',
        'status'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function child_categories()
    {
        return $this->hasMany(ChildCategory::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
