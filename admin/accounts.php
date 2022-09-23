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
  <title>Gappze - Kullanıcılar</title>
  <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
  <link href="apps/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet"
    type="text/css" />
  <link href="http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css" />
  <link href="apps/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
  <link href="apps/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
  <link href="apps/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
</head>

<body class="skin-red">
  <div class="wrapper">

    <?php
    include("apps/includes/header.php");
    include("apps/includes/navbar.php");
    ?>

    <div class="content-wrapper">
      <section class="content-header">
        <h1>
          Kullanıcılar
          <small>Buradan kullanıcıları yönetebilirsin!</small>
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
                      <th>#</th>
                      <th>Ad</th>
                      <th>Soyad</th>
                      <th>Email</th>
                      <th>Yetki</th>
                      <th>İşlem</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $user->getAllAccounts();
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
      include("apps/includes/footer.php");
    ?>
  </div><!-- ./wrapper -->

  <!-- jQuery 2.1.3 -->
  <script src="apps/plugins/jQuery/jQuery-2.1.3.min.js"></script>
  <!-- Bootstrap 3.3.2 JS -->
  <script src="apps/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
  <!-- DATA TABES SCRIPT -->
  <script src="apps/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
  <script src="apps/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
  <!-- SlimScroll -->
  <script src="apps/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
  <!-- FastClick -->
  <script src='apps/plugins/fastclick/fastclick.min.js'></script>
  <!-- AdminLTE App -->
  <script src="apps/js/app.min.js" type="text/javascript"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="apps/js/demo.js" type="text/javascript"></script>
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