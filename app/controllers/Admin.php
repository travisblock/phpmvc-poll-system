<?php

class Admin extends Controller{

  public function index(){
    session_start();
    if(empty(Session::get('AdminName'))){
      $data['judul'] = 'Login bro';
      $this->view('admin/index', $data);
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
            $data['img_tmp']   = $_FILES['img']['tmp_name'];
            $data['img_ext']   = pathinfo($data['img_name'], PATHINFO_EXTENSION);
            $data['img_path']  = "public/img/";
            $data['allow_ext'] = array('jpg', 'JPG', 'png', 'PNG', 'jpeg');
            $data['new_name'] = Upload::rename($data['img_name']);


            if(empty($data['img_name'])){

              if($this->model('PollingControl')->tambah($data) > 0){
                Msg::setMSG('Berhasil tambah kandidat', 'success');
                header('Location:'. BASEURL . '/admin/polling');
                exit();
              }else{
                Msg::setMSG('Gagal tambah kandidat', 'error');
                header('Location:'. BASEURL . '/admin/polling/tambah');
                exit();
              }

            }else{
              if(in_array($data['img_ext'], $data['allow_ext'])){

                if(move_uploaded_file($data['img_tmp'], $data['img_path'] . $data['new_name'])){

                  if($this->model('PollingControl')->tambah($data) > 0){
                    Msg::setMSG('Berhasil tambah kandidat', 'success');
                    header('Location:'. BASEURL . '/admin/polling');
                    exit();

                  }else{
                    Msg::setMSG('Gagal tambah kandidat', 'error');
                    header('Location:'. BASEURL . '/admin/polling/tambah');
                    exit();
                  }

                }
              }else{
                Msg::setMSG('Hanya boleh upload jpg, png, jpeg', 'error');
                header('Location:'. BASEURL . '/admin/polling/tambah');
                exit();
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
            Msg::setMSG('Berhasil hapus kandidat', 'success');
            header('Location:'. BASEURL . '/admin/polling');
            exit();
          }else{
            Msg::setMSG('Gagal hapus kandidat', 'error');
            header('Location:'. BASEURL . '/admin/polling');
            exit();
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
            $data['img_tmp']   = $_FILES['img']['tmp_name'];
            $data['img_ext']   = pathinfo($data['img_name'], PATHINFO_EXTENSION);
            $data['img_path']  = "public/img/";
            $data['allow_ext'] = array('jpg', 'JPG', 'png', 'PNG', 'jpeg');
            $data['new_name'] = Upload::rename($data['img_name']);

            if(empty($data['img_name'])){
              if($this->model('PollingControl')->edit($data, $param2) > 0){
                Msg::setMSG('Berhasil tambah kandidat', 'success');
                header("Location:".BASEURL."/admin/polling");
                exit();
              }else{
                Msg::setMSG('Gagal edit kandidat', 'error');
                header("Location:".BASEURL."/admin/polling/edit/". $data['kandidat']['id']);
                exit();
              }
            }else{

              if(in_array($data['img_ext'], $data['allow_ext'])){

                if(move_uploaded_file($data['img_tmp'], $data['img_path'] . $data['new_name'])){

                  if(is_file('public/img/'. $data['kandidat']['img'])){
                    unlink('public/img/'. $data['kandidat']['img']);
                  }

                  if($this->model('PollingControl')->edit($data, $param2) > 0){
                    Msg::setMSG('Berhasil edit kandidat', 'success');
                    header('Location:'. BASEURL . '/admin/polling');
                    exit();
                  }else{
                    Msg::setMSG('Gagal edit kandidat', 'error');
                    header("Location:".BASEURL."/admin/polling/edit/". $data['kandidat']['id']);
                    exit();
                  }
                }

              }else{
                Msg::setMSG('Hanya boleh JPG dan PNG', 'error');
                header("Location:".BASEURL."/admin/polling/edit/". $data['kandidat']['id']);
                exit();
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

        }elseif($param1 == 'massdelete'){
          $hapus = Input::get('hapusK');
          if($this->massDelete($hapus, 'PollingControl') > 0){
            Msg::setMSG('Kandidat berhasil dihapus', 'success');
            header('Location:'. BASEURL . '/admin/polling');
            exit();
          }else{
            Msg::setMSG('Kandidat gagal dihapus', 'error');
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

        if(is_null($param1) && is_null($param2)){
          $this->view('admin/header', $data);
          $this->view('admin/userman/index', $data);
          $this->view('admin/footer');

        }elseif($param1 == 'tambah' && is_null($param2)){
          $data['judul'] = 'Tambah User';

          if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $data['username'] = htmlentities(Input::get('username'));
            $data['pass']     = password_hash(Input::get('pass'), PASSWORD_DEFAULT);

            if(!empty($_FILES['file']['name'])){
              $data['name']    = $_FILES['file']['name'];
              $data['tmp']     = $_FILES['file']['tmp_name'];
              $data['ext']     = pathinfo($data['name'], PATHINFO_EXTENSION);
              $data['new']     = Upload::rename($data['name']);
              $data['allowed'] = array('xls', 'xlsx');

              if(in_array($data['ext'], $data['allowed'])){

                if($data['ext'] == 'xls'){
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
                }elseif($data['ext'] == 'xlsx'){
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
                }

                $xls = $reader->load($data['tmp']);
                $data['xls'] = $xls->getActiveSheet()->toArray();
                $error = 0;
                for($i = 1;$i < count($data['xls']);$i++){

                  if(empty($data['xls'][$i][0]) || empty($data['xls'][$i][1])){
                    $error++;
                  }

                  $data['username'] = $data['xls'][$i][0];
                  $data['pass']     = $data['xls'][$i][1];

                  if(!empty($data['xls'][$i][0]) && !empty($data['xls'][$i][1])){
                    $this->model('UserMan')->tambah($data);
                  }
                }

                if($error > 0){
                  Msg::setMSG('Error : Ada field yang kosong', 'error');
                  header('Location:'. BASEURL . '/admin/userman');
                  exit();
                }else{
                    Msg::setMSG('User berhasil ditambahkan', 'success');
                    header('Location:'. BASEURL . '/admin/userman');
                    exit();
                }

              }else{
                Msg::setMSG('Hanya boleh .xls dan .xlsx', 'error');
                header('Location:'. BASEURL . '/admin/userman/tambah');
                exit();
              }
            }elseif(!empty($data['username'])){

              if($this->model('UserMan')->tambah($data) > 0 ){
                Msg::setMSG('User berhasil ditambahkan', 'success');
                header('Location:'. BASEURL . '/admin/userman');
                exit();
              }else{
                Msg::setMSG('User gagal ditambahkan', 'error');
                header('Location:'. BASEURL . '/admin/userman/tambah');
                exit();
              }

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
            Msg::setMSG('User behasil dihapus', 'success');
            header('Location:'. BASEURL . '/admin/userman');
            exit();
          }else{
            Msg::setMSG('User gagal dihapus', 'error');
            header('Location:'. BASEURL . '/admin/userman');
            exit();
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
              Msg::setMSG('User berhasil diubah', 'success');
              header('Location:'. BASEURL . '/admin/userman');
              exit();
            }else{
              Msg::setMSG('User gagal diubah', 'error');
              header('Location:'. BASEURL . '/admin/userman/edit/' . $data['user']['id']);
              exit();
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

        }elseif($param1 == 'massdelete'){
          $hapus = Input::get('hapusU');
          if($this->massDelete($hapus, 'UserMan') > 0){
            Msg::setMSG('User berhasil dihapus', 'success');
            header('Location:'. BASEURL . '/admin/userman');
            exit();
          }else{
            Msg::setMSG('User gagal dihapus', 'error');
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

  public function setting($param1 = null){
      session_start();
      if(Session::exists('AdminName')){
        $data['judul'] = 'Setting Manager';
        $data['tampilan'] = $this->model('Settings')->getTamplan();

        if($param1 == 'tampilan'){
          if(isset($_POST)){
            $data['title']  = htmlentities(Input::get('title'));
            $data['desc']   = htmlentities(Input::get('desc'));

            if($this->model('Settings')->tampilan($data)){
              Msg::setMSG('Settings berhasil disimpan', 'success');
              ob_flush();
              header('Location:'. BASEURL . '/admin/setting');
            }else{
              Msg::setMSG('Settings gagal disimpan', 'error');
              header('Location:'. BASEURL . '/admin/setting');
            }

          }

        }else {
          $this->view('admin/header', $data);
          $this->view('admin/setting/index', $data);
          $this->view('admin/footer');
        }

      }else{
        header('Location:'. BASEURL . '/admin');
        exit();
      }
  }


  public function preview(){
    session_start();
    if(Session::exists('AdminName')){

        if(!empty($_FILES['file']['name'])){

            $data['name']    = $_FILES['file']['name'];
            $data['tmp']     = $_FILES['file']['tmp_name'];
            $data['ext']     = pathinfo($data['name'], PATHINFO_EXTENSION);

          if($data['ext'] == 'xls'){
              $reader = new PhpOffice\PhpSpreadsheet\Reader\Xls();
          }elseif($data['ext'] == 'xlsx'){
              $reader = new PhpOffice\PhpSpreadsheet\Reader\Xlsx();
          }
          $xls = $reader->load($data['tmp']);
          $data['preview'] = $xls->getActiveSheet()->toArray();

          $data['E_ALL'] = 0;
          for($i = 1;$i < count($data['preview']);$i++){

            if(empty($data['preview'][$i][0]) || empty($data['preview'][$i][1]))
              $data['E_ALL']++;

            $data['total'] = $i;
          }

          $this->view('admin/userman/preview', $data);
        }

    }else{
      header('Location:'. BASEURL . '/admin');
      exit();
    }
  }

  public function massDelete($hapus, $model = null){
    session_start();
    if(Session::exists('AdminName')){
      if(!is_null($model)){
        if(is_array($hapus)){
          $berhasil = 0;
          for($i=0;$i<count($hapus);$i++){
            if($this->model($model)->hapus($hapus[$i]) > 0)
              $berhasil++;
          }
          return $berhasil;
        }
      }else{
        header('Location:'. BASEURL . '/admin');
        exit();
      }
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
