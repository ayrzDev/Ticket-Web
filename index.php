<?php
include("class.function.php");
?>
<html lang="tr">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gappze - Ana Sayfa</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous">
  </script>
  <link rel="stylesheet" href="apps/css/style.css">
</head>

<body class="overflox">

  <div class="navcontainer">
    <?php
      include("apps/includes/navbar.php");
    ?>
  </div>
  <div class='code'>
    <header class='content'>
      <h1 class='title'>Gappze Destek Sistemi</h1>
      <div class='text'>En güncel sistemlerle yapılan destek sistemimiz ile anında yanıt alın.</div>
    </header>

    <div class='wave'></div>
    <div class='wave wave2'></div>
    <div class='wave wave3'></div>
  </div>

</body>
<script src="apps/js/script.js"></script>
<script src="https://cdn.ckeditor.com/4.19.1/standard/ckeditor.js"></script>
<script src="apps/js/ckeditor.js"></script>

</html>