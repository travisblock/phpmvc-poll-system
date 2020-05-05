<?php

class Settings{

  private $db;

  public function __construct(){
    $this->db = Database::getDB();
  }

  public function tampilan($data){
    $query = "UPDATE pengaturan SET judul_web=:judul_web, judul_voting=:judul_voting, deskripsi=:deskripsi";
    $this->db->query($query);
    $this->db->bind('judul_web', $data['judul_web']);
    $this->db->bind('judul_voting', $data['judul_voting']);
    $this->db->bind('deskripsi', $data['desc']);
    $this->db->execute();

    return ($this->db->rowCount() > 0) ? true : false;
  }

  public function getTampilan(){
    $query = "SELECT * FROM pengaturan";
    $this->db->query($query);
    return $this->db->result();
  }
}
