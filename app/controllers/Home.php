<?php

class Home extends Controller{
  public function index(){
    $data['judul'] = 'Sistem Polling Realtime';
    $data['poll'] = $this->model('PollingUser')->getPolling();
    $this->view('templates/header', $data);
    $this->view('home/index', $data);
    $this->view('templates/footer');
  }
}
