<?php

spl_autoload_register(function($class){
  require_once 'app/core/'.$class.'.php';
});

session_start();

require_once 'app/config/config.php';

require_once 'library/vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
