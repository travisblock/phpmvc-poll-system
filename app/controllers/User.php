<?php

class User extends Controller{

  public function index(){
    if(empty(Session::get('username'))){
      $data['action_login'] = BASEURL . '/user/login';
      $this->view('login/index', $data);
    }else{
      Redirect::to(BASEURL.'/user/home');
    }

  }

  public function login(){
    $user = Input::get('user');
    $pass = Input::get('pass');
    if(!empty($user) && !empty($pass)){
      $data = $this->model('UserModel')->login($user, $pass);
      if($data){
        Session::set('username', $data['username']);
        Session::set('id', $data['id']);
        Redirect::to(BASEURL.'/user/home');
      }else{
        Redirect::to(BASEURL.'/user');
      }
    }else{
      Redirect::to(BASEURL.'/user');
    }

  }

  public function home(){
    if(Session::exists('username')){
      $data['judul'] = 'Polling';
      $data['poll'] = $this->model('PollingModel')->getPolling();
      $data['username'] = Session::get('username');
      $this->view('templates/header', $data);
      $this->view('user/index', $data);
      $this->view('templates/footer');
    }else{
      Redirect::to(BASEURL.'/user');
    }
  }

  public function logout(){
    Session_destroy();
    Redirect::to(BASEURL);
  }

  // public function register(){
  //   session_start();
  //   if(empty(Session::get('username'))){
  //     $data['email'] = htmlentities(Input::get('email'));
  //     $data['user']  = htmlentities(Input::get('user'));
  //     $data['pass']  = password_hash(Input::get('pass'), PASSWORD_DEFAULT);
  //     if(!empty($data['user']) && !empty($data['email'])){
  //       if($this->model('registerUser')->cekRegister($data)){
  //         if($this->model('registerUser')->register($data)){
  //
  //           Session::set('username', $data['user']);
  //           header('Location:'. BASEURL .'/user/home');
  //           exit();
  //         }else{
  //           echo "<script>alert('Ada kesalahan saat input data'); window.location.href='".BASEURL."/user'</script>";
  //         }
  //       }else{
  //         echo "<script>alert('Username / email sudah digunakan'); window.location.href='".BASEURL."/user'</script>";
  //       }
  //     }else{
  //       header('Location:'. BASEURL . '/user');
  //       exit();
  //     }
  //   }else{
  //     header('Location:'. BASEURL .'/user/home');
  //     exit();
  //   }
  // }

}
