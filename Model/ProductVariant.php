<?php

namespace Model;

use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model {

  protected $table = "t_b3s_product_variant";

  protected $primaryKey = "PK_PRODUCT_VARIANT";

  protected $fillable = [
      'FK_PRODUCT',
      'SKU',
      'PRICE',
      'DISCOUNT',
      'STOCK',
      'IMAGE',
      'ACTIVE'
  ];

  const CREATED_AT = 'CREATED_AT';

  const UPDATED_AT = null;

  public function product()
  {
      return $this->belongsTo(Product::class, 'FK_PRODUCT', 'PK_PRODUCT');
  }

  public function attributeValues()
  {
      return $this->belongsToMany(
        AttributeValue::class, 
        't_b3s_product_variant_attribute', 
        'FK_PRODUCT_VARIANT', 
        'FK_ATTRIBUTE_VALUE'
        );
  }

}