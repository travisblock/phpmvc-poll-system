<?php

/**
* @author Yusuf Al Majid <ajidalmajid6@gmail.com>
* @license MIT
* @version 0.0.1
*/

class Upload{

  private $name,
          $path,
          $tmp,
          $ext,
          $newName,
          $allowed,
          $disallow = array(' ', '(', ')', '[', ']', '/', '\'', '<', '>','^','.','{', '}', ';', ',', '@', '~', '#', '!', '$', '+', '?', '%', '&', '*', '"', '`', '=', '|', '&');

  public function __construct(array $files = [], string $path = null){
    $this->name = $files['name'];
    $this->tmp  = $files['tmp_name'];
    $this->ext  = pathinfo($this->name, PATHINFO_EXTENSION);
    $this->path = $path;
  }

  public function uploaded(string $type){
    $this->rename();
    if($this->allowed($type)){
      return (move_uploaded_file($this->tmp, $this->path . $this->newName)) ? true : false;
    }else{
      die('Error: ekstensi file salah');
    }
  }

  public function rename(){
    $this->newName = explode(".", $this->name);
    $this->ext     = strtolower(end($this->newName));
    $this->newName = $this->newName[0];
    $this->newName = str_replace($this->disallow, array(""), $this->newName);
    $this->newName = round(microtime(true)) . '_' . $this->newName . '.' . $this->ext;
    return $this->newName;
  }

  public function getTmp(){
    return $this->tmp;
  }

  public function getNewName(){
    return $this->newName;
  }

  public function getExt(){
    return $this->ext;
  }

  private function allowExt(string $type){
    switch ($type) {
      case 'images':
        $this->allowed = array('jpg', 'png', 'jpeg');
        break;
      case 'xls':
        $this->allowed = array('xls', 'xlsx');
        break;

      default:
        break;
    }
  }

  public function allowed(string $type){
    $this->allowExt($type);
    return (in_array($this->ext, $this->allowed)) ? true : false;
  }


}
