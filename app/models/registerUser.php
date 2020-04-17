<?php

class registerUser{

  public function register($data = array()){
    if($data){
      return $data;
    }else{
      return null;
    }
  }
}
