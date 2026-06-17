<?php
namespace Admin;

use Domains\Dashboard;

class DashboardController extends AdminBaseController {
    
    public function index() {

        $dash = new Dashboard();

        $data = $dash->getStatistics();

        $data['pageTitle'] = "Dashboard Admin";

        $data['currency'] = "TND";
        
        $this->view('dashboard', $data);
    }
}