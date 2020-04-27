<?php


class Upload{


  public static function rename($name = null){
    if(!empty($name)){
      $tmp_name         = explode(".", $name);
      $__name           = $tmp_name[0];
      $ext_name         = strtolower(end($tmp_name));
      $new_name = round(microtime(true)) . '_' . $__name . '.' . $ext_name;
      return $new_name;
    }
  }
}
