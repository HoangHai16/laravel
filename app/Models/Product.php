<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'tbl_product';
    protected $primaryKey = 'product_id';


    protected $fillable = [
        'brand_id',
        'category_id',
        'created_at',
        'product_content',
        'product_desc',
        'product_image',
        'product_name',
        'product_price',
        'product_status',
        'quantity',
    ];
}
