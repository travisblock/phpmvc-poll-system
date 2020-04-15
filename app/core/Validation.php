<?php

class Validation{

  private static $instance = null;
  private $passed = false,
          $errors = array();

  public static function get(){
    if(!isset(self::$instance)){
      return self::$instance = new Validation;
    }
    return self::$instance;
  }

  public function cek($items = array()){
    foreach ($items as $item => $rules) {
      foreach ($rules as $rule => $rule_value) {
        switch ($rule) {
          case 'required':
            if(empty(Input::get($item)) && $rule_value == true){
              $this->addError("$item wajib diisi");
            }
            break;
          case 'min':
            if(strlen(Input::get($item)) < 3 ){
              $this->addError($item . ' minimal '. $rule_value . ' karakter');
            }
            break;
          case 'max':
            if(strlen(Input::get($item)) > 50 ){
              $this->addError($item . ' max '. $rule_value . ' karakter');
            }
            break;
          default:
            break;
        }
      }
    }

    if(empty($this->errors)){
      $this->passed = true;
    }
    return $this;
  }

  private function addError($error){
    return $this->errors[] = $error;
  }

  public function errors(){
    return $this->errors;
  }

  public function passed(){
    return $this->passed;
  }


}
