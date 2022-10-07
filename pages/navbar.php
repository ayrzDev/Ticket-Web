<nav class="navbar navbar-expand-lg fixed-top navbar-bg">
    <div class="container">
        <a class="navbar-brand" href="./index.php">
            <img class="rounded"
                src="https://media-exp1.licdn.com/dms/image/C4E0BAQH-7IWMa2U8yg/company-logo_200_200/0/1636639926141?e=2147483647&v=beta&t=bHVWBfjr9hmEOvHFKZK0AcImZCsddan92MB_l0CYZJc"
                alt="" width="50px">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText"
            aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <i class="bi bi-list icon"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <?php
                    $class->pagesAll(0,0);
                ?>
            </ul>
            <span class="navbar-text">
                <?php
                if($user->getLogged()){
                    if($user->getPermission($_SESSION["userAccountID"]) > 0){
                ?>
                <a href="admin/" class="btn btn-outline-danger" type="submit">Admin</a>
                <?php
                }
                ?>
                <a href="./logout.php" class="btn btn-outline-success" type="submit">Çıkış Yap</a>
                <?php }else{
                ?>
                <a href="./login.php" class="btn btn-outline-success" type="submit">Giriş Yap</a>
                <?php
                }
                ?>
            </span>
        </div>
    </div>
</nav>