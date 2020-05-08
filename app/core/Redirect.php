<?php

/**
* @author Yusuf Al Majid <ajidalmajid6@gmail.com>
* @license MIT
* @version 0.0.1
*/

class Redirect{
  public static function to($location = null){
    if($location){
      header('Location:' . $location);
      exit();
    }
  }
}
