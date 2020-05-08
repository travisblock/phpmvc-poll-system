<?php

/**
* @author Yusuf Al Majid <ajidalmajid6@gmail.com>
* @license MIT
* @version 0.0.1
*/

class Controller{

  public function view($view, $data = []){
    require_once 'app/views/'. $view .'.php';
  }

  public function model($model){
    require_once 'app/models/'. $model .'.php';
    return new $model;
  }
}
