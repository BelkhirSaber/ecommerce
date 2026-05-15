<?php
namespace Admin;

class DashboardController extends AdminBaseController {
    
    public function index() {
        // Statistiques pour le dashboard
        $data = [
            'pageTitle' => 'Dashboard Admin',
            'totalOrders' => 150,
            'totalRevenue' => 45000,
            'totalCustomers' => 320,
            'totalProducts' => 85
        ];
        
        $this->view('dashboard', $data);
    }
}