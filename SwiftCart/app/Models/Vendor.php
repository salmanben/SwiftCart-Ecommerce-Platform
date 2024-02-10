<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    use HasFactory;
    public $fillable = [
      'banner',
      'phone',
      'email',
      'status',
      'address',
      'description',
      'shop_name',
      'user_id',
      'fb_link',
      'insta_link',
      'tw_link',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
