<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WithdrawRequest extends Model
{
    use HasFactory;
    protected $fillable = [
        'method',
        'amount',
        'charge',
        'account_informations',
        'vendor_id',
        'status',
    ];

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

}
