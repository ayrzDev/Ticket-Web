<?php

require_once("functionBase.php");

class classFonksiyon {

    private $settings = "/settings.json";
    private $host;
    private $username;
    private $password;
    private $database;

    public function __construct()
    {
      $jsonVeri = file_get_contents($_SERVER['DOCUMENT_ROOT'].$this->settings);
      $jsonVeri = json_decode($jsonVeri,true);
      $this->host = $jsonVeri["host"];
      $this->username = $jsonVeri["user"];
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
      // echo "<script> console.log('{$message}')</script>";
      return $conn;
    }

    public function pagesAll($location,$permission){
      $db = $this->dbConnection();
      $user = new Accounts();
      if($db){
        if($location == 1){
          $page = $db->prepare("SELECT * FROM pages WHERE location = ?");
          $page->execute(array(
            $location
          ));    
          if($page->rowCount() != 0){
            foreach ($page as $page_veri) {
                if($page_veri["permission"] == $permission){
                echo "<li class='treeview'>";
                echo "<a href='{$page_veri["src"]}'>";
                echo "<i class='{$page_veri["icon"]}'></i> <span>{$page_veri["name"]}</span>";
                echo "</a>";
                echo "</li>"; 
                }
            }
        }
        }else{
          $page = $db->prepare("SELECT * FROM pages WHERE location = ?");
          $page->execute(array(
            $location
          ));    
          if($page->rowCount() != 0){
            foreach ($page as $page_veri) {
              if($user->getLogged()){
                if($page_veri["isLogged"] != 0 || $page_veri["isLogged"] == 0){  
                  echo '<li class="nav-item">';
                  echo "<i class='fa fa-ticket'></i><a class='nav-link' href='{$page_veri["src"]}'>{$page_veri["name"]}</a>";
                  echo '</li>';
                }
              }else{
                if($page_veri["isLogged"] == 0){  
                  echo '<li class="nav-item">';
                  echo "<i class='fa fa-ticket'></i><a class='nav-link' href='{$page_veri["src"]}'>{$page_veri["name"]}</a>";
                  echo '</li>';
                }
              }
            }
        }
      }
    }
    }

    public function getWebKey(){
      $key = array(
        "host" => $this->host,
        "user" => $this->user,
        "password" => $this->password,
        "database" => $this->database
      );
      return $key;
    }

    public function roleAdd(){
      $db = $this->dbConnection();
      $name = trim($_POST["roleName"]);

      if($db){
        $role_add = $db->prepare("INSERT INTO roles SET name = ?");
        $role_add_fetch = $role_add->fetchColumn();
        $role_add->execute(array(
          $name,
        ));
        echo "Eklendi";
      }
    }

    public function supportAdd(){
      $db = $this->dbConnection();
      $title = $_POST["title"];
      $message = $_POST["message"];
      $department = $_POST["departments"];
      if($department != 0){
        if($message != null){
        $support_add = $db->prepare("INSERT INTO supports SET title = ?, message = ? ,department = ?, ownerId = ?");
        $support_add->execute(array(
          $title,
          $message,
          $department,
          $_SESSION["userAccountID"]
        ));
      }
      echo "Destek talebi açıldı.";
      }else{
      echo "Departman seçiniz";
      }
    }

    public function getSupports(){
      $db = $this->dbConnection();
      $user = new Accounts();
      $extra = new extraClass();
      if($user->getPermission($_SESSION["userAccountID"]) == 1){
        $supports = $db->prepare("SELECT * FROM supports");
        $supports->execute();
        if($supports->rowCount() != 0){
          foreach ($supports as $supports_veri) {
            $message = $extra->kisalt(strip_tags($supports_veri["message"]),25);
            $title = $extra->kisalt($supports_veri['title'],10);
            $name = $user->getName($supports_veri["ownerId"]);
            $stats = array(
              0 => "<p class='text-success bg-success text-center'>Açık</p>",
              1 => "<p class='text-warning bg-warning text-center'>Beklemede</p>",
              2 => "<p class='text-danger bg-danger text-center'>Kapalı</p>"
            );
            echo "<tr>";  
            echo "<td>{$supports_veri['id']}</td>";
            echo "<td>{$title}</td>";
            echo "<td>{$message}</td>";
            echo "<td>{$extra->kisalt($name,15)}</td>";
            echo "<td>{$stats[$supports_veri["status"]]}</td>";
            echo "<td><button class='btn btn-warning btn-specly mt-2 mr-2' type='button'>Düzenle</button>";
            echo "<button class='btn btn-danger btn-specly mt-2 mr-2' type='button'>Sil</button></td>";
            echo "</tr>";
          }
        }
      }else{

      }
    }
}