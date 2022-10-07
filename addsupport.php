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
    <title>Gappze - Destek Oluştur</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

    <link rel="stylesheet" href="resources/css/mainthemes.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.js"></script>
    <script src="resources/js/core.js"></script>
</head>

<body>
    <div class="navcontainer">
        <?php include("pages/navbar.php"); ?>
    </div>
    <div class="defaultheader">
        <div class="title">
            <h1>Destek Oluştur</h1>
        </div>
        <div class="description">
            <p>Burdan bizlere destek talebi açabilirsiniz.</p>
        </div>
    </div>
    <div class="d-flex justify-content-center container mt-5 mb-5">
        <div class="addsupport">
            <div class="process" id="process"></div>
            <div class="form-floating mb-2"">
                <input type=" email" class="form-control" id="floatingInputValue" value="<?= $user->getName($_SESSION["userAccountID"]) ?>" disabled>
                <label for="floatingInputValue">Adınız:</label>
            </div>
            <div class="form-floating mb-2"">
                <input type=" email" class="form-control" id="floatingInputValue" value="<?= $user->getEmail() ?>" disabled>
                <label for="floatingInputValue">E-Posta Adresiniz:</label>
            </div>
            <div class="form-floating mb-2">
                <input type="text" class="form-control" id="floatingInputValue" name="title">
                <label for="floatingInputValue">Konu başlığı:</label>
            </div>
            <div class="form-floating mb-2">
                <select class="form-select" id="floatingSelect" name="departments" aria-label="Floating label select example">
                    <option selected value="0">Departman Seçiniz</option>
                    <?= $user->getDepartments(); ?>
                </select>
                <label for="floatingSelect">Departman:</label>
            </div>
            <div class="form-floating mb-2">
                <textarea name="editor1" require></textarea>
            </div>
            <div class="form-floating mb-2">

            </div>
            <div class="form-floating mb-2 text-center d-flex justify-content-center">
                <input type="submit" class="btn btn-secondary mb-3 supportadd" name="supportadd" value="Gönder"></input>
            </div>
        </div>
    </div>
</body>
<script src="resources/js/script.js"></script>
<script src="resources/ckeditor/ckeditor.js"></script>
<script src="resources/js/ckeditor.js"></script>

</html>