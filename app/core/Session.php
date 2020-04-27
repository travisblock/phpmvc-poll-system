<?php


class Session{

  public static function set($nama, $isi){
    return $_SESSION[$nama] = $isi;
  }

  public static function get($nama=null){
    if(!empty($_SESSION)){
      if(isset($_SESSION[$nama])){
        return $_SESSION[$nama];
      }
    }else{
      return false;
    }
  }

  public static function exists($nama){
    return (isset($_SESSION[$nama])) ? true : false;
  }
}
