<?php

require_once("functionBase.php");

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
              $departmenQuery = $db->prepare("SELECT * FROM departments WHERE id = ?");
              $departmenQuery->execute(array(
                $accounts_veri["department"]
              ));
              $departmenQuery_fetch = $departmenQuery->fetch();
              if($accounts_veri["department"] == 0){
                $departments = "";
              }else{
               $departments = $departmenQuery_fetch["name"];
              }
              echo "<tr>";
              echo "<td>{$accounts_veri["id"]}</td>";
              echo "<td>{$accounts_veri["firstName"]}</td>";
              echo "<td>{$accounts_veri["lastName"]}</td>";
              echo "<td>{$accounts_veri["email"]}</td>";
              echo "<td>{$role}</td>";
              echo "<td>{$departments}</td><td>";
              echo "<a href='account-edit.php?id={$accounts_veri["id"]}' class='btn btn-warning btn-specly mt-2 mr-2' type='button'>Düzenle</a>";
              echo "<button class='btn btn-danger btn-specly mt-2 mr-2 usersil' id='{$accounts_veri["id"]}' name='usersil' type='button'>Sil</button>";
              echo "</td></tr>";
           }
       }
     }
  }
 
  public function getUserCount(){
    $class = new classFonksiyon();
    $user = new Accounts();
    $db = $class->dbConnection();
    if($db){
      $roles = $db->prepare("SELECT * FROM accounts");
      $roles->execute();
      return $roles->rowCount();
    }
  }

  public function getTicketCount($number){
    $class = new classFonksiyon();
    $user = new Accounts();
    $db = $class->dbConnection();
  
    $roles = $db->prepare("SELECT * FROM supports WHERE status = ?");
    $roles->execute(array(
      $number
    ));
    return $roles->rowCount();
  }

  public function getAllRoles(){
    $class = new classFonksiyon();
    $user = new Accounts();
    $db = $class->dbConnection();
    if($db){

    $roles = $db->prepare("SELECT * FROM roles");
    $roles->execute();
    if($roles->rowCount() != 0){
      foreach ($roles as $roles_veri) {
        echo "<tr>";
        echo "<td>{$roles_veri["id"]}</td>";
        echo "<td>{$roles_veri["name"]}</td>";
        echo "<input type='hidden' value='{$roles_veri["id"]}' >";
        echo "<td>";
        echo "<input class='btn btn-warning btn-specly mt-2 mr-2 role_edit' type='submit' value='Düzenle'></input>";
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

      $roles = $db->prepare("SELECT * FROM roles WHERE id = ?");
      $roles->execute(array(
        $accounts_fetch["permission"]
      ));
      $roles_fetch = $roles->fetch();
      
      if($accounts->rowCount() != 0){
        if($roles_fetch == 0){
          return "Üye";
        }else{
        return $roles_fetch["name"];
        }
      }else{
        return false;
      }
  }

  public function getName($id){
    $class = new classFonksiyon();
    $user = new Accounts();
    $db = $class->dbConnection();
    $accounts = $db->prepare("SELECT firstName,lastName,email FROM accounts WHERE id = ?");
    $accounts->execute(array(
      $id
    ));
    $accounts_fetch = $accounts->fetch();
    if($accounts->rowCount() != 0){
      $names = array(
        0 => $accounts_fetch["firstName"],
        1 => $accounts_fetch["lastName"],
        2 => $accounts_fetch["email"]
      );
    return $names;
    }
  }

  public function getEmail(){
    $class = new classFonksiyon();
    $user = new Accounts();
    $db = $class->dbConnection();
    $accounts = $db->prepare("SELECT email FROM accounts WHERE id = ?");
    $accounts->execute(array(
      $_SESSION["userAccountID"]
    ));
    $accounts_fetch = $accounts->fetch();
    if($accounts->rowCount() != 0){
    return $accounts_fetch["email"];
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

  public function getUserDepartmentName($id){
    $class = new classFonksiyon();
    $user = new Accounts();
    $db = $class->dbConnection();
    if($db){
      $accounts = $db->prepare("SELECT department FROM accounts WHERE id = ?");
      $accounts->execute(array(
        $id
      ));
      if($accounts->rowCount() != 0){
        $accounts_fetch = $accounts->fetch();
        $departmen = $accounts_fetch["department"];
        $departmen_name_select = $db->prepare("SELECT name FROM departments WHERE id = ?");
        $departmen_name_select->execute(array(
          $departmen
        ));
        if($departmen_name_select->rowCount() != 0){
          $departmen_name = $departmen_name_select->fetch();
          return $departmen_name["name"]; 
        }
      }else{
        return "Tanımlanmamış";
      }
    }
  }

  public function getUserDepartment($id){
    $class = new classFonksiyon();
    $user = new Accounts();
    $db = $class->dbConnection();
    if($db){
      $accounts = $db->prepare("SELECT department FROM accounts WHERE id = ?");
      $accounts->execute(array(
        $id
      ));
      $accounts_fetch = $accounts->fetch();
      if($accounts->rowCount() != 0){
        $departmen = $accounts_fetch["department"];
          return $departmen; 
      }else{
        return "Tanımlanmamış";
      }
    }
  }

  public function getSupportDepartment($id){
    $class = new classFonksiyon();
    $user = new Accounts();
    $db = $class->dbConnection();
    if($db){
      $department = $db->prepare("SELECT department FROM supports WHERE id = ?");
      $department->execute(array(
        $id
      ));
      $departmentGet = $department->fetch();
      
      $accounts = $db->prepare("SELECT name FROM departments WHERE id = ?");
      $accounts->execute(array(
        $departmentGet["department"]
      ));
      $accounts_fetch = $accounts->fetch();
      if($accounts->rowCount() != 0){
        $departmen = $accounts_fetch["name"];
          return $departmen; 
      }else{
        return "Tanımlanmamış";
      }
    }
  }



  public function getDepartments(){
    $class = new classFonksiyon();
    $user = new Accounts();
    $db = $class->dbConnection();
     if($db){
        $departments = $db->prepare("SELECT * FROM departments");
        $departments->execute();
        if($departments->rowCount() != 0){
          foreach ($departments as $departments_veri) {
            echo "<option value='{$departments_veri['id']}'>{$departments_veri['name']}</option>";
          }
        }
      }
  }

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

  public function userDelete(){
    $class = new classFonksiyon();
    $db = $class->dbConnection();
    if($db){
     if(isset($_POST["id"])){
       $id = $_POST["id"];
       $removeUser = $db->prepare("DELETE FROM accounts WHERE id = ?");
       $removeUser->execute(array(
        $id
       ));
       echo "Silindi.";
     }
    }
  }

  public function updateAccount(){
    $class = new classFonksiyon();
    $db = $class->dbConnection();
    if($db){
     if(isset($_POST["id"])){
      if( $_POST["name"] != null && $_POST["surname"] != null && $_POST["email"] != null && $_POST["permission"] != null && $_POST["department"] != null){
       $id = $_POST["id"];
       $removeUser = $db->prepare("UPDATE accounts SET firstName = ?,lastName = ?, email = ? , permission = ? ,department = ?  WHERE id = ?");
       $removeUser->execute(array(
        $_POST["name"],
        $_POST["surname"],
        $_POST["email"],
        $_POST["permission"],
        $_POST["department"],
        $id
       ));
       echo "Düzenlendi.";
     }else{
      echo "Boş alan bırakma";
     }
    }
    }
  }
}//AccountClass End