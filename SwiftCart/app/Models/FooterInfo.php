<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FooterInfo extends Model
{
    use HasFactory;
    protected $fillable = [
        'email',
        'phone',
        'address',
        'facebook',
        'copyright',
        'twitter',
        'whatsapp',
        'instagram',
    ];
}