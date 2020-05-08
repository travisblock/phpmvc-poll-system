<?php

class AdminModel{

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

  public function ubahData($data){
      $query = "UPDATE login SET user=:user, pass=:pass, email=:email WHERE id=:id";
      $this->db->query($query);
      $this->db->bind('id', $data['id']);
      $this->db->bind('user', $data['user']);
      $this->db->bind('pass', $data['pass']);
      $this->db->bind('email', $data['email']);
      $this->db->execute();
      return ($this->db->rowCount() > 0) ? true : false;
  }

  public function getDataById($id){
    $query = "SELECT * FROM login WHERE id=:id";
    $this->db->query($query);
    $this->db->bind('id', $id);
    return $this->db->result();
  }

  public function validEmailUser($data){
    $query = "SELECT * FROM login WHERE user=:user AND email=:email";
    $this->db->query($query);
    $this->db->bind('user', $data['user']);
    $this->db->bind('email', $data['email']);
    $datas = $this->db->result();

    return ($this->db->rowCount() > 0) ? $datas : false;
  }

  public function setCodeReset($code, $id){
    $query = "UPDATE login SET code=:code WHERE id=:id";
    $this->db->query($query);
    $this->db->bind('code', $code);
    $this->db->bind('id', $id);
    $this->db->execute();
  }

  public function validCodeReset($code){
    $query = "SELECT * FROM login WHERE code=:code";
    $this->db->query($query);
    $this->db->bind('code', $code);
    $this->db->execute();
    return ($this->db->rowCount() > 0) ? true : false;
  }

  public function resetPassword($data){
    if($this->validCodeReset($data['code'])){
      $query = "UPDATE login SET pass=:pass, code='' WHERE code=:code";
      $this->db->query($query);
      $this->db->bind('pass', $data['new_pass']);
      $this->db->bind('code', $data['code']);
      $this->db->execute();
      return ($this->db->rowCount() > 0) ? true : false;
    }else{
      return false;
    }
  }
}
