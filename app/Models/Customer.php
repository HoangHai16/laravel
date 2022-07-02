<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $table = 'tbl_customer';
    protected $primaryKey = 'customer_id';

    protected $filable = [
        'customer_name',
        'customer_email',
        'customer_password',
        'customer_phone',
        'customer_address',
        'created_at',
        'updated_at',
    ];
}
