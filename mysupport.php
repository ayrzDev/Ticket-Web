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
</head>

<body>
    <div class="navcontainer">
    <?php
      include("pages/navbar.php");
    ?>
        </div>
    <div class="defaultheader">
        <div class="title">
            <h1>Destek Taleplerim</h1>
        </div>
        <div class="description">
            <p>Burdan taleplerinize bakabilirsiniz..</p>
        </div>
    </div>
    <div class="mysupports container mt-5 mb-5">
        <table class="table" border="0">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Konu</th>
                    <th scope="col">Tarih</th>
                    <th scope="col" style="width: 100px;">Durum</th>
                    <th scope="col">İşlem</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $class->getUserSupports();
                ?>
            </tbody>
        </table>
    </div>
</body>
<script src="resources/js/script.js"></script>

</html>