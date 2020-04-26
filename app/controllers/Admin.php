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

  public function polling($param1 = null, $param2 = null){
      session_start();
      if(Session::exists('username')){
        $data['judul'] = 'Polling';
        $data['polling'] = $this->model('PollingUser')->getPolling();

        if(is_null($param1) && is_null($param2)){
          $this->view('admin/header', $data);
          $this->view('admin/polling/index', $data);
          $this->view('admin/footer');

        }elseif($param1 == 'tambah' && is_null($param2)){
          $data['judul'] = 'Tambah Kandidat';
          if(!empty($_POST)){
            $data['nama'] = htmlentities($_POST['nama']);
            $data['detail'] = htmlentities($_POST['detail']);
            if($this->model('PollingControl')->tambah($data) > 0){
              echo "<script>alert('Berhasil Tambah Kandidat'); window.location.href='".BASEURL."/admin/polling'</script>";
            }else{
              echo "<script>alert('GAGAL Tambah Kandidat'); window.location.href='".BASEURL."/admin/polling'</script>";
            }
          }

          $this->view('admin/header', $data);
          $this->view('admin/polling/tambah', $data);
          $this->view('admin/footer');

        }elseif($param1 == 'hapus' && !is_null($param2)){
          if($this->model('PollingControl')->hapus($param2) > 0){
            echo "<script>alert('Berhasil Hapus Kandidat'); window.location.href='".BASEURL."/admin/polling'</script>";
          }else{
            echo "<script>alert('GAGAL Hapus Kandidat'); window.location.href='".BASEURL."/admin/polling'</script>";
          }

        }elseif($param1 == 'edit' && !is_null($param2)){
          $data['judul'] = 'Edit Kandidat';
          $data['kandidat'] = $this->model('PollingUser')->getPollById($param2);
          if(!empty($_POST)){
            $data['nama'] = htmlentities($_POST['nama']);
            $data['detail'] = htmlentities($_POST['detail']);
            if($this->model('PollingControl')->edit($data, $param2) > 0){
              echo "<script>alert('Berhasil Edit Kandidat'); window.location.href='".BASEURL."/admin/polling'</script>";
            }else{
              echo "<script>alert('GAGAL Edit Kandidat'); window.location.href='".BASEURL."/admin/polling'</script>";
            }
          }
          $this->view('admin/header', $data);
          $this->view('admin/polling/edit', $data);
          $this->view('admin/footer');

        }else{
          header('Location:'. BASEURL . '/admin/polling');
          exit();
        }

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
