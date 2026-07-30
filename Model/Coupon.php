<?php

namespace Model;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model {

  protected $table = "t_b3s_coupon";

  protected $primaryKey = "PK_COUPON";

  protected $fillable = [
      'S_CODE',
      'S_DESCRIPTION',
      'E_TYPE',
      'D_VALUE',
      'D_MIN_ORDER_AMOUNT',
      'I_MAX_USES',
      'I_CURRENT_USES',
      'I_MAX_USES_PER_USER',
      'DT_START_DATE',
      'DT_END_DATE',
      'B_ACTIVE'
  ];

  const CREATED_AT = 'CREATED_AT';

  const UPDATED_AT = 'UPDATED_AT';


  public function coupons() {
      return $this->hasMany(CouponUsage::class, 'FK_COUPON', 'PK_COUPON');
  }

}