<?php
require_once("class.function.php");
?>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.css" rel="stylesheet" />

    <link rel="stylesheet" href="apps/css/style.css">
</head>

<body>
    <div class="navcontainer">
        <div class="d-flex simplenavbar text-center justify-content-center">
            <img class="rounded"
                src="https://media-exp1.licdn.com/dms/image/C4E0BAQH-7IWMa2U8yg/company-logo_200_200/0/1636639926141?e=2147483647&v=beta&t=bHVWBfjr9hmEOvHFKZK0AcImZCsddan92MB_l0CYZJc"
                alt="" width="100px">
            <a href="" class="navelement">Ana Sayfa</a>
            <a href="mysupport.php" class="navelement">Destek Taleplerim</a>
            <a href="" class="navelement btn-orange">Yeni Destek Talebi Aç</a>
        </div>
    </div>
    <div class="container mt-5 mb-5">
        <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
            <h1 class="text-center fw-bold mb-3">Resimlerimiz</h1>
            <div class="carousel-inner rounded">
                <div class="carousel-item active">
                    <img src="https://images8.alphacoders.com/118/1186452.jpg" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="https://images8.alphacoders.com/118/1186452.jpg" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="https://images8.alphacoders.com/118/1186452.jpg" class="d-block w-100" alt="...">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
</body>
<script src="apps/js/script.js"></script>

</html>