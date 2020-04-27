<?php

class Admin extends Controller{

  public function index(){
    session_start();
    if(empty(Session::get('AdminName'))){
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
        Session::set('AdminName', $data['user']);
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
      if(Session::exists('AdminName')){
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
      if(Session::exists('AdminName')){
        $data['judul']   = 'Polling';
        $data['polling'] = $this->model('PollingUser')->getPolling();

        /**
        *
        * Untuk Menampilkan index polling manager
        *
        */

        if(is_null($param1) && is_null($param2)){
          $this->view('admin/header', $data);
          $this->view('admin/polling/index', $data);
          $this->view('admin/footer');

          /**
          *
          * Untuk Tambah kandidat
          *
          */

        }elseif($param1 == 'tambah' && is_null($param2)){
          $data['judul'] = 'Tambah Kandidat';

          if($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['nama'])){

            $data['nama']   = htmlentities(Input::get('nama'));
            $data['detail'] = htmlentities(Input::get('detail'));
            $data['img_name']  = $_FILES['img']['name'];
            $data['img_size']  = $_FILES['img']['size'];
            $data['img_tmp']   = $_FILES['img']['tmp_name'];
            $data['img_ext']   = pathinfo($data['img_name'], PATHINFO_EXTENSION);
            $data['img_path']  = "public/img/";
            $data['allow_ext'] = array('jpg', 'JPG', 'png', 'PNG', 'jpeg');
            $data['new_name'] = Upload::rename($data['img_name']);


            if(empty($data['img_name'])){

              if($this->model('PollingControl')->tambah($data) > 0){
                header('Location:'. BASEURL . '/admin/polling');
                exit();
              }else{
                echo "<script>alert('GAGAL Tambah Kandidat'); window.location.href='".BASEURL."/admin/polling'</script>";
              }

            }else{
              if(in_array($data['img_ext'], $data['allow_ext'])){

                if(move_uploaded_file($data['img_tmp'], $data['img_path'] . $data['new_name'])){

                  if($this->model('PollingControl')->tambah($data) > 0){
                    header('Location:'. BASEURL . '/admin/polling');
                    exit();
                  }else{
                    echo "<script>alert('GAGAL Tambah Kandidat'); window.location.href='".BASEURL."/admin/polling'</script>";
                  }

                }
              }else{
                echo "<script>alert('Hanya boleh JPG dan PNG'); window.location.href='".BASEURL."/admin/polling/tambah'</script>";
              }
            }
          }

          $this->view('admin/header', $data);
          $this->view('admin/polling/tambah', $data);
          $this->view('admin/footer');

          /**
          *
          * Untuk Hapus kandidat
          *
          */

        }elseif($param1 == 'hapus' && !is_null($param2)){

          $img = $this->model('PollingUser')->getPollById($param2);
          if(is_file('public/img/'. $img['img'])){
            unlink('public/img/'. $img['img']);
          }

          if($this->model('PollingControl')->hapus($param2) > 0){
            header('Location:'. BASEURL . '/admin/polling');
            exit();
          }else{
            echo "<script>alert('GAGAL Hapus Kandidat'); window.location.href='".BASEURL."/admin/polling'</script>";
          }

          /**
          *
          * Untuk Edit kandidat
          *
          */

        }elseif($param1 == 'edit' && !is_null($param2)){
          $data['judul']    = 'Edit Kandidat';
          $data['kandidat'] = $this->model('PollingUser')->getPollById($param2);

          if($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['nama'])){
            $data['nama']   = htmlentities($_POST['nama']);
            $data['detail'] = htmlentities($_POST['detail']);
            $data['img_name']  = $_FILES['img']['name'];
            $data['img_size']  = $_FILES['img']['size'];
            $data['img_tmp']   = $_FILES['img']['tmp_name'];
            $data['img_ext']   = pathinfo($data['img_name'], PATHINFO_EXTENSION);
            $data['img_path']  = "public/img/";
            $data['allow_ext'] = array('jpg', 'JPG', 'png', 'PNG', 'jpeg');
            $data['new_name'] = Upload::rename($data['img_name']);

            if(empty($data['img_name'])){
              if($this->model('PollingControl')->edit($data, $param2) > 0){
                header('Location:'. BASEURL . '/admin/polling');
                exit();
              }else{
                echo "<script>alert('GAGAL edit Kandidat'); window.location.href='".BASEURL."/admin/polling/edit/". $data['kandidat']['id'] ."'</script>";
              }
            }else{

              if(in_array($data['img_ext'], $data['allow_ext'])){

                if(move_uploaded_file($data['img_tmp'], $data['img_path'] . $data['new_name'])){

                  if(is_file('public/img/'. $data['kandidat']['img'])){
                    unlink('public/img/'. $data['kandidat']['img']);
                  }

                  if($this->model('PollingControl')->edit($data, $param2) > 0){
                    header('Location:'. BASEURL . '/admin/polling');
                    exit();
                  }else{
                    echo "<script>alert('GAGAL edit Kandidat'); window.location.href='".BASEURL."/admin/polling/edit/". $data['kandidat']['id'] ."'</script>";
                  }
                }

              }else{
                echo "<script>alert('Hanya boleh JPG dan PNG'); window.location.href='".BASEURL."/admin/polling/edit/". $data['kandidat']['id'] ."'</script>";
              }
            }
          }

          if($data['kandidat']){
            $this->view('admin/header', $data);
            $this->view('admin/polling/edit', $data);
            $this->view('admin/footer');
          }else{
            header('Location:'. BASEURL . '/admin/polling');
            exit();
          }

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
      if(Session::exists('AdminName')){
        $data['judul'] = 'User Manager';
        $data['user']  = $this->model('UserMan')->getUser();

        /**
        *
        * Untuk Menampilkan index user manager
        *
        */

        if(is_null($param1) && is_null($param2)){
          $this->view('admin/header', $data);
          $this->view('admin/userman/index', $data);
          $this->view('admin/footer');

          /**
          *
          * Untuk Tambah User
          *
          */

        }elseif($param1 == 'tambah' && is_null($param2)){
          $data['judul'] = 'Tambah User';

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

          /**
          *
          * Untuk Hapus User
          *
          */

        }elseif($param1 == 'hapus' && !is_null($param2)){
          if($this->model('UserMan')->hapus($param2) > 0){
            header('Location:'. BASEURL . '/admin/userman');
            exit();
          }else{
            echo "<script>alert('GAGAL Hapus User'); window.location.href='".BASEURL."/admin/userman'</script>";
          }

          /**
          *
          * Untuk Edit User
          *
          */

        }elseif($param1 == 'edit' && !is_null($param2)){
          $data['judul'] = 'Edit User';
          $data['user']  = $this->model('UserMan')->getUserById($param2);

          if(!empty($_POST)){
            $data['username'] = htmlentities($_POST['username']);
            $data['pass']     = $_POST['pass'];

            if($this->model('UserMan')->edit($data, $param2) > 0){
              header('Location:'. BASEURL . '/admin/userman');
              exit();
            }else{
              echo "<script>alert('GAGAL Edit User'); window.location.href='".BASEURL."/admin/userman'</script>";
            }
          }

          if($data['user']){
            $this->view('admin/header', $data);
            $this->view('admin/userman/edit', $data);
            $this->view('admin/footer');
          }else{
            header('Location:'. BASEURL . '/admin/userman');
            exit();
          }

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
      if(Session::exists('AdminName')){
        $data['judul'] = 'Setting Manager';
        $data['email'] = Session::get('AdminName');
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
