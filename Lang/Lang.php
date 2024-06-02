<?php

namespace Lang;

class Lang {

  private string $primary_lang;
  private array $language;
  private static $instance;

  private function __construct(){
    require_once __DIR__ . DIRECTORY_SEPARATOR . 'lang.config.php';
    $this->primary_lang = $_SESSION['lang'] ?? "en";
    $this->language = $language;
  }

  public function getLang() : string { return $this->primary_lang;}

  public function setLang(string $lang) { $this->primary_lang = $lang; }

  public static function getInstance() : self
  {
    if (!isset(self::$instance)) {
      self::$instance = new static();
    }

    return self::$instance;
  }

  public function translate(string $key) : string
  {
    // var_dump($this->language);
    if(!in_array($key, array_keys($this->language[$this->primary_lang]))) {
      die('key not founded');
    }
    return $this->language[$this->primary_lang][$key];
  }


}