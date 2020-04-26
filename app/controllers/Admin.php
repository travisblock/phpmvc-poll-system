<?php

class Admin extends Controller{

  public function index(){
    session_start();
    if(empty(Session::get('username'))){
      $data['judul'] = 'Login Harian';
      $this->view('templates/header', $data);
      $this->view('admin/index');
      $this->view('templates/footer');
    }else{
      header('Location:'. BASEURL .'/admin/dashboard');
      exit();
    }

  }

  public function loginad(){
    $username = Input::get('username');
    $password = Input::get('password');
    if(!empty($username)){
      $data = $this->model('LoginAdmin')->login($username, $password);
      if($data){
        session_start();
        Session::set('id', $data['id']);
        Session::set('username', $data['user']);
        Session::set('email', $data['email']);

        header('Location:'. BASEURL . '/admin/dashboard');
        exit();
      }else{
        header('Location:'. BASEURL . '/admin');
        exit();
      }

    }else{
      header('Location:'. BASEURL . '/admin');
      exit();
    }
  }

  public function dashboard(){
      session_start();
      if(Session::exists('username')){
        $data['judul'] = 'Dashboard';
        $data['email'] = Session::get('email');
        $this->view('admin/header', $data);
        $this->view('admin/dashboard', $data);
        $this->view('admin/footer');
      }else{
        header('Location:'. BASEURL . '/admin');
        exit();
      }
  }

  public function polling(){
      session_start();
      if(Session::exists('username')){
        $data['judul'] = 'Polling';
        $data['email'] = 'pollinggann';
        $this->view('admin/header', $data);
        $this->view('admin/polling', $data);
        $this->view('admin/footer');
      }else{
        header('Location:'. BASEURL . '/admin');
        exit();
      }
  }

  public function userman(){
      session_start();
      if(Session::exists('username')){
        $data['judul'] = 'User Manager';
        $data['email'] = Session::get('username');
        $this->view('admin/header', $data);
        $this->view('admin/dashboard', $data);
        $this->view('admin/footer');
      }else{
        header('Location:'. BASEURL . '/admin');
        exit();
      }
  }

  public function setting(){
      session_start();
      if(Session::exists('username')){
        $data['judul'] = 'Setting Manager';
        $data['email'] = Session::get('username');
        $this->view('admin/header', $data);
        $this->view('admin/dashboard', $data);
        $this->view('admin/footer');
      }else{
        header('Location:'. BASEURL . '/admin');
        exit();
      }
  }



  public function logout(){
    session_start();
    Session_destroy();
    header('Location:'. BASEURL . '/admin');
    exit();
  }

}
