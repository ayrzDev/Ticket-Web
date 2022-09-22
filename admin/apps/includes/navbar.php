<aside class="main-sidebar">
    <section class="sidebar">
        <div class="user-panel">
            <div class="pull-left image">
                <img src="https://avatars.githubusercontent.com/u/71610210?v=4" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
                <p><?= $user->getName(); ?></p>
                <a><?= $user->getPermissionName($_SESSION["userAccountID"]); ?></a>
            </div>
        </div>
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..." />
                <span class="input-group-btn">
                    <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i
                            class="fa fa-search"></i></button>
                </span>
            </div>
        </form>
        <ul class="sidebar-menu">
            <li class="treeview">
                <a href="index.php">
                    <i class="fa fa-dashboard"></i> <span>Gösterge Paneli</span>
                </a>
            </li>
            <li class=" treeview">
                <a href="supports.php">
                    <i class="fa fa-ticket"></i> <span>Destekler</span>
                </a>
            </li>
            <li class=" treeview">
                <a href="accounts.php">
                    <i class="fa fa-user"></i> <span>Kullanıcılar</span>
                </a>
            </li>
            <li class=" treeview">
                <a href="roles.php">
                    <i class="fa fa-tag"></i> <span>Roller</span>
                </a>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-gear"></i> <span>Ayarlar</span>
                </a>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>