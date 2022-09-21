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
    $db = $class->dbConnection();
    $accounts = $db->prepare("SELECT * FROM accounts");
    $accountFetch = $accounts->fetch();
    while($accounts->rowCount() >= 1){
      echo "a";
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
          if($userDb->rowCount() == 0){
            echo '<div class="alert alert-danger" role="alert">Böyle bir hesap mevcut değil.</div>';
          }else{
            echo '<div class="alert alert-primary" role="alert">Giriş yapıldı. 3 Saniye içerisinde yönlendirileceksiniz.</div>';
            echo '<meta http-equiv="refresh" content="3;URL=index.php">';
          }
        }
      }
    }
  }

  public function getLogged(){
    if(isset($_SESSION["logged"])){
      return false;
    }else{
      return true;
    }
  }

  public function isLogged(){
    if((isset($_SESSION["logged"]))){
      echo '<meta http-equiv="refresh" content="0;URL=index.php">';
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

$user->isLogged();