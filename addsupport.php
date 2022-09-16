<?php
require_once("class.function.php");
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

    <link rel="stylesheet" href="apps/css/mainthemes.css">
</head>

<body>
    <div class="navcontainer">
        <?php include("apps/includes/navbar.php"); ?>
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
            <form class="form-floating mb-2"">
                <input type=" email" class="form-control" id="floatingInputValue" value="test@example.com" disabled>
                <label for="floatingInputValue">E-Posta Adresiniz:</label>
            </form>
            <div class="form-floating mb-2">
                <input type="text" class="form-control" id="floatingInputValue" value="Deneme">
                <label for="floatingInputValue">Konu başlığı:</label>
            </div>
            <div class="form-floating mb-2">
                <select class="form-select" id="floatingSelect" aria-label="Floating label select example">
                    <option selected>Departman Seçiniz</option>
                    <option value="1">Destek Ekibi</option>
                    <option value="2">Teknik Destek</option>
                </select>
                <label for="floatingSelect">Departman:</label>
            </div>
            <div class="form-floating mb-2">
                <textarea name="editor1"></textarea>
            </div>
            <div class="form-floating mb-2">

            </div>
            <div class="form-floating mb-2 text-center d-flex justify-content-center">
                <button type="submit" class="btn btn-secondary mb-3 ">Gönder</button>
            </div>
        </div>
    </div>
</body>
<script src="apps/js/script.js"></script>
<script src="apps/ckeditor/ckeditor.js"></script>
<script src="apps/js/ckeditor.js"></script>

</html>