<?php

namespace Model;

use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model {

  protected $table = "t_b3s_wishlist";

  protected $primaryKey = "PK_WISHLIST";

  protected $fillable = [
      'FK_USER',
      'FK_PRODUCT'
  ];

  const CREATED_AT = 'CREATED_AT';

  const UPDATED_AT = null;

  public function user()
  {
      return $this->belongsTo(User::class, 'FK_USER', 'PK_USER');
  }

  public function product()
  {
      return $this->belongsTo(Product::class, 'FK_PRODUCT', 'PK_PRODUCT');
  }

}