<?php

/**
* @author Yusuf Al Majid <ajidalmajid6@gmail.com>
* @license MIT
* @version 0.0.1
*/

class PollingModel{

  private $db;

  public function __construct(){
    $this->db = Database::getDB();
  }

  public function tambah($data){

    date_default_timezone_set('Asia/Jakarta');
    $date = date("Y-m-d H:i:s");

    if(!empty($data['nama'])){
      if(!empty($data['new_name'])){
        $query = "INSERT INTO polling(name,detail,value,img,date) VALUES(:nama, :detail, 0, '$data[new_name]', '$date')";
      }else{
        $query = "INSERT INTO polling(name,detail,value,img,date) VALUES(:nama, :detail, 0, 'default.png', '$date')";
      }

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

  public function edit($data, $id = null){
    $img = $data['new_name'];
    if(!empty($img)){
      $query = "UPDATE polling set name=:nama, detail=:detail, img='$img' WHERE id=:id";
    }else{
      $query = "UPDATE polling set name=:nama, detail=:detail WHERE id=:id";
    }
    $this->db->query($query);
    $this->db->bind('id', $id);
    $this->db->bind('nama', $data['nama']);
    $this->db->bind('detail', $data['detail']);
    $this->db->execute();

    return $this->db->rowCount();
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

  public function pollInput($idpoll, $iduser = null){
    if(!empty($idpoll) && !empty($iduser)){
      date_default_timezone_set('Asia/Jakarta');
      $date = date("Y-m-d H:i:s");
      $query = "UPDATE polling SET value=value+1 WHERE id=:id";
      $this->db->query($query);
      $this->db->bind('id', $idpoll);
      $this->db->execute();

      $query_date = "UPDATE polling SET date='$date'";
      $this->db->query($query_date);
      $this->db->execute();
      $this->catatUser($iduser);
      return $this->db->rowCount();
    }
  }

  public function catatUser($iduser){

    $query = "UPDATE user set sudah=sudah+1 WHERE id=:iduser";
    $this->db->query($query);
    $this->db->bind('iduser', $iduser);
    $this->db->execute();
    return ($this->db->rowCount() > 0) ? true : false;
  }

}
