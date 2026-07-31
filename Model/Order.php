<?php

namespace Model;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Order extends Model {

  protected $table = "t_b3s_order";

  protected $primaryKey = "PK_ORDER";

  protected $fillable = [
      'FK_USER',
      'ORDER_NUMBER',
      'STATUS',
      'SUBTOTAL',
      'DISCOUNT_AMOUNT',
      'SHIPPING_AMOUNT',
      'TOTAL_AMOUNT',
      'USER_NAME',
      'USER_EMAIL',
      'SHIPPING_ADDRESS'
  ];

  const CREATED_AT = 'CREATED_AT';

  const UPDATED_AT = 'UPDATED_AT';

  public function user()
  {
      return $this->belongsTo(User::class, 'FK_USER', 'PK_USER');
  }

  public function orderItems() 
  {
      return $this->hasMany(OrderItem::class, 'FK_ORDER', 'PK_ORDER');
  }

  public function scopeLast30Days($query)
  {
      return $query->where('CREATED_AT', '>=', Carbon::now()->subDays(30));
  }

}