<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table = 'tbl_category_product';
    protected $primaryKey = 'Category_id';
    protected $filable = [
        'Category_name',
        'Category_desc',
        'Category_status',
        'created_at',
        'updated_at',
    ];
}
