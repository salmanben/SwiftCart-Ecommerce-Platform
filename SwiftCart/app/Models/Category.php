<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    public $fillable = [
        'name',
        'icon',
        'status'
    ];

    public function sub_categories()
    {
        return $this->hasMany(SubCategory::class);
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
