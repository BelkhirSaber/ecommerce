<?php

namespace Domains;

class Order extends Base {


    // -- Get number of orders today

    public function getNbOrderToday() {
        
        return $this->getNbOrder(1);
    }

    // -- Get number of orders in the last 30 days

    public function getNbOrderLast30Days() {

        return $this->getNbOrder(30);
    }

    // -- Get number of orders

    public function getNbOrder($days = null) {

        $sql = "SELECT COUNT(*) AS total FROM orders";

        if ($days) 
            $sql .= " WHERE created_at >= DATE_SUB(CURDATE(), INTERVAL :days DAY)";

        $stmt = $this->pdo->prepare($sql);

        if ($days)
            $stmt->bindValue(':days', $days, \PDO::PARAM_INT);

        $stmt->execute();
        return $stmt->fetch()['total'];
    }

    // -- Get total revenue in the last 30 days

    public function getRevenueLast30Days() {
        $stmt = $this->pdo->prepare("SELECT SUM(total_amount) AS revenue FROM orders WHERE status = 'completed' AND created_at >= DATE_SUB(CURDATE(), INTERVAL :days DAY)");
        $stmt->bindValue(':days', 30, \PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch()['revenue'];
    }

}