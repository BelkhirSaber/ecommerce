<?php

namespace Model;

use Illuminate\Database\Eloquent\Model;

class ShippingMethod extends Model {

  protected $table = "t_b3s_shipping_method";

  protected $primaryKey = "PK_SHIPPING_METHOD";

  protected $fillable = [
      'S_NAME',
      'S_DESCRIPTION',
      'D_PRICE',
      'D_FREE_SHIPPING_THRESHOLD',
      'I_ESTIMATED_DAYS_MIN',
      'I_ESTIMATED_DAYS_MAX',
      'B_ACTIVE'
  ];

  const CREATED_AT = 'CREATED_AT';

  const UPDATED_AT = 'UPDATED_AT';



}