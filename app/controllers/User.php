<?php

class User extends Controller{

  public function index(){

    $this->view('login/index');

  }

  public function login(){
    $user = Input::get('user');
    $pass = Input::get('pass');
    if(!empty($user) && !empty($pass)){
      if($this->model('loginUser')->login($user, $pass)){
        session_start();
        Session::set('username', $user);
        header('Location:'. BASEURL .'/user/home');
        exit();
      }else{
        header('Location:'. BASEURL .'/user');
        exit();
      }
    }else{
      header('Location:'. BASEURL . '/user');
      exit();
    }

  }

  public function home(){
    session_start();
    if(Session::exists('username')){
      $data['judul'] = 'Polling';
      $data['poll'] = $this->model('PollingUser')->getPolling();
      $this->view('templates/header', $data);
      $this->view('user/index', $data);
      $this->view('templates/footer');
    }else{
      header('Location:'. BASEURL . '/user');
      exit();
    }
  }

  public function logout(){
    session_start();
    Session_destroy();
    header('Location:'. BASEURL);
    exit();
  }

  public function register(){
    $data['email'] = htmlentities(Input::get('email'));
    $data['user']  = htmlentities(Input::get('user'));
    $data['pass']  = password_hash(Input::get('pass'), PASSWORD_DEFAULT);

    if($this->model('registerUser')->cekRegister($data)){
      if($this->model('registerUser')->register($data)){
        session_start();
        Session::set('username', $data['user']);
        header('Location:'. BASEURL .'/user/home');
        exit();
      }else{
        echo "<script>alert('Ada kesalahan saat input data'); window.location.href='".BASEURL."/user'</script>";
      }
    }else{
      echo "<script>alert('Username / email sudah digunakan'); window.location.href='".BASEURL."/user'</script>";
    }
  }

}
