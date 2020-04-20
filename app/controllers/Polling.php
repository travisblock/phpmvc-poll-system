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
    $id = Input::get('idPool');
    if($this->model('PollingUser')->pollInput($id) > 0){
      header('Location:'. BASEURL);
    }else{
      header('Location:'. BASEURL . '/user/home');
    }
  }
  
}
