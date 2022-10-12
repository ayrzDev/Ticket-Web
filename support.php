<?php
require_once($_SERVER['DOCUMENT_ROOT']."/functions/functionBase.php");
if(!($user->getLogged())){
    header("location: ../index.php");
    exit;
}
?>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gappze - Desteklerim</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="resources/css/mainthemes.css">
    <link href="http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
</head>

<body>
    <div class="navcontainer">
    <?php
      include("pages/navbar.php");
    ?>
        </div>
    <div class="defaultheader">
        <div class="title">
            <h1>Destek #<?=$_GET["id"]?></h1>
        </div>
        <div class="description">
            <p>Konu: <?php $class->getSupportTitle() ?> <br> Tarih: <?php $class->getSupportDate() ?></p>
        </div>
    </div>
    <div class="supports-card container mt-5 mb-5" id="supports-card">
        <div id="callback"></div>
        <a href="mysupport.php" class="btn btn-outline-success" type="submit">Geri Dön</a>
        <div class="messages-box">
            <?php
            $class->getUserSupportDetails();
            ?>
        </div>
        <div class="box-footer mb-2 p-2">
        <div class="input-group">
        <input class="form-control" name="ticket-message" placeholder="Mesaj yazınız...">
        <div class="input-group-btn">
            <button class="btn btn-success sendMessage" id="<?= $_GET["id"] ?>" name="sendMessage"><i class="bi-plus"></i></button>
        </div>
        </div>
    </div>
    </div>
</body>
<script src="resources/js/script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.js"></script>

<script src="resources/js/core.js"></script>

</html>