<aside class="main-sidebar">
    <section class="sidebar">
        <div class="user-panel">
            <div class="pull-left image">
                <img src="/resources/img/user.jpg" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
                <p><?= $user->getName($_SESSION["userAccountID"]); ?></p>
                <a style="font-size: 15px"><?= $user->getPermissionName($_SESSION["userAccountID"]) ?></a>
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
             <?php
                $class->pagesAll(1,0);
            ?>  
            
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>