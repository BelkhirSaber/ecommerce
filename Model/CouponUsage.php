<?php

namespace Model;

use Illuminate\Database\Eloquent\Model;

class CouponUsage extends Model {

  protected $table = "t_b3s_coupon_usage";

  protected $primaryKey = "PK_COUPON_USAGE";

  protected $fillable = [
      'FK_COUPON',
      'FK_USER',
      'FK_ORDER'
  ];

  const CREATED_AT = 'CREATED_AT';

  const UPDATED_AT = null;

  public function coupon()
  {
      return $this->belongsTo(Coupon::class, 'FK_COUPON', 'PK_COUPON');
  }

  public function user()
  {
      return $this->belongsTo(User::class, 'FK_USER', 'PK_USER');
  }

  public function usage()
  {
      return $this->belongsTo(Order::class, 'FK_ORDER', 'PK_ORDER');
  }

}