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
  <title>Gappze - Destekler</title>
  <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
  <link href="resources/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
  <link href="http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css" />
  <link href="resources/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
  <link href="resources/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
  <link href="resources/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />

</head>

<body class="skin-red">
  <div class="wrapper">

    <?php
    include("pages/header.php");
    include("pages/navbar.php");
    ?>

    <div class="content-wrapper">
      <section class="content-header">
        <h1>
          Destekler Talepler
          <small>Buradan destek taleplerini yönetebilirsin!</small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Ana Sayfa</a></li>
          <li class="active">Kullanıcılar</li>
        </ol>
      </section>

      <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-body">
                  <table id="example2" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th style="width: 30px;">#</th>
                        <th style="width: 100px;">Başlık</th>
                        <th style="width: 200px;">Mesaj</th>
                        <th style="width: 120px;">Oluşturan</th>
                        <th style="width: 100px;">Durum</th>
                        <th style="width: 100px;">İşlem</th>
                      </tr>
                    </thead>
                    <tbody class="dataCenter" id="1">
                      <?php
                        $class->getSupports(1);
                      ?>
                    </tbody>
                  </table>
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
  <script src="resources/plugins/jQuery/jQuery-2.1.3.min.js"></script>
  <!-- Bootstrap 3.3.2 JS -->
  <script src="resources/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
  <!-- DATA TABES SCRIPT -->
  <script src="resources/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
  <script src="resources/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
  <!-- SlimScroll -->
  <script src="resources/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
  <!-- FastClick -->
  <script src='resources/plugins/fastclick/fastclick.min.js'></script>
  <!-- AdminLTE App -->
  <script src="resources/js/app.min.js" type="text/javascript"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="resources/js/demo.js" type="text/javascript"></script>
  <!-- page script -->
  <script type="text/javascript">
    $(function () {
      $("#example1").dataTable();
      $('#example2').dataTable({
        "bPaginate": true,
        "bLengthChange": false,
        "bFilter": false,
        "bSort": true,
        "bInfo": true,
        "bAutoWidth": false
      });
    });
  </script>

</body>

</html>