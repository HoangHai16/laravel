<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    // a relation b => a_b
    use HasFactory;

    protected $table = 'tbl_shipping';

    protected $fillable = [
        'shipping_name',
        'shipping_email',
        'shipping_phone',
        'shipping_notes',
        'shipping_address',
        'customer_id',
    ];
}
