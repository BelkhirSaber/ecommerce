<?php
namespace Admin;

use Domains\Dashboard;
use Controller\BaseController;

class DashboardController extends BaseController {
    
    public function index() {

        $dash = new Dashboard();

        $data = $dash->getStatistics();

        $data['pageTitle'] = "Dashboard Admin";

        $data['currency'] = "TND";


        
        $this->view('admin/dashboard', $data);
    }
}