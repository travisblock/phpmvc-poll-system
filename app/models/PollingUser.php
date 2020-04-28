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

  public function pollInput($idpoll = null, $iduser = null){
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

  public function getPollRealtime($ajax_call = null){
    if(!is_null($ajax_call)){
      while(true){

        $last_ajax_call= isset($ajax_call) ? (int)$ajax_call : null;

        clearstatcache();

        $query = "SELECT value,date FROM polling";
        $this->db->query($query);
        $data = $this->db->resultAll();
        $waktu = strtotime($data[0]['date']);

        if($last_ajax_call == null || $waktu > $last_ajax_call){

          // var_dump($data[0]);
          $value = json_encode($data[0]['value']);
          $result = array(
            'value' => json_decode($value),
            'timestamp' => $waktu
          );

          $json = json_encode($result);
          echo $json;

          // foreach($data as $val){
          //   $value = json_encode($val['value']);
          //
          //   $result = array(
          //     'value' => json_decode($value),
          //     'timestamp' => $waktu
          //   );
          //
          //   $json = json_encode($result);
          //   echo $json;
          // }

          break;
        }else{

          sleep(1);
          continue;

        }

      }
    }

  }
}
