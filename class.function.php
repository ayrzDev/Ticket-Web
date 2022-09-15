<?php
session_start();

class classFonksiyon {

    private $settings = "settings.json";
    private $host;
    private $username;
    private $password;
    private $database;

    public function __construct()
    {
      $jsonVeri = file_get_contents($this->settings);
      $jsonVeri = json_decode($jsonVeri,true);
      $this->host = $jsonVeri["host"];
      $this->username = $jsonVeri["username"];
      $this->password = $jsonVeri["password"];
      $this->database = $jsonVeri["database"];
    }

    public function dbConnection(){
         try {
            $conn = new PDO("mysql:host=$this->host;dbname=$this->database;charset=utf8", $this->username, $this->password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $message = "Connected successfully";
          } catch(PDOException $e) {
            $message = "Connection failed: " . $e->getMessage();
          }
          echo "<script> console.log('{$message}')</script>";
    }
}

$class = new classFonksiyon();
$class->dbConnection();