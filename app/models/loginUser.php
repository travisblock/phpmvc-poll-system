<?php

class loginUser{

  private $db;

  public function __construct(){
    $this->db = Database::getDB();
  }

  public function cekUser($user){
    if(!empty($user)){
      $query = "SELECT * FROM login where user=:usr";
      $this->db->query($query);
      $this->db->bind('usr', $user);
      $this->db->execute();
      return ($this->db->rowCount() > 0) ? $this->db->result() : false;

      // if($this->db->rowCount() > 0){
      //   return $this->db->result();
      // }
      // return false;
    }
    return false;
  }

  public function login($user, $pass){
    $password = $this->cekUser($user);
    if(!empty($password)){
      if(password_verify($pass, $password['pass'])){
        return true;
      }else{
        return false;
      }
    }
    return false;
  }

}
