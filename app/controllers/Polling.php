<?php

class Polling extends Controller{

  public function index(){

  }

  public function getPollingById(){
      $id = json_decode(file_get_contents('php://input'), true);
      if(!is_null($id)){
        foreach($id as $key){
          $data = $this->model('PollingUser')->getPollById($key);
          $this->view('user/polling', $data);
        }
      }
  }

  public function pilih(){
    session_start();
    $id = Input::get('idPool');
    $user = Session::get('username');
    if($this->model('PollingUser')->pollInput($id, $user) > 0){
      Session_destroy();
      header('Location:'. BASEURL);
    }else{
      header('Location:'. BASEURL . '/user/home');
    }
  }

  public function getPollingData(){
    // sampe sini

    $data['judul'] = 'OK';
    $this->view('templates/header', $data);
    $id = json_decode(file_get_contents('php://input'), true);
    $time = isset($id) ? (int)$id : null;
    var_dump($id);
    set_time_limit(0);
    $this->model('PollingUser')->getPollRealtime($time);
    $this->view('templates/footer');
  }

}
