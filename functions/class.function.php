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
                        if($page_element["permission"] == $permission){
                        echo "<li><a href='{$page_element["src"]}'><i class='fa fa-circle-o'></i> {$page_element["name"]}</a></li>";         
                        }
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
      echo "<meta http-equiv='refresh' content='1;URL=mysupport.php'>";
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
              3 => "<p class='text-info bg-info text-center'>Yanıtlandı</p>",
              4 => "<p class='text-info bg-info text-center'>Cevaplandı</p>"
            );
            echo "<tr>";  
            echo "<td>{$supports_veri['id']}</td>";
            echo "<td>{$title}</td>";
            echo "<td>{$message}</td>";
            echo "<td>{$extra->kisalt($name[0]." ".$name[1],15)}</td>";
            echo "<td>{$stats[$supports_veri["status"]]}</td>";
            echo "<td>";
            if($user->getPermission($_SESSION["userAccountID"]) == 1){
              echo "<a class='btn btn-primary btn-specly mt-2 mr-2' href='support-view.php?id={$supports_veri["id"]}'><i class='fa fa-eye text-light'></i></a>";
              echo "<button class='btn btn-danger btn-specly mt-2 mr-2 deleteBtn' id='{$supports_veri["id"]}' name='delete' type='submit'><i class='fa fa-trash'></i></button>";
            }else{
              echo "<a class='btn btn-primary btn-specly mt-2 mr-2' href='support-view.php?id={$supports_veri["id"]}'><i class='fa fa-eye text-light'></i></a>";
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
        header("Location: /");
        exit;
      }
    }
    }

    public function getUserSupports(){
      $db = $this->dbConnection();
      $user = new Accounts();
      $extra = new extraClass();
      if($db){
        $getSupports = $db->prepare("SELECT * FROM supports WHERE ownerId = ?");
        $getSupports->execute(array(
          $_SESSION["userAccountID"]
        ));
        if($getSupports->rowCount() != 0){
          $stats = array(
            0 => "<p class='px-4 text-light bg-success text-center rounded-pill'>Açık</p>",
            1 => "<p class='px-4 text-light bg-warning text-center rounded-pill'>Beklemede</p>",
            2 => "<p class='px-4 text-light bg-danger text-center rounded-pill'>Kapalı</p>",
            3 => "<p class='px-4 text-light bg-info text-center rounded-pill'>Yanıtlandı</p>",
            4 => "<p class='px-4 text-light bg-info text-center rounded-pill'>Cevaplandı</p>"
          );
          foreach($getSupports as $getSupport){
            $departmenQuery = $db->prepare("SELECT * FROM departments WHERE id = ?");
            $departmenQuery->execute(array(
              $getSupport["department"]
            ));
            $departmenQuery_fetch = $departmenQuery->fetch();
            $departments = $departmenQuery_fetch["name"];
            echo '<tr class="ticket-bg my-1">';
            echo "<th scope='row'>{$getSupport["id"]}</th>";
            echo "
            <td>{$getSupport["title"]}</td>
            <td>{$departments}</td>
            <td>{$getSupport["date"]}</td>
            <td>{$stats[$getSupport["status"]]}</td>
            <td>";
            echo "<a href='support.php?id={$getSupport["id"]}' class='btn mx-1 btn-primary btn-specly mt-2 mr-2' id='{$getSupport["id"]}' name='delete' type='submit'><i class='bi-eye'></i></a>";
            echo "<button class='btn mx-1 btn-danger btn-specly mt-2 mr-2 deleteSupport' id='{$getSupport["id"]}' name='deleteSupport' type='submit'><i class='bi-trash'></i></button>";
            echo "</td></tr>";
          }
        }
      }
    }

    public function getUserSupportDetails(){
      $db = $this->dbConnection();
      $user = new Accounts();
      $extra = new extraClass();
      if($db){

        if(isset($_POST["id"])){

        $userSupports = $db->prepare("SELECT * FROM supports WHERE id = ?");
        $userSupports->execute(array(
          $_POST["id"]
        ));
        $getAllMessageSupport = $db->prepare("SELECT * FROM supportdata where supportId = ?"); 
        $getAllMessageSupport->execute(array(
          $_POST["id"]
        ));
        $support_fetch = $userSupports->fetch();

        }else{
        $userSupports = $db->prepare("SELECT * FROM supports WHERE id = ?");
        $userSupports->execute(array(
          $_GET["id"]
        ));
        $getAllMessageSupport = $db->prepare("SELECT * FROM supportdata where supportId = ?"); 
        $getAllMessageSupport->execute(array(
          $_GET["id"]
        ));
        $support_fetch = $userSupports->fetch();
      }
      
        $username = $user->getName($support_fetch["ownerId"]);
        echo "<div class='p-3 mx-5 text-end justify-content-start message-area'>
        <div class='my-2'> <img src='/resources/img/user.jpg' class='rounded-3  bg-light p-1' width='50px' > </div>

        <div class='titles'>
            <h5>{$username[0]} {$username[1]}</h5>
        </div>";
        echo "<div class='msg'>
            <p>{$support_fetch["message"]}</p>
        </div>
      </div>";
      foreach($getAllMessageSupport as $messages){
          if($messages["returningPersonId"] == 0){
          echo "<div class='p-3 mx-5 text-end message-area'>
          <div class='my-2'> <img src='/resources/img/user.jpg' class='rounded-3  bg-light p-1' width='50px' > </div>

            <div class='titles'>
                <h5>{$username[0]} {$username[1]}</h5>
            </div>";
            echo "<div class='msg'>
                <p>{$messages["message"]}</p>
            </div>
          </div>";
        }else{
          if($messages["ownerId"])
            $adminname = $user->getName($messages["returningPersonId"]);

          echo "<div class='p-3 mx-5 text-start justify-content-start message-area'>
          <div class='my-2 p-2'> <img src='/resources/img/admin.png' class='rounded-3 bg-dark p-1' width='60px' > </div>

          <div class='titles'>
              <h5>{$adminname[0]} {$adminname[1]} - {$user->getUserDepartmentName($messages["returningPersonId"])}</h5>
          </div>";
          echo "<div class='msg'>
              <p>{$messages["message"]}</p>
          </div>
        </div>";
        
        
        }
        if(isset($_POST["id"])){
          echo "<input type='hidden' class='root' name='root' id='{$_POST["id"]}'>";
        }else{
        echo "<input type='hidden' class='root' name='root' id='{$_GET["id"]}'>";
        }
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
        $username = $user->getName($support_fetch["ownerId"]);
        if($user->getUserDepartment($_SESSION["userAccountID"]) == $support_fetch["department"] || $user->getPermission($_SESSION["userAccountID"]) == 1){
         echo '<div class="user-box">
            <img src="/resources/img/user.jpg"  class="user-image" alt="" style="width: 100px;">
            <div class="data">';
         echo "<p>{$support_fetch["date"]}</p>
            </div>";
         echo '<div class="title-user">';
         echo "<h5>{$username[0]} {$username[1]}</h5>";
         echo "<div class='descri-user'>{$support_fetch["message"]}</div>
            </div>
        </div>";
     
        foreach($supports_data as $supportsall){
          if($supportsall["returningPersonId"] != 0){
          echo '<div class="user-box align-end">
          <img src="/resources/img/user.jpg"  class="user-image user-picture img-circle" alt="" style="width: 100px;">
          <div class="data">';
        echo "<p>{$supportsall["date"]}</p>
            </div>";
        echo '<div class="title-user">';
          $rank = $user->getUserDepartmentName($supportsall["returningPersonId"]);
          $name = $user->getName($supportsall["returningPersonId"]);
          echo "<h5>{$name[0]} {$name[1]} - ({$rank})</h5>";
        }else{
          echo '<div class="user-box text-end">
          <img src="/resources/img/user.jpg"  class="user-image user-picture img-circle" alt="" style="width: 100px;">
          <div class="data">';
        echo "<p>{$supportsall["date"]}</p>
            </div>";
        echo '<div class="title-user">';
          echo "<h5>{$username[0]} {$username[1]}</h5>";
        }
        echo "<div class='descri-user'>{$supportsall["message"]}</div>
            </div>
        </div>";
        }
        }else{
          // header("Location: index.php");
          // exit;
        }
        
    if(isset($_POST["id"])){
      echo "<input type='hidden' class='root' name='root' id='{$_POST["id"]}'>";
    }else{
    echo "<input type='hidden' class='root' name='root' id='{$_GET["id"]}'>";
    }
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
        if($_POST["message"] != null){
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

        $support = $db->prepare("UPDATE supports SET status = ? WHERE id = ?");
        $support->execute(array(
          3,
          $id
        ));
        echo "Mesaj gönderildi";  
      }else{
        echo "Lütfen boşluğu doldurunuz";
      }
    }
    }

    public function sendMessage(){
      $db = $this->dbConnection();
      $user = new Accounts();
      $extra = new extraClass();
      if($db){
        $id = $_POST["key"];
        $replyer = $_SESSION["userAccountID"];
        $support = $db->prepare("SELECT ownerId,status FROM supports WHERE id = ?");
        $support->execute(array(
          $id
        ));
        $support_fetch = $support->fetch();
        if($support_fetch["status"] == 2){
          echo "Bu talep sonlandırılmış mesaj iletemezsiniz!";
        }else{
        if($_POST["message"] != null){
        $message = htmlentities($_POST["message"], ENT_QUOTES, "UTF-8");

        $owner = $support_fetch["ownerId"];
        $messageSend = $db->prepare("INSERT INTO supportdata SET supportId = ?,ownerId = ?, message = ?");
        $messageSend->execute(array(
          $id,
          $owner,
          $message
        ));

        $support = $db->prepare("UPDATE supports SET status = ? WHERE id = ?");
        $support->execute(array(
          1,
          $id
        ));      
      }else{
        echo "Lütfen boşluğu doldurunuz";
      }
    }
    }
    }

    public function getSupportTitle(){
      $db = $this->dbConnection();
      $user = new Accounts();
      $extra = new extraClass();
      if($db){
        $getTitle = $db->prepare("SELECT title FROM supports WHERE id = ?");
        $getTitle->execute(array(
          $_GET["id"]
        ));
        $getTitle_fetch = $getTitle->fetch();
        echo $getTitle_fetch["title"];
      }
    }

    public function getSupportDate(){
      $db = $this->dbConnection();
      $user = new Accounts();
      $extra = new extraClass();
      if($db){
        $getTitle = $db->prepare("SELECT date FROM supports WHERE id = ?");
        $getTitle->execute(array(
          $_GET["id"]
        ));
        $getTitle_fetch = $getTitle->fetch();
        echo $getTitle_fetch["date"];
      }
    }

    public function getButtons(){
      $db = $this->dbConnection();
      $user = new Accounts();
      $extra = new extraClass();
      $supports = $db->prepare("SELECT * FROM supports WHERE id = ?");
      $supports->execute(array(
          $_GET["id"]
      ));
      $support_fetch = $supports->fetch();

      if($support_fetch["status"] == 2){
          echo "<button class='btn btn-success mt-2 mr-2 openBtn' id='{$_GET["id"]}' name='openBtn' type='button'><i class='fa fa-check text-light'></i></button>";
      }else{
          echo "<button class='btn btn-warning mt-2 mr-2 endBtn' id='{$_GET["id"]}' name='endBtn' type='button'><i class='fa fa-times-circle text-light'></i></button>";
      }
    }

    public function updateDepartman(){
      $db = $this->dbConnection();
      $user = new Accounts();
      $extra = new extraClass();
      if($db){
        $getSupport = $db->prepare("UPDATE supports SET department = ? WHERE id = ?");
        $getSupport->execute(array(
          $_POST["departments"],
          $_POST["id"]
        ));
        echo "Güncellendi";
        echo "<meta http-equiv='refresh' content='3;URL=index.php'>";
      }
    }
    
    public function addDepartment(){
      $db = $this->dbConnection();
      $user = new Accounts();
      $extra = new extraClass();
      if($db){
        if($_POST["department"] != null){
        $getSupport = $db->prepare("INSERT INTO departments SET name = ?");
        $getSupport->execute(array(
          $_POST["department"]
        ));
      
        echo "Eklendi";
        echo "<meta http-equiv='refresh' content='3;URL=index.php'>";
      }else{
        echo "Boş alan bırakmayınız";
      }
      }
    }
}