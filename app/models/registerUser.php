<?php

class registerUser{

  private $db;

  public function __construct(){
    return $this->db = Database::getDB();
  }

  public function register($data = array()){
    if($data){
      $query = "INSERT INTO user(username,email,pass,sudah) VALUES(:username, :email, :pass, 0)";
      $this->db->query($query);
      $this->db->bind('username', $data['user']);
      $this->db->bind('email', $data['email']);
      $this->db->bind('pass', $data['pass']);
      $this->db->execute();

      return ($this->db->rowCount() > 0) ? true : false;
    }else{
      return null;
    }
  }

  public function cekRegister($data = array()){
    if($data){
      $query = "SELECT * FROM user WHERE username=:username OR email=:email";
      $this->db->query($query);
      $this->db->bind('username', $data['user']);
      $this->db->bind('email', $data['email']);
      $this->db->execute();

      return ($this->db->rowCount() > 0) ? false : true;
    }else{
      return null;
    }
  }
}
