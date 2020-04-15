<?php


class Session{

  public static function set($nama, $isi){
    return $_SESSION[$nama] = $isi;
  }

  public static function get($nama){
    return $_SESSION[$nama];
  }

  public static function exists($nama){
    return (isset($_SESSION[$nama])) ? true : false;
  }
}
