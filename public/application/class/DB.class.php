<?php
  class DB{
    private $host = "localhost";
    private $name = "magtorrents";
    private $root = "root";
    private $pass = "";

    public function con(){
      try{
        return new PDO("mysql:host={$this->host};dbname={$this->name};charset=utf8", $this->root, $this->pass);
      }catch(PDOException $e){
        return "Houve um erro ao se conectar: ".$e;
      }
    }
  }
