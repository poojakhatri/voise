<?php

  $configData = json_decode(file_get_contents('config.json'),true);

  class Database(){
    private $connection;
    public function __construct($configData){
      $this->connection = new mysqli($configData['host'], $configData['root'], $configData['password'], $configData['database']) or die(mysqli_error());
    }
    public function getConnection(){
      return $this->conenction;
    }
  }


?>
