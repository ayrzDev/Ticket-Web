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
        $role_add = $db->prepare("INSERT INTO roles SET name = ?,slot = ?");
        $role_add->execute(array(
          $name,
          $role_add->rowCount() - 1
        ));
        echo "Eklendi";
      }
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

  public function getUserCount(){
    $class = new classFonksiyon();
    $user = new Accounts();
    $db = $class->dbConnection();
  
    $roles = $db->prepare("SELECT * FROM accounts");
    $roles->execute();
    return $roles->rowCount();
  }

  public function getAllRoles(){
    $class = new classFonksiyon();
    $user = new Accounts();
    $db = $class->dbConnection();
    if($db){

    $roles = $db->prepare("SELECT * FROM roles");
    $roles->execute();
    $roles_fetch = $roles->fetch();
    if($roles->rowCount() != 0){
      foreach ($roles as $roles_veri) {
        echo "<tr>";
        echo "<td>{$roles_veri["slot"]}</td>";
        echo "<td>{$roles_veri["name"]}</td>";
        echo "<input type='hidden' value='{$roles_veri["id"]}' >";
        echo "<td><input class='btn btn-warning btn-specly mt-2 mr-2 role_edit' type='submit' value'Düzenle'></input>";
        echo "<input class='btn btn-danger btn-specly mt-2 mr-2 role_delete' type='submit' value='Sil'></input>";
        echo "</td></tr>";
        echo "</tr>";
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

      $roles = $db->prepare("SELECT * FROM roles WHERE slot = ?");
      $roles->execute(array(
        $accounts_fetch["permission"]
      ));
      $roles_fetch = $roles->fetch();
      
      if($accounts->rowCount() != 0){
        return $roles_fetch["name"];
      }else{
        return false;
      }
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
    if($accounts->rowCount() != 0){
    return $accounts_fetch["firstName"]." ".$accounts_fetch["lastName"];
    }
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
  }//Login End

  public function getPermission($userid){
    $class = new classFonksiyon();
    $db = $class->dbConnection();
    if($db){
      $usergetElement = $db->prepare("SELECT permission FROM accounts WHERE id = ?");
      $usergetElement->execute(array(
        $userid
      ));
      $usergetElementFetch = $usergetElement->fetch();
      if($usergetElement->rowCount() != 0){
        return $usergetElementFetch["permission"];
      }
    }
  }//getPermission End

  public function getLogged(){
    if(isset($_SESSION["logged"])){
          return true;
    }else{
        return false;
    }
  }//getLogged End

  public function getLoggedMod(){
    if($this->getLogged()){
      if($this->getPermission($_SESSION["userAccountID"]) > 0){
        return true;
      }else{
        return false;
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
}//AccountClass End

$class = new classFonksiyon();
$user = new Accounts();

if(isset($_POST["registerBtn"])){
  $user->createAccount();
}

if(isset($_POST["loginBtn"])){
  $user->loginAccount();
}

if(isset($_POST["roleAdd"])){
  $class->roleAdd();
}