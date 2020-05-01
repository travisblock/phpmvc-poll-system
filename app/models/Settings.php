<?php

class Settings{

  private $db;

  public function __construct(){
    $this->db = Database::getDB();
  }

  public function tampilan($data){
    $query = "UPDATE pengaturan SET judul=:judul, deskripsi=:deskripsi";
    $this->db->query($query);
    $this->db->bind('judul', $data['title']);
    $this->db->bind('deskripsi', $data['desc']);
    $this->db->execute();

    return ($this->db->rowCount() > 0) ? true : false;
  }

  public function getTamplan(){
    $query = "SELECT * FROM pengaturan";
    $this->db->query($query);
    return $this->db->result();
  }
}
