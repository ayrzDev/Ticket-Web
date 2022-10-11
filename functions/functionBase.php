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

?>