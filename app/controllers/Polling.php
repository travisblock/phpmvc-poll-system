<?php

class Polling extends Controller{

  public function index(){
    Redirect::to(BASEURL);
  }



  public function pilih(){
    session_start();
    $idpoll = Input::get('idPoll');
    $iduser = Session::get('id');
    $user   = $this->model('UserMan')->getUserById($iduser);

    if($user['sudah'] < 1){
      if($this->model('PollingModel')->pollInput($idpoll, $iduser) > 0){
        Session_destroy();
        Redirect::to(BASEURL);
      }else{
        Redirect::to(BASEURL);
      }
    }else{
      Session_destroy();
      Redirect::to(BASEURL);
    }
  }


  /**
  *
  * Mencoba untuk realtime tapi gagal, akan saya coba kembangkan terus
  *
  */

  // public function getPollingById(){
  //     $id = json_decode(file_get_contents('php://input'), true);
  //     if(!empty($id)){
  //       if(!is_null($id)){
  //         foreach($id as $key){
  //           $data = $this->model('PollingModel')->getPollById($key);
  //           $this->view('user/polling', $data);
  //         }
  //       }
  //     }else{
  //       header('Location:'. BASEURL);
  //       exit();
  //     }
  // }
  //
  //
  // public function getPollingData(){
  //
  //   $data['judul'] = 'OK';
  //   $this->view('templates/header', $data);
  //   $id = json_decode(file_get_contents('php://input'), true);
  //   $time = isset($id) ? (int)$id : null;
  //   var_dump($id);
  //   set_time_limit(0);
  //   $this->model('PollingUser')->getPollRealtime($time);
  //   $this->view('templates/footer');
  // }

}
