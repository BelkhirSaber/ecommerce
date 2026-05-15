<?php

namespace Domains;

use Database\DatabaseConnection;
use Domains\Order;
use Domains\Client;

class Dashboard extends Base {

    private Order $order ;
    private Client $client;

    public function __construct() {
        parent::__construct();

        $this->order = new Order();
        $this->client = new Client();
    }

    // -- Dashboard Statistics

    public function getStatistics() {
        $stats = [];

        // Total Orders today
        $stats['orders_today'] = $this->order->getNbOrderToday();

        // Total Orders last 30 days
        $stats['orders_month'] = $this->order->getNbOrder();

        // Total Customers
        $stats['total_client'] = $this->client->getTotalClients();

        // Total Revenue
        $stmt = $this->pdo->query("SELECT SUM(total_amount) AS revenue FROM orders WHERE status = 'completed'");
        $stats['total_revenue'] = $stmt->fetch()['revenue'];

        return $stats;
    }




    
}