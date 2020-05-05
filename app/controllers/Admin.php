<?php

class Admin extends Controller{

  public function index(){
    if(empty(Session::get('AdminName'))){
      $data['action_login'] = BASEURL . '/admin/loginad';
      $this->view('login/index', $data);
    }else{
      Redirect::to(BASEURL.'/admin/dashboard');
    }

  }

  public function loginad(){
    $username = Input::get('username');
    $password = Input::get('password');
    if(!empty($username)){
      $data = $this->model('AdminModel')->login($username, $password);
      if($data){
        Session::set('id', $data['id']);
        Session::set('AdminName', $data['user']);
        Session::set('email', $data['email']);

        Redirect::to(BASEURL.'/admin/dashboard');
      }else{
        Redirect::to(BASEURL.'/admin');
      }

    }else{
      Redirect::to(BASEURL.'/admin');
    }
  }

  public function dashboard(){
      if(Session::exists('AdminName')){
        $data['judul'] = 'Dashboard';
        $data['email'] = Session::get('email');
        $this->view('admin/header', $data);
        $this->view('admin/dashboard', $data);
        $this->view('admin/footer');
      }else{
        Redirect::to(BASEURL.'/admin');
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
      if(Session::exists('AdminName')){
        $data['judul']   = 'Polling';
        $data['polling'] = $this->model('PollingModel')->getPolling();

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

          if(Input::exists('POST', 'nama')){

            $data['nama']   = htmlentities(Input::get('nama'));
            $data['detail'] = htmlentities(Input::get('detail'));

            if(Input::exists('FILES', 'img')){

              $gambar = new Upload($_FILES['img'], 'public/img/');

              if($gambar->uploaded('images')){

                $data['new_name'] = $gambar->getNewName();

                if($this->model('PollingModel')->tambah($data) > 0){
                  Msg::setMSG('Berhasil tambah kandidat', 'success');
                  Redirect::to(BASEURL.'/admin/polling');

                }else{
                  Msg::setMSG('Gagal tambah kandidat', 'error');
                  Redirect::to(BASEURL.'/admin/polling/tambah');
                }

              }else{
                Msg::setMSG('Gagal upload foto kandidat', 'error');
                Redirect::to(BASEURL.'/admin/polling/tambah');
              }

            }else{

              if($this->model('PollingModel')->tambah($data) > 0){
                Msg::setMSG('Berhasil tambah kandidat', 'success');
                Redirect::to(BASEURL.'/admin/polling');
              }else{
                Msg::setMSG('Gagal tambah kandidat', 'error');
                Redirect::to(BASEURL.'/admin/polling/tambah');
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

        }elseif($param1 == 'edit' && !is_null($param2)){
          $data['judul']    = 'Edit Kandidat';
          $data['kandidat'] = $this->model('PollingModel')->getPollById($param2);

          if(Input::exists('POST', 'nama')){
            $data['nama']      = htmlentities($_POST['nama']);
            $data['detail']    = htmlentities($_POST['detail']);

            if(Input::exists('FILES', 'img')){

              $gambar = new Upload($_FILES['img'], 'public/img/');

              if($gambar->uploaded('images')){
                $data['new_name'] = $gambar->getNewName();

                if(is_file('public/img/'. $data['kandidat']['img'])){
                  unlink('public/img/'. $data['kandidat']['img']);
                }

                if($this->model('PollingModel')->edit($data, $param2) > 0){
                  Msg::setMSG('Berhasil edit kandidat', 'success');
                  Redirect::to(BASEURL.'/admin/polling');
                }else{
                  Msg::setMSG('Gagal edit kandidat', 'error');
                  Redirect::to(BASEURL.'/admin/polling/edit'. $data['kandidat']['id']);
                }

              }else{
                Msg::setMSG('Gagal upload foto kandidat', 'error');
                Redirect::to(BASEURL.'/admin/polling/edit'. $data['kandidat']['id']);
              }

            }else{

              if($this->model('PollingModel')->edit($data, $param2) > 0){
                Msg::setMSG('Berhasil tambah kandidat', 'success');
                Redirect::to(BASEURL.'/admin/polling');
              }else{
                Msg::setMSG('Gagal edit kandidat', 'error');
                Redirect::to(BASEURL.'/admin/polling/edit'. $data['kandidat']['id']);
              }

            }
          }

          if($data['kandidat']){
            $this->view('admin/header', $data);
            $this->view('admin/polling/edit', $data);
            $this->view('admin/footer');
          }else{
            Redirect::to(BASEURL.'/admin/polling');
          }

          /**
          *
          * Untuk Hapus kandidat secara single
          *
          */

        }elseif($param1 == 'hapus' && !is_null($param2)){

          $img = $this->model('PollingModel')->getPollById($param2);
          if(is_file('public/img/'. $img['img'])){
            unlink('public/img/'. $img['img']);
          }

          if($this->model('PollingModel')->hapus($param2) > 0){
            Msg::setMSG('Berhasil hapus kandidat', 'success');
            Redirect::to(BASEURL.'/admin/polling');
          }else{
            Msg::setMSG('Gagal hapus kandidat', 'error');
            Redirect::to(BASEURL.'/admin/polling');
          }

          /**
          *
          * Untuk Hapus kandidat secara massal
          *
          */

        }elseif($param1 == 'massdelete'){
          $hapus = Input::get('hapusK');
          if($this->massDelete($hapus, 'PollingModel') > 0){
            Msg::setMSG('Kandidat berhasil dihapus', 'success');
            Redirect::to(BASEURL.'/admin/polling');
          }else{
            Msg::setMSG('Kandidat gagal dihapus', 'error');
            Redirect::to(BASEURL.'/admin/polling');
          }
        }else{
          Redirect::to(BASEURL.'/admin/polling');
        }

      }else{
        Redirect::to(BASEURL.'/admin');
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
      if(Session::exists('AdminName')){
        $data['judul'] = 'User Manager';
        $data['user']  = $this->model('UserMan')->getUser();

        /**
        *
        * Untuk menampilkan data user
        *
        */

        if(is_null($param1) && is_null($param2)){
          $this->view('admin/header', $data);
          $this->view('admin/userman/index', $data);
          $this->view('admin/footer');

          /**
          *
          * Untuk tambah data user
          *
          */

        }elseif($param1 == 'tambah' && is_null($param2)){
          $data['judul'] = 'Tambah User';

          if(Input::exists('POST')){
            $data['username'] = htmlentities(Input::get('username'));
            $data['pass']     = password_hash(Input::get('pass'), PASSWORD_DEFAULT);

            if(Input::exists('FILES', 'file')){

              $file = new Upload($_FILES['file']);

              if($file->allowed('xls')){

                if($file->getExt() === 'xls'){
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
                }else{
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
                }

                $xls = $reader->load($file->getTmp());
                $data['xls'] = $xls->getActiveSheet()->toArray();
                $error = 0;
                $jml   = count($data['xls']) - 1;
                $num   = 1;

                foreach($data['xls'] as $key => $value){
                  if($num > 1){
                    $data['username'] = $value[0];
                    $data['pass']     = $value[1];

                    if(!empty($value[0]) && !empty($value[1])){
                      if($this->model('UserMan')->tambah($data) < $jml){
                        $error++;
                      }
                    }
                  }
                  $num++;
                }

                if($error > 0){
                  Msg::setMSG('Ada field yang kosong', 'error');
                  Redirect::to(BASEURL.'/admin/userman');
                }else{
                    Msg::setMSG('User berhasil ditambahkan', 'success');
                    Redirect::to(BASEURL.'/admin/userman');
                }

              }else{
                Msg::setMSG('Hanya boleh .xls dan .xlsx', 'error');
                Redirect::to(BASEURL.'/admin/userman/tambah');
              }

            }elseif(!empty($data['username'])){

              if($this->model('UserMan')->tambah($data) > 0 ){
                Msg::setMSG('User berhasil ditambahkan', 'success');
                Redirect::to(BASEURL.'/admin/userman');
              }else{
                Msg::setMSG('User gagal ditambahkan', 'error');
                Redirect::to(BASEURL.'/admin/userman/tambah');
              }

            }
          }

          $this->view('admin/header', $data);
          $this->view('admin/userman/tambah', $data);
          $this->view('admin/footer');

          /**
          *
          * Untuk edit  User
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
              Redirect::to(BASEURL.'/admin/userman');
            }else{
              Msg::setMSG('User gagal diubah', 'error');
              Redirect::to(BASEURL.'/admin/userman/edit/'. $data['user']['id']);
            }
          }

          if($data['user']){
            $this->view('admin/header', $data);
            $this->view('admin/userman/edit', $data);
            $this->view('admin/footer');
          }else{
            Redirect::to(BASEURL.'/admin/userman');
          }

          /**
          *
          * Untuk Hapus User single
          *
          */

        }elseif($param1 == 'hapus' && !is_null($param2)){
          if($this->model('UserMan')->hapus($param2) > 0){
            Msg::setMSG('User behasil dihapus', 'success');
            Redirect::to(BASEURL.'/admin/userman');
          }else{
            Msg::setMSG('User gagal dihapus', 'error');
            Redirect::to(BASEURL.'/admin/userman');
          }

          /**
          *
          * Untuk Hapus User secara massal
          *
          */

        }elseif($param1 == 'massdelete'){
          $hapus = Input::get('hapusU');
          if($this->massDelete($hapus, 'UserMan') > 0){
            Msg::setMSG('User berhasil dihapus', 'success');
            Redirect::to(BASEURL.'/admin/userman');
          }else{
            Msg::setMSG('User gagal dihapus', 'error');
            Redirect::to(BASEURL.'/admin/userman');
          }

        }else{
          Redirect::to(BASEURL.'/admin/userman');
        }

      }else{
        Redirect::to(BASEURL.'/admin');
      }
  }

  public function setting($param1 = null){
      if(Session::exists('AdminName')){
        $data['judul'] = 'Setting Manager';
        $data['tampilan'] = $this->model('Settings')->getTampilan();

        if($param1 == 'tampilan'){
          if(isset($_POST)){
            $data['judul_web']    = htmlentities(Input::get('title'));
            $data['judul_voting'] = htmlentities(Input::get('voting'));
            $data['desc']         = htmlentities(Input::get('desc'));

            if($this->model('Settings')->tampilan($data)){
              Msg::setMSG('Settings berhasil disimpan', 'success');
              Redirect::to(BASEURL.'/admin/setting');
            }else{
              Msg::setMSG('Tidak ada perubahan pada data', 'warning');
              Redirect::to(BASEURL.'/admin/setting');
            }

          }

        }else {
          $this->view('admin/header', $data);
          $this->view('admin/setting/index', $data);
          $this->view('admin/footer');
        }

      }else{
        Redirect::to(BASEURL.'/admin');
      }
  }


  public function preview(){

    if(Session::exists('AdminName')){

      if(Input::exists('FILES', 'file')){

        $file = new Upload($_FILES['file']);

        if($file->getExt() === 'xls'){
            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
        }else{
            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        }

        $xls = $reader->load($file->getTmp());
        $data['preview'] = $xls->getActiveSheet()->toArray();

        $data['ERR']   = 0;
        $data['total'] = count($data['preview']) - 1;
        foreach($data['preview'] as $key => $value){
          if(empty($value[0]) || empty($value[1])){
            $data['ERR']++;
          }
        }

        $this->view('admin/userman/preview', $data);
      }

    }else{
      Redirect::to(BASEURL.'/admin');
    }
  }

  public function massDelete($hapus, $model = null){
    if(Session::exists('AdminName')){
      if(!is_null($model)){
        if(is_array($hapus)){
          $berhasil = 0;
          $jml      = count($hapus);
          for($i=0;$i< $jml;$i++){

            if($this->model($model)->hapus($hapus[$i]) > 0)
              $berhasil++;
          }
          return $berhasil;
        }
      }else{
        Redirect::to(BASEURL.'/admin');
      }
    }else{
      Redirect::to(BASEURL.'/admin');
    }
  }

  public function logout(){
    Session_destroy();
    Redirect::to(BASEURL.'/admin');
  }

}
