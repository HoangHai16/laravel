<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    // a relation b => a_b
    use HasFactory;

    protected $table = 'tbl_order';
    protected $primaryKey = 'order_id';

    protected $filable = [
        'customer_id',
        'shipping_id',
        'payment_id',
        'order_total',
        'order_status',
        'created_at',
        'updated_at',
    ];

    const ORDER_STATUS_DANG_CHO_XU_LY = 2;
    const ORDER_STATUS_DA_XU_LY = 1;
}
