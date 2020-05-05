<?php

class Home extends Controller{
  public function index(){
    $data['view'] = $this->model('Settings')->getTampilan();

    $data['judul_web'] = $data['view']['judul_web'];
    $data['judul_voting'] = $data['view']['judul_voting'];
    $data['deskripsi']  = $data['view']['deskripsi'];
    $data['poll'] = $this->model('PollingModel')->getPolling();
    $this->view('templates/header', $data);
    $this->view('home/index', $data);
    $this->view('templates/footer');
  }
}
