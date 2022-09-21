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
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.js"></script>
    <script src="apps/js/core.js"></script>
</head>

<body>
    
    <body class="text-center">
        
        <main class="form-signin w-100 m-auto">
           <a href="index.php">
           <img class="rounded my-4"
            src="https://media-exp1.licdn.com/dms/image/C4E0BAQH-7IWMa2U8yg/company-logo_200_200/0/1636639926141?e=2147483647&v=beta&t=bHVWBfjr9hmEOvHFKZK0AcImZCsddan92MB_l0CYZJc"
            alt="" width="70px">
           </a>
            <h1 class="h3 mb-3 fw-normal">Kaydınızı Oluşturarak Maceraya Katılın!</h1>
            <div class="process"></div>
            <div class="form-floating my-2">
                <input type="text" class="form-control" id="floatingInput" name="registerFirstname" placeholder="Ahmet">
                <label for="floatingInput" require>Adınız</label>
                <p class="nameErr"></p>
            </div>
            <div class="form-floating my-2">
                <input type="text" class="form-control" id="floatingInput" name="registerLastname" placeholder="Doğru">
                <label for="floatingInput" require>Soyadınız</label>
                <p class="lastnameErr"></p>
            </div>
            <div class="form-floating my-2">
                <input type="email" class="form-control" id="floatingInput" name="registerEmail"
                placeholder="example@gmail.com">
                <label for="floatingInput" require>E-Posta Adresiniz</label>
                <p class="emailErr"></p>
            </div>
            <div class="form-floating my-2">
                <input type="password" class="form-control" id="floatingPassword" name="registerPassword"
                    placeholder="Password" require>
                <label for="floatingPassword">Password</label>
                <p class="passErr"></p>
            </div>
            <p class="my-2">Zaten bir hesabınız var ise <a class="text-decoration-none text-warning" href="login.php">Giriş Yap</a></p>
            <input class="w-100 btn btn-lg btn-primary registerButton" type="submit"
                name="registerButton"></input>
            <p class="mt-5 mb-3 text-muted">© 2017–2022</p>
        </main>
    </body>
</body>

</html>