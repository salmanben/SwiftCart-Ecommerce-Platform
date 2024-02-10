<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'invoice_id',
        'user_id',
        'amount',
        'sub_total',
        'count_products',
        'currency_icon',
        'order_address',
        'shipping_method',
        'payment_method',
        'coupon',
        'order_status'
    ];
    function user()
    {
        return $this->belongsTo(User::class);
    }
    function transaction()
    {
        return $this->hasOne(Transaction::class);
    }
    function order_products()
    {
        return $this->hasMany(OrderProduct::class);
    }

}
