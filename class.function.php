<?php
session_start();

class classFonksiyon {

    private $settings = __DIR__."/settings.json";
    private $host;
    private $username;
    private $password;
    private $database;

    public function __construct()
    {
      $jsonVeri = file_get_contents($this->settings);
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
      echo "<script> console.log('{$message}')</script>";
      return $conn;
    }

    public function pagesAll($location){
      $db = $this->dbConnection();
      if($db){
          $page = $db->prepare("SELECT * FROM pages WHERE location = ?");
          $page->execute(array(
            $location
          ));    
          if($page->rowCount() != 0){
            foreach ($page as $page_veri) {
               echo '<li class="nav-item">';
               echo "<a class='nav-link' href='{$page_veri["src"]}'>{$page_veri["name"]}</a>";
               echo '</li>';
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
}

class Accounts{
  
  public function createAccount(){
    $class = new classFonksiyon();
    $db = $class->dbConnection();
    if($db){
      $email = stripslashes(trim(htmlspecialchars($_POST["email"])));
      $name = stripslashes(trim(htmlspecialchars($_POST["name"])));
      $lastname = stripslashes(trim(htmlspecialchars($_POST["lastname"])));
      $password = md5(stripslashes(trim(htmlspecialchars($_POST["password"]))));

      if(!$name || !$lastname || !$_POST["password"] || !$email){
        // echo "Boş bırakmayın";
      }else{
      if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

      $userDb = $db->prepare("SELECT email FROM accounts WHERE email = ?");
      $userDb->execute(array(
        $email
      ));
      if($userDb->rowCount() == 0){
        $insertUser = $db->prepare("INSERT INTO accounts SET firstName = ?, lastName = ?, email = ? , password = ?"); 
        $insertUser->execute(array(
          $name,
          $lastname,
          $email,
          $password
        ));    
        echo '<div class="alert alert-primary" role="alert">Kayıt Oluşturuldu. 3 Saniye içerisinde yönlendirileceksiniz.</div>';
        echo '<meta http-equiv="refresh" content="3;URL=index.php">';
        // exit;
      }else{
        echo '<div class="alert alert-danger" role="alert">Zaten bu hesap kayıtlı.</div>';
      }
    }
  }
    }else{
      echo "Bağlantı Hatası mevcut";
    }
    
  }

  public function getAllAccounts(){
    $class = new classFonksiyon();
    $user = new Accounts();
    $db = $class->dbConnection();
     if($db){
        $accounts = $db->prepare("SELECT * FROM accounts");
        $accounts->execute();
        if($accounts->rowCount() != 0){
          foreach ($accounts as $accounts_veri) {
              $role = $this->getPermissionName($accounts_veri["id"]);
              echo "<tr>";
              echo "<td>{$accounts_veri["id"]}</td>";
              echo "<td>{$accounts_veri["firstName"]}</td>";
              echo "<td>{$accounts_veri["lastName"]}</td>";
              echo "<td>{$accounts_veri["email"]}</td>";
              echo "<td>{$role}</td><td>";
              echo "<button class='btn btn-warning btn-specly mt-2 mr-2' type='button'>Düzenle</button>";
              echo "<button class='btn btn-danger btn-specly mt-2 mr-2' type='button'>Sil</button>";
              echo "</td></tr>";
           }
       }
     }
  }

  public function getPermissionName($id){
      $class = new classFonksiyon();
      $user = new Accounts();
      $db = $class->dbConnection();
      $accounts = $db->prepare("SELECT permission FROM accounts WHERE id = ?");
      $accounts->execute(array(
        $id
      ));
      $accounts_fetch = $accounts->fetch();

      $roles = $db->prepare("SELECT * FROM roles WHERE id = ?");
      $roles->execute(array(
        $accounts_fetch["permission"]
      ));
      $roles_fetch = $roles->fetch();
      
      return $roles_fetch["name"];
  }

  public function getName(){
    $class = new classFonksiyon();
    $user = new Accounts();
    $db = $class->dbConnection();
    $accounts = $db->prepare("SELECT firstName,lastName FROM accounts WHERE id = ?");
    $accounts->execute(array(
      $_SESSION["userAccountID"]
    ));
    $accounts_fetch = $accounts->fetch();
    return $accounts_fetch["firstName"]." ".$accounts_fetch["lastName"];
  }

  public function loginAccount(){
    $class = new classFonksiyon();
    $db = $class->dbConnection();
    if($db){
      $email = stripslashes(trim(htmlspecialchars($_POST["email"])));
      $password = md5(stripslashes(trim(htmlspecialchars($_POST["password"]))));
      if(!(!$_POST["password"] || !$email)){
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
          $userDb = $db->prepare("SELECT email,password FROM accounts WHERE email = ? and password = ?");
          $userDb->execute(array(
            $email,
            $password
          ));
          if($userDb->rowCount() != 0){
            $usergetElement = $db->prepare("SELECT id FROM accounts WHERE email = ?");
            $usergetElement->execute(array(
              $email
            ));
            $usergetElementFetch = $usergetElement->fetch();
            $_SESSION["logged"] = true;
            $_SESSION["userAccountID"] = $usergetElementFetch["id"];
            echo '<div class="alert alert-primary" role="alert">Giriş yapıldı. 3 Saniye içerisinde yönlendirileceksiniz.</div>';
            echo '<meta http-equiv="refresh" content="3;URL=index.php">';
          }else{
            if($email=="" or $password==""){
              echo '<div class="alert alert-warning" role="alert">Lütfen boş alan bırakmayınız</div>';
            }else{
              echo '<div class="alert alert-warning" role="alert">E-Posta veya şifreniz yanlış</div>';
             }

          }
        }
      }
    }
  }

  public function getPermission($userid){
    $class = new classFonksiyon();
    $db = $class->dbConnection();
    if($db){
      $usergetElement = $db->prepare("SELECT permission FROM accounts WHERE id = ?");
      $usergetElement->execute(array(
        $userid
      ));
      $usergetElementFetch = $usergetElement->fetch();
      return $usergetElementFetch["permission"];
    }
  }

  public function getLogged(){
    if(isset($_SESSION["logged"])){
        if($this->getPermission($_SESSION["userAccountID"]) > 0){
          return true;
        }else{
          
        }
    }else{
        return false;
    }
  }

  public function logout(){
    if($this->getLogged()){
      session_destroy();
      echo '<meta http-equiv="refresh" content="0;URL=index.php">';
    }else{
      echo '<meta http-equiv="refresh" content="0;URL=login.php">';
    }
}

}

$class = new classFonksiyon();
$user = new Accounts();

if(isset($_POST["registerBtn"])){
  $user->createAccount();
}

if(isset($_POST["loginBtn"])){
  $user->loginAccount();
}