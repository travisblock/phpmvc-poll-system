<?php

/**
* @author Yusuf Al Majid <ajidalmajid6@gmail.com>
* @license MIT
* @version 0.0.1
*/


class User extends Controller{

  public function index(){
    if(empty(Session::get('username'))){
      $data['action_login'] = BASEURL . '/user/login';
      $data['role'] = 'user';
      $this->view('login/index', $data);
    }else{
      Redirect::to(BASEURL.'/user/home');
    }

  }

  public function login(){
    $user = Input::get('username');
    $pass = Input::get('password');
    if(!empty($user) && !empty($pass)){
      $data = $this->model('UserModel')->login($user, $pass);
      if(is_array($data)){
        Session::set('username', $data['username']);
        Session::set('id', $data['id']);
        Redirect::to(BASEURL.'/user/home');
      }elseif($data === 'sudah'){
        Msg::setMSG('User sudah memilih', 'error');
        Redirect::to(BASEURL.'/user');
      }else{
        Msg::setMSG('User / passwd salah', 'error');
        Redirect::to(BASEURL.'/user');
      }
    }else{
      Redirect::to(BASEURL.'/user');
    }

  }

  public function home(){
    if(Session::exists('username')){
      $data['poll'] = $this->model('PollingModel')->getPolling();
      $data['view'] = $this->model('Settings')->getTampilan();
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

}
