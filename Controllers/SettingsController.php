<?php

namespace Controller;

/**
 * Author: Saber blekhir
 */

use Controller\Controller;
use Model\Product;

class SettingsController extends Controller {

  // -- 

  public function index(): void
  {

    $this->view('admin.settings.index', [], 'admin');

  }

}