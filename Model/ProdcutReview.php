<?php

namespace Model;

use Illuminate\Database\Eloquent\Model;

class ProductReview extends Model {

  protected $table = "t_b3s_product_review";

  protected $primaryKey = "PK_PRODUCT_REVIEW";

  protected $fillable = [
      'FK_PRODUCT',
      'FK_CUSTOMER',
      'RATING',
      'TITLE',
      'COMMENT'
  ];

  const CREATED_AT = 'CREATED_AT';

  const UPDATED_AT = null;

  public function product()
  {
      return $this->belongsTo(Product::class, 'FK_PRODUCT', 'PK_PRODUCT');
  }

  public function customer()
  {
      return $this->belongsTo(User::class, 'FK_CUSTOMER', 'PK_USER');
  }

}