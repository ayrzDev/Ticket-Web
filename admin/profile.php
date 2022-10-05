<?php
require_once($_SERVER['DOCUMENT_ROOT']."/class.function.php");

if(!($user->getLoggedMod())){
  header("location: ../index.php");
  exit;
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>AdminLTE 2 | Dashboard</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link href="apps/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet"
        type="text/css" />
    <link href="http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <link href="apps/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <link href="apps/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
</head>

<body class="skin-blue">
    <div class="wrapper">
        <?php
            include("apps/includes/header.php");
            include("apps/includes/navbar.php");
        ?>
        <div class="content-wrapper">
            <section class="content-header">
                <h1>
                    General Form Elements
                    <small>Preview</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li><a href="#">Forms</a></li>
                    <li class="active">General Elements</li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">
                <div     class="row">
                    <!-- left column -->
                    <div class="col-md-6">
                        <!-- general form elements -->
                        <div class="box-user box-default">
                            <div class="box-header with-border user-container">
                                <img src="https://avatars.githubusercontent.com/u/71610210?v=4" class="user-image" alt="User Image" width="100px"/>
                                <div class="user-text-area">
                                    <h3 class="box-title"><?= $user->getName($_SESSION["userAccountID"]); ?></h3>
                                    <p class=""><?= $user->getPermissionName($_SESSION["userAccountID"]); ?></p>
                                </div>
                                
                                <div class="box-tools pull-right">
                                    <span class="label label-default">8 New Messages</span>
                                </div><!-- /.box-tools -->
                            </div><!-- /.box-header -->
                            <div class="box-body">
                                The body of the box
                            </div><!-- /.box-body -->
                        </div><!-- /.box -->
                    </div>
                </div> <!-- /.row -->
            </section><!-- /.content -->
        </div><!-- /.content-wrapper -->
        <footer class="main-footer">
            <div class="pull-right hidden-xs">
                <b>Version</b> 2.0
            </div>
            <strong>Copyright &copy; 2014-2015 <a href="http://almsaeedstudio.com">Almsaeed Studio</a>.</strong> All
            rights reserved.
        </footer>
    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.3 -->
    <script src="apps/plugins/jQuery/jQuery-2.1.3.min.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="apps/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- FastClick -->
    <script src='apps/plugins/fastclick/fastclick.min.js'></script>
    <!-- AdminLTE App -->
    <script src="apps/js/app.min.js" type="text/javascript"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="apps/js/demo.js" type="text/javascript"></script>
</body>

</html>