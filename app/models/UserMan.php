<?php

class UserMan{

  private $db;

  public function __construct(){
    $this->db = Database::getDB();
  }

  public function getUser(){
    $query = "SELECT * FROM user";
    $this->db->query($query);
    return $this->db->resultAll();
  }

  public function hapus($id){
    $query = "DELETE FROM user WHERE id=:id";
    $this->db->query($query);
    $this->db->bind('id', $id);
    $this->db->execute();

    return $this->db->rowCount();
  }

  public function tambah($data){
    if(!empty($data)){
      if(!$this->userExists($data['username'])){
        $query = "INSERT INTO user(username,pass,sudah) VALUES(:username, :pass, 0)";
        $this->db->query($query);
        $this->db->bind('username', $data['username']);
        $this->db->bind('pass', $data['pass']);
        $this->db->execute();

        return $this->db->rowCount();
      }
    }
  }

  public function getUserById($id){
    if(!empty($id)){

      $query = "SELECT * FROM user WHERE id=:id";
      $this->db->query($query);
      $this->db->bind('id', $id);
      $this->db->execute();

      return ($this->db->rowCount() > 0) ? $this->db->result() : false;

    }
  }

  public function edit($data, $id){

    if(!empty($data['pass'])){
      $query = "UPDATE user SET username=:username, pass='$data[pass]' WHERE id=:id";
    }else{
      $query = "UPDATE user SET username=:username WHERE id=:id";
    }

    $this->db->query($query);
    $this->db->bind('id', $id);
    $this->db->bind('username', $data['username']);
    $this->db->execute();

    return $this->db->rowCount();
  }

  public function userExists($user){
    $query = "SELECT * FROM user WHERE username=:user";
    $this->db->query($query);
    $this->db->bind('user', $user);
    $this->db->execute();

    return ($this->db->rowCount() > 0) ? true : false;
  }

}
