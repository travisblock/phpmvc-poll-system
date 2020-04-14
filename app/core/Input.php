<?php

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

}
