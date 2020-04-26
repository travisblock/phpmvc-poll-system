<?php

class PollingControl{

  private $db;

  public function __construct(){
    $this->db = Database::getDB();
  }

  public function tambah($data = null){
    if(!empty($data)){
      date_default_timezone_set('Asia/Jakarta');
      $date = date("Y-m-d H:i:s");
      $query = "INSERT INTO polling(name,detail,value,img,date) VALUES(:nama, :detail, 0, 'img.png', '$date')";
      $this->db->query($query);
      $this->db->bind('nama', $data['nama']);
      $this->db->bind('detail', $data['detail']);
      $this->db->execute();

      return $this->db->rowCount();
    }
  }

  public function hapus($id = null){
    $query = "DELETE FROM polling WHERE id=:id";
    $this->db->query($query);
    $this->db->bind('id', $id);
    $this->db->execute();
    return $this->db->rowCount();
  }

  public function edit($data = null, $id = null){
    $query = "UPDATE polling set name=:nama, detail=:detail WHERE id=:id";
    $this->db->query($query);
    $this->db->bind('id', $id);
    $this->db->bind('nama', $data['nama']);
    $this->db->bind('detail', $data['detail']);
    $this->db->execute();

    return $this->db->rowCount();
  }
}
