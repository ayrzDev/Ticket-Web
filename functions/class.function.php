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
                  if($page_veri["isDropdown"] == 1){
                  echo "
                  <li class='treeview'>
                  <a href='#'>
                  <i class='{$page_veri["icon"]}'></i> 
                  <span>{$page_veri["name"]}</span></a>";
                    $getElements = $db->prepare("SELECT * FROM pages WHERE dropdown = ?");
                    $getElements->execute(array(
                      $page_veri["id"]
                    ));
                    echo '<ul class="treeview-menu">';
                    foreach ($getElements as $page_element) {
                        // echo $page_element["name"];
                        echo "<li><a href='{$page_element["src"]}'><i class='fa fa-circle-o'></i> {$page_element["name"]}</a></li>";               
                    }
                    echo "</ul></li>";
                  }else{
                    if($page_veri["dropdown"] == 0){
                    echo "<li class='treeview'>";
                    echo "<a href='{$page_veri["src"]}'>";
                    echo "<i class='{$page_veri["icon"]}'></i> <span>{$page_veri["name"]}</span>";
                    echo "</a>";
                    echo "</li>"; 
                    }
                  }
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

    public function getSupports($role){
      $db = $this->dbConnection();
      $user = new Accounts();
      $extra = new extraClass();
      if($db){
      if($user->getPermission($_SESSION["userAccountID"]) != 0){
        if($role != null){
          $supports = $db->prepare("SELECT * FROM supports WHERE status = ?");
          $supports->execute(array(
            $role
          ));
        }else{
          $supports = $db->prepare("SELECT * FROM supports");
          $supports->execute();
        }
        if($supports->rowCount() != 0){
          foreach ($supports as $supports_veri) {
            if($user->getUserDepartment($_SESSION["userAccountID"]) == $supports_veri["department"] || $user->getPermission($_SESSION["userAccountID"]) == 1){
            $message = $extra->kisalt(strip_tags($supports_veri["message"]),30);
            $title = $extra->kisalt($supports_veri['title'],20);
            $name = $user->getName($supports_veri["ownerId"]);
            $stats = array(
              0 => "<p class='text-success bg-success text-center'>Açık</p>",
              1 => "<p class='text-warning bg-warning text-center'>Beklemede</p>",
              2 => "<p class='text-danger bg-danger text-center'>Kapalı</p>",
              3 => "<p class='text-info bg-info text-center'>Yanıtlandı</p>"
            );
            echo "<tr>";  
            echo "<td>{$supports_veri['id']}</td>";
            echo "<td>{$title}</td>";
            echo "<td>{$message}</td>";
            echo "<td>{$extra->kisalt($name,15)}</td>";
            echo "<td>{$stats[$supports_veri["status"]]}</td>";
            echo "<td>";
            if($user->getPermission($_SESSION["userAccountID"]) == 1){
              echo "<a class='btn btn-primary btn-specly mt-2 mr-2' href='support-view.php?id={$supports_veri["id"]}'><i class='fa fa-eye text-light'></i></a>";
              echo "<button class='btn btn-danger btn-specly mt-2 mr-2 deleteBtn' id='{$supports_veri["id"]}' name='delete' type='submit'><i class='fa fa-trash'></i></button>";
            }else{
              echo "<a class='btn btn-primary btn-specly mt-2 mr-2 endBtn' href='support-view.php?id={$supports_veri["id"]}'><i class='fa fa-eye text-light'></i></a>";
            }
            if($supports_veri["status"] == 2){
              echo "<button class='btn btn-success btn-specly mt-2 mr-2 openBtn' id='{$supports_veri["id"]}' name='openBtn' type='button'><i class='fa fa-check text-light'></i></button>";
            }else{
              echo "<button class='btn btn-warning btn-specly mt-2 mr-2 endBtn' id='{$supports_veri["id"]}' name='endBtn' type='button'><i class='fa fa-times-circle text-light'></i></button>";
            }

            echo "</td>";

            echo "</tr>";
          }
          }
        }
      }else{
      }
    }
    }

    public function getSupportDetails(){
      $db = $this->dbConnection();
      $user = new Accounts();
      $extra = new extraClass();
      if($db){
        if(isset($_POST["id"])){
          $supports = $db->prepare("SELECT * FROM supports WHERE id = ?");
          $supports->execute(array(
            $_POST["id"]
          ));
          $supports_data = $db->prepare("SELECT * FROM supportdata WHERE supportId = ?");
          $supports_data->execute(array(
            $_POST["id"]
          ));
        }else{
          $supports = $db->prepare("SELECT * FROM supports WHERE id = ?");
          $supports->execute(array(
            $_GET["id"]
          ));
          $supports_data = $db->prepare("SELECT * FROM supportdata WHERE supportId = ?");
          $supports_data->execute(array(
            $_GET["id"]
          ));
        }
        $support_fetch = $supports->fetch();
        if($user->getUserDepartment($_SESSION["userAccountID"]) == $support_fetch["department"] || $user->getPermission($_SESSION["userAccountID"]) == 1){
         echo '<div class="user-box">
            <img src="/resources/img/user.jpg"  class="user-image" alt="" style="width: 100px;">
            <div class="data">';
         echo "<p>{$support_fetch["date"]}</p>
            </div>";
         echo '<div class="title-user">';
         echo "<h5>{$user->getName($support_fetch["ownerId"])}</h5>";
         echo "<div class='descri-user'>{$support_fetch["message"]}</div>
            </div>
        </div>";
     
        foreach($supports_data as $supportsall){
          echo '<div class="user-box">
          <img src="/resources/img/user.jpg"  class="user-image" alt="" style="width: 100px;">
          <div class="data">';
        echo "<p>{$supportsall["date"]}</p>
            </div>";
        echo '<div class="title-user">';
          if($user->getUserDepartmentName($supportsall["returningPersonId"])){
          $rank = $user->getUserDepartmentName($supportsall["returningPersonId"]);
        }
        echo "<h5>{$user->getName($supportsall["ownerId"])} {$rank}</h5>";
        echo "<div class='descri-user'>{$supportsall["message"]}</div>
            </div>
        </div>";
        }
        }else{
          header("Location: index.php");
          exit;
        }
        
        echo "<div class='box-footer'>
        <div class='input-group'>
        <input class='form-control' name='ticket-message' placeholder='Mesaj yazınız...'>
        <div class='input-group-btn'>";
        if(isset($_POST["id"])){
          echo "<button class='btn btn-success sendMessageTicket' id='{$_POST["id"]}' name='sendMessageTicket'><i class='fa fa-plus'></i></button>";
        }else{
          echo "<button class='btn btn-success sendMessageTicket' id='{$_GET["id"]}' name='sendMessageTicket'><i class='fa fa-plus'></i></button>";
        }
        if($supportsall["status"] == 2){
          echo "<button class='btn btn-success btn-specly mt-2 mr-2 openBtn' id='{$_GET["id"]}' name='openBtn' type='button'><i class='fa fa-check text-light'></i></button>";
        }else{
          echo "<button class='btn btn-warning btn-specly mt-2 mr-2 endBtn' id='{$_GET["id"]}' name='endBtn' type='button'><i class='fa fa-times-circle text-light'></i></button>";
        }

            echo "
        </div>
        </div>
    </div>";
      }
    }

    public function removeSupport(){
      $db = $this->dbConnection();
      $user = new Accounts();
      $extra = new extraClass();
      if($db){
        $remove_prp = $db->prepare("DELETE FROM supports WHERE id = ?");
        $remove_prp->execute(array(
          $_POST["key"]
        ));
        echo "Silindi";
      }
    }

    public function checkSupport($id){
      $db = $this->dbConnection();
      $user = new Accounts();
      $extra = new extraClass();
      if($db){
        $getSupport = $db->prepare("SELECT * FROM supports WHERE id = ?");
        $getSupport->execute(array(
          $id
        ));
        if($getSupport->rowCount() == 0){
          header("Location: index.php");
          exit;
        }
      }
    }

    public function endSupport(){
      $db = $this->dbConnection();
      $user = new Accounts();
      $extra = new extraClass();
      if($db){
        $remove_prp = $db->prepare("UPDATE supports SET status = ? WHERE id = ?");
        $remove_prp->execute(array(
          2,
          $_POST["key"]
        ));
        echo "Sonlandırıldı!";
      }
    }

    public function openSupport(){
      $db = $this->dbConnection();
      $user = new Accounts();
      $extra = new extraClass();
      if($db){
        $remove_prp = $db->prepare("UPDATE supports SET status = ? WHERE id = ?");
        $remove_prp->execute(array(
          0,
          $_POST["key"]
        ));
        echo "Açıldı!";
      }
    }

    public function getDepartments(){
      $db = $this->dbConnection();
      $user = new Accounts();
      $extra = new extraClass();
      if($db){
      if($user->getPermission($_SESSION["userAccountID"]) != 0){
          $departments = $db->prepare("SELECT * FROM departments");
          $departments->execute();
        if($departments->rowCount() != 0){
          foreach ($departments as $departments_veri) {
            echo "<tr>";  
            echo "<td>{$departments_veri['id']}</td>";
            echo "<td>{$departments_veri["name"]}</td>";
          
            echo "<td>";
            if($user->getPermission($_SESSION["userAccountID"]) == 1){
              echo "<a class='btn btn-primary btn-specly mt-2 mr-2' href='support-view.php?id={$departments_veri["id"]}'><i class='fa fa-eye text-light'></i></a>";
              echo "<button class='btn btn-danger btn-specly mt-2 mr-2 deleteBtn' id='{$departments_veri["id"]}' name='delete' type='submit'><i class='fa fa-trash'></i></button>";
            }else{
              echo "<a class='btn btn-primary btn-specly mt-2 mr-2 endBtn' href='support-view.php?id={$departments_veri["id"]}'><i class='fa fa-eye text-light'></i></a>";
            }
            echo "</td>";

            echo "</tr>";

          }
        }
      }else{

      }
    }
    }

    public function sendMessageTicket(){
      $db = $this->dbConnection();
      $user = new Accounts();
      $extra = new extraClass();
      if($db){
        $id = $_POST["key"];
        $replyer = $_SESSION["userAccountID"];
        $support = $db->prepare("SELECT ownerId FROM supports WHERE id = ?");
        $support->execute(array(
          $id
        ));
        $support_fetch = $support->fetch();
        $owner = $support_fetch["ownerId"];
        $messageSend = $db->prepare("INSERT INTO supportdata SET supportId = ?,ownerId = ?, returningPersonId = ? , message = ?");
        $messageSend->execute(array(
          $id,
          $owner,
          $replyer,
          $_POST["message"]
        ));
      }
    }

    
}