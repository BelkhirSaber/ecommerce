<?php

namespace Model;

use Illuminate\Database\Eloquent\Model;

class OrderStatusHistory extends Model {

  protected $table = "t_b3s_order_status_history";

  protected $primaryKey = "PK_ORDER_STATUS_HISTORY";

  protected $fillable = [
      'FK_ORDER',
      'E_OLD_STATUS',
      'E_NEW_STATUS',
      'T_COMMENT',
      'FK_UPDATED_BY'
  ];

  const CREATED_AT = 'created_at';

  const UPDATED_AT = null;

  public function order()
  {
      return $this->belongsTo(Order::class, 'FK_ORDER', 'PK_ORDER');
  }

}