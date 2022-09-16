<?php
require_once("class.function.php");
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
    <link rel="stylesheet" href="apps/css/mainthemes.css">
</head>

<body>
    <div class="navcontainer">
        <?php include("apps/includes/navbar.php"); ?>
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
                    <th scope="col">Oluşturan</th>
                    <th scope="col">Tarih</th>
                    <th scope="col">Durum</th>
                    <th scope="col">İşlem</th>
                </tr>
            </thead>
            <tbody>
                <tr class="ticket-bg my-1">
                    <th scope="row">1</th>
                    <td>Deneme</td>
                    <td>Ahmet</td>
                    <td>16 Ocak 2022</td>
                    <td>Yanıtlandı</td>
                    <td>Sil Değiştir</td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
<script src="apps/js/script.js"></script>

</html>