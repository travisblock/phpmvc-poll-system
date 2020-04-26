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

  public function tambah($data = null){
    if(!empty($data)){
      $query = "INSERT INTO user(username,pass,sudah) VALUES(:username, :pass, 0)";
      $this->db->query($query);
      $this->db->bind('username', $data['username']);
      $this->db->bind('pass', $data['pass']);
      $this->db->execute();

      return $this->db->rowCount();
    }
  }

}
