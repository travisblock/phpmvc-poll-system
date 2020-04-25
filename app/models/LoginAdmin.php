<?php

class LoginAdmin{

  private $db;

  public function __construct(){
    return $this->db  = Database::getDB();
  }

  public function login($username = null, $password = null){
    if(!is_null($username) && !is_null($password)){
      $query = "SELECT * FROM login WHERE user=:user";
      $this->db->query($query);
      $this->db->bind('user', $username);
      $data = $this->db->result();
      if($this->db->rowCount() > 0){
        return ($this->cekPassword($password, $data['pass'])) ? $data : false;
      }else{
        return false;
      }
    }
  }

  public function cekPassword($input = null, $password = null){
    if(!is_null($input) && !is_null($password)){
      return (password_verify($input, $password)) ? true : false;
    }
  }
}
