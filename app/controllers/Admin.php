<?php

class Admin extends Controller{

  public function index(){
    session_start();
    if(empty(Session::get('username'))){
      $this->view('admin/index');
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

  /**
  * Polling Manager for manage polling
  * function polling for tambah,edit,hapus polling
  *
  * @param param1 used to action ex: tambah
  * @param param2 used to id ex: 1 -> /admin/polling/tambah/1
  *
  */

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
            $data['nama'] = htmlentities(Input::get('nama'));
            $data['detail'] = htmlentities(Input::get('detail'));
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


  /**
  * USERMAN - User Manager for manage user
  * function userman for tambah,edit,hapus user
  *
  * @param param1 used to action ex: tambah
  * @param param2 used to id ex: 1 -> /admin/polling/tambah/1
  *
  */

  public function userman($param1 = null, $param2 = null){
      session_start();
      if(Session::exists('username')){
        $data['judul'] = 'User Manager';
        $data['user'] = $this->model('UserMan')->getUser();

        if(is_null($param1) && is_null($param2)){
          $this->view('admin/header', $data);
          $this->view('admin/userman/index', $data);
          $this->view('admin/footer');

          /**
          * USERMAN - User Manager for manage user
          * function userman for tambah,edit,hapus user
          *
          * @param param1 used to action ex: tambah
          * @param param2 used to id ex: 1 -> /admin/polling/tambah/1
          *
          */

        }elseif($param1 == 'tambah' && is_null($param2)){
          $data['judul']    = 'Tambah User';

          if(!empty($_POST)){
            $data['username'] = htmlentities(Input::get('username'));
            $data['pass']     = password_hash(Input::get('pass'), PASSWORD_DEFAULT);

            if($this->model('UserMan')->tambah($data) > 0 ){
              header('Location:'. BASEURL . '/admin/userman');
              exit();
            }else{
              echo "<script>alert('GAGAL tambah User'); window.location.href='".BASEURL."/admin/userman'</script>";
            }
          }

          $this->view('admin/header', $data);
          $this->view('admin/userman/tambah', $data);
          $this->view('admin/footer');


        }elseif($param1 == 'hapus' && !is_null($param2)){
          if($this->model('UserMan')->hapus($param2) > 0){
            header('Location:'. BASEURL . '/admin/userman');
            exit();
          }else{
            echo "<script>alert('GAGAL Hapus User'); window.location.href='".BASEURL."/admin/userman'</script>";
          }

        }elseif($param1 == 'edit' && !is_null($param2)){
          $data['judul'] = 'Edit User';
          $this->view('admin/header', $data);
          $this->view('admin/userman/index', $data);
          $this->view('admin/footer');
        }else{
          header('Location:'. BASEURL . '/admin/userman');
          exit();
        }

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
