<?php

namespace Model;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $table = 't_b3s_order_item';
    protected $primaryKey = 'PK_ORDER_ITEM';
    
    const CREATED_AT = 'CREATED_AT';
    const UPDATED_AT = null;

    protected $fillable = [
        'FK_ORDER',
        'FK_PRODUCT',
        'FK_PRODUCT_VARIANT',
        'PRODUCT_TITLE',
        'PRODUCT_SKU',
        'UNIT_PRICE',
        'LINE_TOTAL',
        'QUANTITY'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'FK_ORDER', 'PK_ORDER');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'FK_PRODUCT', 'PK_PRODUCT');
    }

    public function productVariant()
    {
        return $this->belongsTo(ProductVariant::class, 'FK_PRODUCT_VARIANT', 'PK_PRODUCT_VARIANT');
    }
}