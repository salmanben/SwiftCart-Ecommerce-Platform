<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;
    public $fillable = [
        'type',
        'title',
        'btn_url',
        'starting_price',
        'status',
        'order',
        'banner',
    ];
}
