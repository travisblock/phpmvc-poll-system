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

  public function pollInput($id = null, $user = null){
    if(!is_null($id) && !is_null($user)){
      $query = "UPDATE polling SET value=value+1 WHERE id=:id";
      $this->db->query($query);
      $this->db->bind('id', $id);
      $this->db->execute();
      var_dump($this->catatUser($user));
      return $this->db->rowCount();
    }
  }

  public function catatUser($user){
    $query_id = "SELECT id FROM user WHERE username=:user";
    $this->db->query($query_id);
    $this->db->bind('user', $user);
    $id = $this->db->result();
    $id = $this->db->rowCount() > 0 ? $id['id'] : null;

    $query_catat = "UPDATE user set sudah=sudah+1 WHERE id=:id";
    $this->db->query($query_catat);
    $this->db->bind('id', $id);
    $this->db->execute();
    return ($this->db->rowCount() > 0) ? true : null;
  }
}
