<?php
require_once($_SERVER['DOCUMENT_ROOT']."/functions/functionBase.php");

if(!($user->getLoggedMod())){
  header("location: ../index.php");
  exit;
}
$class->checkSupport($_GET["id"]);
?>
<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <title>Admin Panel - Profilim</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link href="resources/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet"
        type="text/css" />
    <link href="http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <link href="resources/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <link href="resources/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.js"></script>
    <script src="resources/js/core.js"></script>

</head>

<body class="skin-blue">
    <div class="wrapper">
        <?php
            include("pages/header.php");
            include("pages/navbar.php");
        ?>
        <div class="content-wrapper">
            <section class="content-header">
                <h1>
                    Ticket #<?= $_GET["id"]?>
                    <small>Departman: <?= $user->getSupportDepartment($_GET["id"]) ?></small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="/admin/index.php"><i class="fa fa-dashboard"></i> Ana Sayfa</a></li>
                    <li><a href="supports.php">Destek Talepleri</a></li>
                    <li class="active">Ticket #<?= $_GET["id"]?></li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">
                <div id="callback"></div>
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-12">
                        <!-- general form elements -->
                        <div class="box-area">
                            <div class="box-area-message" id="<?= $_GET["id"] ?>">
                                <?php
                                $class->getSupportDetails();
                            ?>
                            </div><!-- /.box -->
                            <div class='box-footer'>
                                <div class='input-group'>
                                    <input class='form-control' id='ticket-message' name='ticket-message'
                                        placeholder='Mesaj yazınız...'>
                                    <div class='input-group-btn'>
                                        <?php if(isset($_POST["id"])){
                                        echo "<button class='btn btn-success sendMessageTicket' id='{$_POST["id"]}' name='sendMessageTicket'><i class='fa fa-plus'></i></button>";
                                        }else{
                                        echo "<button class='btn btn-success sendMessageTicket' id='{$_GET["id"]}' name='sendMessageTicket'><i class='fa fa-plus'></i></button>";
                                        }
                                        
                                        $class->getButtons();
                                        ?>
                                    </div>
                                </div>
                                <div class="settings">
                                    <select class="form-control" name="departments" id="">
                                        <?= $user->getDepartments(); ?>
                                    </select>
                                    <button class="btn align-center btn-primary updateDepartman" name="updateDepartman" type="button"
                                        id="<?=$_GET["id"]?>">Güncelle</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- /.row -->
            </section><!-- /.content -->
        </div><!-- /.content-wrapper -->
        <?php
        include "pages/footer.php";
        ?>
    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.3 -->

    <!-- Bootstrap 3.3.2 JS -->
    <script src="resources/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- FastClick -->
    <script src='resources/plugins/fastclick/fastclick.min.js'></script>
    <!-- AdminLTE App -->
    <script src="resources/js/app.min.js" type="text/javascript"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="resources/js/demo.js" type="text/javascript"></script>
</body>

</html>