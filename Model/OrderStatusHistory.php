<?php

namespace Model;

use Illuminate\Database\Eloquent\Model;

class OrderStatusHistory extends Model {

  protected $table = "t_b3s_order_status_history";

  protected $primaryKey = "PK_ORDER_STATUS_HISTORY";

  1	PK_STATUS_HISTORY Primary	int(10)		UNSIGNED	No	None		AUTO_INCREMENT	Change Change	Drop Drop	
	2	FK_ORDER Index	int(10)		UNSIGNED	No	None			Change Change	Drop Drop	
	3	E_OLD_STATUS	enum('pending', 'processing', 'paid', 'shipped', '...	utf8mb4_unicode_ci		Yes	NULL			Change Change	Drop Drop	
	4	E_NEW_STATUS	enum('pending', 'processing', 'paid', 'shipped', '...	utf8mb4_unicode_ci		No	None			Change Change	Drop Drop	
	5	T_COMMENT	text	utf8mb4_unicode_ci		Yes	NULL			Change Change	Drop Drop	
	6	FK_UPDATED_BY Index	int(10)		UNSIGNED	Yes	NULL			Change Change	Drop Drop	
	7	CREATED_AT

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