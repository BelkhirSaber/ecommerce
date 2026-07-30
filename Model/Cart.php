<?php

namespace Model;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table = 't_b3s_cart';
    protected $primaryKey = 'PK_CART';
    
    const CREATED_AT = 'CREATED_AT';
    const UPDATED_AT = 'UPDATED_AT';

    protected $fillable = [
        'FK_USER',
        'SESSION_ID',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'FK_USER', 'PK_USER');
    }

    public function cartItems()
    {
        return $this->hasMany(CartItem::class, 'FK_CART', 'PK_CART');
    }
}