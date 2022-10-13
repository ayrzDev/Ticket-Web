<?php
require_once($_SERVER['DOCUMENT_ROOT']."/functions/functionBase.php");

if(!($user->getLoggedMod())){
  header("location: ../index.php");
  exit;
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Gappze</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link href="resources/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet"
        type="text/css" />
    <link href="http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <link href="resources/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <link href="resources/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.js"></script>
    <script src="../resources/js/core.js"></script>
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
                    Departman Oluşturma
                    <small>Sayfası</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="index.php"><i class="fa fa-dashboard"></i> Ana Sayfa</a></li>
                    <li><a href="supports.php">Destek</a></li>
                    <li class="active">Departman Oluşturma</li>
                </ol>
            </section>
            <section class="content">
                <div class="row">
                    <div class="col-md-12">
                        <div id="callback"></div>
                         <div class="process error " id="error"></div>
                        <div class="box box-primary">
                            <div class="box-header">
                                <h3 class="box-title">Departman Oluşturma</h3>
                            </div>
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Departman Adı</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" name="departmanname"
                                        placeholder="Rol ismi giriniz">
                                </div>
                            </div>

                            <div class="box-footer">
                                <button type="button" class="btn btn-primary departmanadd" name="departmanadd">Ekle</button>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <?php
            include("pages/footer.php");
        ?>
    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.3 -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.js"></script>
    <script src="resources/js/core.js"></script>
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