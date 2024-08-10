<?php

namespace Admin;
use Model\Options;

class OptionsController {

  public function sidebar_expand(string $status) {
    $options = new Options();
    $result = $options->sql_query("UPDATE t_b3s_options SET `S_VALUE_OPTION` = '".$status."' WHERE S_NAME_OPTION = 'sidebar_expand'", array());
    return $result;
  }

}