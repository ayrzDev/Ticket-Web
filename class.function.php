<?php
session_start();

class classFonksiyon {

    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $database = "Support";


    public function dbConnection(){
        try {
            $conn = new PDO("mysql:host=$this->servername;dbname=$this->database", $this->username, $this->password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "Connected successfully";
          } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
          }
    }

}