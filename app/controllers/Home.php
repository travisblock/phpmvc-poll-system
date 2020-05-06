<?php

class Home extends Controller{
  public function index(){
    $data['view'] = $this->model('Settings')->getTampilan();
    $data['poll'] = $this->model('PollingModel')->getPolling();
    $this->view('templates/header', $data);
    $this->view('home/index', $data);
    $this->view('templates/footer');
  }
}
