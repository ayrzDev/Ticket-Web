<?php

session_start();

//Bütün fonksiyon dosyaları burada ekleniyor.

require_once("account.function.php");
require_once("class.function.php");
require_once("extra.function.php");


//Yönlendirme post kontrol

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

if(isset($_POST["supportadd"])){
  $class->supportAdd();
}

if(isset($_POST["deleteSupport"])){
  $class->removeSupport();
}

if(isset($_POST["endSupport"])){
  $class->endSupport();
}

if(isset($_POST["openSupport"])){
  $class->openSupport();
}

if(isset($_POST["sendMessageTicket"])){
  $class->sendMessageTicket();
}

if(isset($_POST["yenile"])){
  $class->getSupports($_POST["frame"]);
}

if(isset($_POST["supportyenile"])){
  $class->getSupportDetails();
}

if(isset($_POST["usersupportyenile"])){
  $class->getUserSupportDetails();
}
if(isset($_POST["sendMessage"])){
  $class->sendMessage();
}

if(isset($_POST["updateDepartman"])){
  $class->updateDepartman();
}

if(isset($_POST["addDepartman"])){
  $class->addDepartment();
}

if(isset($_POST["userDelete"])){
  $user->userDelete();
}

if(isset($_POST["supportDataYenile"])){
  $class->getUserSupports();
}

if(isset($_POST["updateAccount"])){
  $user->updateAccount();
}



?>