<?php

trait ArrayTrait {

  // -- Check is associative array                                    
  public function isAssociativeArray(array $array): bool
    {
      $keys = array_keys($array);
      return array_keys($keys) !== $keys;
    }
}