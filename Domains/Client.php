<?php

namespace Domains;

class Client extends Base {

    // -- Get total number of clients in last 30 days

    public function getTotalClients() {
        $stmt = $this->pdo->prepare("SELECT COUNT(*) AS total FROM t_b3s_clients WHERE created_at >= DATE_SUB(CURDATE(), INTERVAL :days DAY");
        $stmt->bindValue(':days', 30, \PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch()['total'];
    }

}