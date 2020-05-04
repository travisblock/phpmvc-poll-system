<?php

class UserModel{

  private $db;

  public function __construct(){
    $this->db = Database::getDB();
  }

  public function cekUser($user){
    if(!empty($user)){
      $query = "SELECT * FROM user where username=:usr";
      $this->db->query($query);
      $this->db->bind('usr', $user);
      $this->db->execute();
      return ($this->db->rowCount() > 0) ? $this->db->result() : false;
    }
    return false;
  }

  public function login($user=null, $pass=null){
    if(!is_null($user) && !is_null($pass)){
      $data = $this->cekUser($user);
      if(!empty($data)){
        if(password_verify($pass, $data['pass'])){

          return ($data['sudah'] < 1) ? $data : false;

        }else{
          return false;
        }
      }
    }
  }



}
