<?php


namespace Utilities;

class Utilities {

  const IMAGES_EXTENSION = array('png', 'jpeg', 'jpg', 'webp');

  /**
   * Function return the path of the assets file
   * @param string $file_name
   * 
   * @return string
   */
  public static function assets(string $file_path) : string {

    if(file_exists(dirname(__DIR__) . DIRECTORY_SEPARATOR . 'Public/assets' . DIRECTORY_SEPARATOR . $file_path)){
      return 'assets' . DIRECTORY_SEPARATOR . $file_path;
    }
    throw new \Exception('Assets File Not Found');
  }
}