<?php

class PollingUser{

  private $db;

  public function __construct(){
    return $this->db = Database::getDB();
  }

  public function getPolling(){
    $query = "SELECT * FROM polling";
    $this->db->query($query);
    return $this->db->resultAll();
  }

  public function getPollById($id){
    $query = "SELECT * FROM polling WHERE id=:id";
    $this->db->query($query);
    $this->db->bind('id', $id);

    return $this->db->result();
  }

  public function pollInput($id){
    $query = "UPDATE polling SET value=value+1 WHERE id=:id";
    $this->db->query($query);
    $this->db->bind('id', $id);
    $this->db->execute();
    return $this->db->rowCount();
  }
}
