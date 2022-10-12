<?php
require_once($_SERVER['DOCUMENT_ROOT']."/functions/functionBase.php");

if(!($user->getLoggedMod())){
  header("location: ../index.php");
  exit;
}
?>

<!DOCTYPE html>
<html lang="tr">

<head>
  <meta charset="UTF-8">
  <title>Gappze | Dashboard</title>
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.js"></script>

  <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
  <link href="resources/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
  <link href="http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css" />
  <link href="resources/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
  <link href="resources/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
  <link href="resources/plugins/iCheck/flat/blue.css" rel="stylesheet" type="text/css" />
  <link href="resources/plugins/morris/morris.css" rel="stylesheet" type="text/css" />
  <link href="resources/plugins/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
  <link href="resources/plugins/datepicker/datepicker3.css" rel="stylesheet" type="text/css" />
  <link href="resources/plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
  <link href="resources/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />,
</head>

<body class="skin-red fixed">
  <div class="wrapper">
  <?php
    include("pages/header.php");
    include("pages/navbar.php");
    ?>
    <div class="content-wrapper">
      <section class="content-header">
        <h1>
          Dashboard
          <small>Gösterge Paneli</small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Ana Sayfa</a></li>
          <li class="active">Gösterge Paneli</li>
        </ol>
      </section>

      <section class="content">
        <div class="row">
          <div class="col-lg-4 col-xs-6">
            <div class="small-box bg-aqua">
              <div class="inner">
                <h3><?= $user->getTicketCount(0) ?></h3>
                <p>Aktif Destek</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-xs-6">
            <div class="small-box bg-red">
              <div class="inner">
              <h3><?= $user->getTicketCount(1) ?></h3>
                <p>Kapatılan Talepler</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-xs-6">
            <div class="small-box bg-yellow">
              <div class="inner">
                <h3><?= $user->getUserCount(); ?></h3>
                <p>Kullanıcılar</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
    <footer class="main-footer">
      <div class="pull-right hidden-xs">
        <b>Version</b> 1.0
      </div>
      <strong>Copyright &copy; 2022 <a href="#">Ahmet Mücahit DOĞRU</a>.</strong> All rights reserved.
    </footer>
  </div>

  <script src="http://code.jquery.com/ui/1.11.2/jquery-ui.min.js" type="text/javascript"></script>
  <script>
    $.widget.bridge('uibutton', $.ui.button);
  </script>

<script src="http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
  <script src="resources/plugins/morris/morris.min.js" type="text/javascript"></script>
  <script src="resources/plugins/sparkline/jquery.sparkline.min.js" type="text/javascript"></script>
  <script src="resources/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js" type="text/javascript"></script>
  <script src="resources/plugins/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script>
  <script src="resources/plugins/knob/jquery.knob.js" type="text/javascript"></script>
  <script src="resources/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
  <script src="resources/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
  <script src="resources/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
  <script src="resources/plugins/iCheck/icheck.min.js" type="text/javascript"></script>
  <script src="resources/js/pages/dashboard.js" type="text/javascript"></script>
  <script src="resources/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
  <script src="resources/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
  <script src="resources/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
  <script src="resources/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
  <script src='resources/plugins/fastclick/fastclick.min.js'></script>
  <script src="resources/js/app.min.js" type="text/javascript"></script>
  <script src="resources/js/demo.js" type="text/javascript"></script>
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