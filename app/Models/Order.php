<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

use function GuzzleHttp\Promise\each;

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

    public function orderDetails(): HasMany
    {
        return $this->hasMany(OrderDetail::class, 'order_details_id', 'order_id');
    }

    public static function boot()
    {
        parent::boot();

        static::deleting(function ($order) {
            if ($order->orderDetails()->each(function ($orderDetail) {
                Product::findOrFail($orderDetail->product_id)
                    ->increment('quantity', $orderDetail->product_sales_quantity);
            })) {
                $order->orderDetails()->delete();
            }
        });
    }
}
