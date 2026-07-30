<?php

namespace Domains;

use Model\Order as OrderModel;
use Carbon\Carbon;

class Order {

    public function getNbOrderToday()
    {
        return OrderModel::whereDate('CREATED_AT', Carbon::today())->count();
    }

    public function getNbOrder($days = 30)
    {
        if ($days) {
            return OrderModel::where('CREATED_AT', '>=', Carbon::now()->subDays($days))->count();
        }
        return OrderModel::count();
    }

    public function getRevenueLast30Days()
    {
        return OrderModel::last30Days()
            ->where('STATUS', 'delivered')
            ->sum('TOTAL_AMOUNT');
    }
}