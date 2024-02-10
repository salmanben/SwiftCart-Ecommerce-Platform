<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'quantity',
        'total_use',
        'max_use',
        'discount_type',
        'discount',
        'start_date',
        'end_date',
        'status',
    ];
}
