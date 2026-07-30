<?php

namespace Model;

use Illuminate\Database\Eloquent\Model;


class CartItem extends Model
{
    protected $table = 't_b3s_cart_item';
    protected $primaryKey = 'PK_CART_ITEM';
    
    const CREATED_AT = 'CREATED_AT';
    const UPDATED_AT = 'UPDATED_AT';

    protected $fillable = [
        'FK_CART',
        'FK_PRODUCT',
        'QUANTITY'
    ];

    public function cart()
    {
        return $this->belongsTo(Cart::class, 'FK_CART', 'PK_CART');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'FK_PRODUCT', 'PK_PRODUCT');
    }
}