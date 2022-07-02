<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    const METHOD_ATM = 1;
    const METHOD_COD = 2;
    const STATUS_ACTIVE = 1;
}
