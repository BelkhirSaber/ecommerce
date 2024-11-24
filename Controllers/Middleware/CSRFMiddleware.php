<?php 

namespace Controllers\Middleware;

class CSRFMiddleware {


  public function verifyCSRF() {
    return true;
  }
}