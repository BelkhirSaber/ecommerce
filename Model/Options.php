<?php

/**
 * Author: Saber Belkhir
 * Date: 22-07-2024
 */

namespace Model;

use Foundational\Model\Model;

class Options extends Model{

  protected string $table = 't_bs3_options';
  
  public function __construct()
    {
      parent::__construct();
    }
}