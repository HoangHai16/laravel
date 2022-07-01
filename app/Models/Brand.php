<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    protected $table = 'tbl_brand_product';
    protected $primaryKey = 'brand_id';
    protected $filable = [
        'brand_name',
        'brand_desc',
        'brand_status',
        'created_at',
        'updated_at',
    ];
}
