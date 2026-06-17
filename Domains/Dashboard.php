<?php

namespace Domains;

use Domains\Order;
use Domains\Client;

class Dashboard {

    private Order $order;
    private Client $client;

    public function __construct()
    {
        $this->order = new Order();
        $this->client = new Client();
    }

    public function getStatistics()
    {
        $stats = [];

        $stats['orders_today'] = $this->order->getNbOrderToday();
        $stats['orders_month'] = $this->order->getNbOrder(30);
        $stats['total_client'] = $this->client->getTotalClients();
        $stats['total_revenue'] = $this->order->getRevenueLast30Days();

        return $stats;
    }
}