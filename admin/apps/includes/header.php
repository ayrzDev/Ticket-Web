<header class="main-header">
    <a href="index.php" class="logo"><b>Gapp</b>ze</a>
    <nav class="navbar navbar-static-top" role="navigation">
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </a>
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="https://avatars.githubusercontent.com/u/71610210?v=4" class="user-image" alt="User Image" />
                        <span class="hidden-xs"><?= $user->getName(); ?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="user-header">
                            <img src="https://avatars.githubusercontent.com/u/71610210?v=4" class="img-circle" alt="User Image" />
                            <p>
                                <?= $user->getName(); ?>
                                <small><?= $user->getPermissionName($_SESSION["userAccountID"]); ?></small>
                            </p>
                        </li>
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="#" class="btn btn-default btn-flat">Profil</a>
                            </div>
                            <div class="pull-right">
                                <a href="../logout.php" class="btn btn-default btn-flat">Çıkış yap</a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>