<?php

/**
* @author Yusuf Al Majid <ajidalmajid6@gmail.com>
* @license MIT
* @version 0.0.1
*/

class Database{

  private $dbh,
          $stmt;
  private $HOST = DB_HOST,
          $USER = DB_USER,
          $PASS = DB_PASS,
          $NAME = DB_NAME;
  private static $instance = null;

  public function __construct(){
    $dsn = 'mysql:host='. $this->HOST . ';dbname='. $this->NAME;
    $options = [
      PDO::ATTR_PERSISTENT => true,
      PDO::ATTR_ERRMODE    => PDO::ERRMODE_EXCEPTION
    ];
    try{
      $this->dbh = new PDO($dsn, $this->USER, $this->PASS, $options);
    }catch(PDOException $e){
      die($e->getMessage());
    }
  }

  public static function getDB(){
    if(!isset(self::$instance)){
      self::$instance = new Database;
    }

    return self::$instance;
  }

  public function query($query){
    $this->stmt = $this->dbh->prepare($query);
  }

  public function bind($param, $value, $type=null){
    if(is_null($type)){
      switch (true) {
				case is_int($value):
					$type = PDO::PARAM_INT;
					break;
				case is_bool($value):
					$type = PDO::PARAM_BOOL;
					break;
        case is_null($value):
          $type = PDO::PARAM_NULL;
          break;
        default:
          $type = PDO::PARAM_STR;
          break;
      }
    }

    return $this->stmt->bindValue($param, $value, $type);
  }

  public function execute(){
    $this->stmt->execute();
  }

  public function resultAll(){
    $this->execute();
    return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function result(){
    $this->execute();
    return $this->stmt->fetch(PDO::FETCH_ASSOC);
  }

  public function rowCount(){
    return $this->stmt->rowCount();
  }

}
