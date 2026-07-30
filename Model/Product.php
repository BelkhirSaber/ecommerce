<?php

namespace Model;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 't_b3s_product';
    protected $primaryKey = 'PK_PRODUCT';
    
    const CREATED_AT = 'CREATED_AT';
    const UPDATED_AT = 'UPDATED_AT';

    protected $fillable = [
        'FK_CATEGORY', 'SLUG', 'TITLE', 'SHORT_DESCRIPTION', 'IN_STOCK', 'SHOW_IN_STORE'
    ];

    protected $casts = [
        'IN_STOCK' => 'boolean',
        'SHOW_IN_STORE' => 'boolean'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'FK_CATEGORY', 'PK_CATEGORY');
    }

    public function productImages()
    {
        return $this->hasMany(ProductImage::class, 'FK_PRODUCT', 'PK_PRODUCT');
    }

    public function variants()
    {
        return $this->hasMany(ProductVariant::class, 'FK_PRODUCT', 'PK_PRODUCT');
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class, 'FK_PRODUCT', 'PK_PRODUCT');
    }

    public function reviews()
    {
        return $this->hasMany(ProductReview::class, 'FK_PRODUCT', 'PK_PRODUCT');
    }

    public function wishlists()
    {
        return $this->hasMany(Wishlist::class, 'FK_PRODUCT', 'PK_PRODUCT');
    }

    public function scopeInStock($query)
    {
        return $query->where('IN_STOCK', 1);
    }

    public function scopeActive($query)
    {
        return $query->where('SHOW_IN_STORE', 1);
    }
}
