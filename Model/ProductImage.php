<?php

namespace Model;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model {

  protected $timestamp = false;

  protected $table = "t_b3s_product_image";

  protected $primaryKey = "PK_PRODUCT_IMAGE";

  protected $fillable = [
      'FK_PRODUCT',
      'IMAGE',
      'POSITION'
  ];

  public function product()
  {
      return $this->belongsTo(Product::class, 'FK_PRODUCT', 'PK_PRODUCT');
  }

}