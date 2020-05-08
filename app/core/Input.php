<?php

/**
* @author Yusuf Al Majid <ajidalmajid6@gmail.com>
* @license MIT
* @version 0.0.1
*/

class Input{

  public static function get($input=null){

    if(is_null($input)){

      if(isset($_GET)){
        return $_GET;
      }elseif(isset($POST)){
        return $POST;
      }

    }elseif(!empty($input)){

      if(isset($_POST[$input])){
        return $_POST[$input];
      }elseif(isset($_GET[$input])){
        return $_GET[$input];
      }

    }

    return false;

  }

  public static function exists($type, $name = null){
    switch ($type) {
      case 'POST':
        if(!is_null($name)){
          return (!empty($_POST[$name])) ? true : false;
        }else{
          return (!empty($_POST)) ? true : false;
        }
        break;
      case 'GET':
        if(!is_null($name)){
          return (!empty($_GET[$name])) ? true : false;
        }else{
          return (!empty($_GET)) ? true : false;
        }
        break;
      case 'FILES':
        if(!is_null($name)){
          return (!empty($_FILES[$name]['name'])) ? true : false;
        }else{
          return (!empty($_FILES)) ? true : false;
        }
        break;

      default:
        break;
    }
  }

  // public static function exists($type, $name=null){
  //   if($type)
  // }

}
