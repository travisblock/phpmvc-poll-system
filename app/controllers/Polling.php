<?php

/**
* @author Yusuf Al Majid <ajidalmajid6@gmail.com>
* @license MIT
* @version 0.0.1
*/


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

  public function getPollingById(){
      $id = json_decode(file_get_contents('php://input'), true);
      if(!empty($id)){
        if(!is_null($id)){
          foreach($id as $key){
            $data = $this->model('PollingModel')->getPollById($key);
            $this->view('user/polling', $data);
          }
        }
      }else{
        header('Location:'. BASEURL);
        exit();
      }
  }

}
