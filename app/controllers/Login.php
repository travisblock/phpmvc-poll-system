<?php

class Login extends Controller{

  public function index(){

    $this->view('login/index');

  }

  // public function cekUser($user){
  //   $query = "SELECT * FROM login WHERE user=:user";
  //   $this->db->query($query);
  //   $this->db->bind('user', $user);
  //   $this->db->execute();
  //   var_dump($this->db);
  //   var_dump($this->db->rowCount());
  // }

  public function masuk(){
    $user = Input::get('user');
    $pass = Input::get('pass');

    var_dump($this->model('loginUser')->login($user, $pass));
    
  }

}
