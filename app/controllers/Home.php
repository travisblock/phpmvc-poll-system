<?php

/**
* @author Yusuf Al Majid <ajidalmajid6@gmail.com>
* @license MIT
* @version 0.0.1
*/


class Home extends Controller{
  public function index(){
    $data['view'] = $this->model('Settings')->getTampilan();
    $data['poll'] = $this->model('PollingModel')->getPolling();
    $this->view('templates/header', $data);
    $this->view('home/index', $data);
    $this->view('templates/footer');
  }
}
