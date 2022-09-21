<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>Gappze | Dashboard</title>
  <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
  <link href="apps/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet"
    type="text/css" />
  <link href="http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css" />
  <link href="apps/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
  <link href="apps/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
  <link href="apps/plugins/iCheck/flat/blue.css" rel="stylesheet" type="text/css" />
  <link href="apps/plugins/morris/morris.css" rel="stylesheet" type="text/css" />
  <link href="apps/plugins/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
  <link href="apps/plugins/datepicker/datepicker3.css" rel="stylesheet" type="text/css" />
  <link href="apps/plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
  <link href="apps/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />,
</head>

  <body class="skin-red fixed">
  <div class="wrapper">

    <header class="main-header">
      <!-- Logo -->
      <a href="index.html" class="logo"><b>Gapp</b>ze</a>
      <nav class="navbar navbar-static-top" role="navigation">
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
          <span class="sr-only">Toggle navigation</span>
        </a>
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <li class="dropdown messages-menu">
            <li class="dropdown user user-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <img src="https://avatars.githubusercontent.com/u/71610210?v=4" class="user-image" alt="User Image" />
                <span class="hidden-xs">Ahmet DOĞRU</span>
              </a>
              <ul class="dropdown-menu">
                <li class="user-header">
                  <img src="https://avatars.githubusercontent.com/u/71610210?v=4" class="img-circle" alt="User Image" />
                  <p>
                    Ahmet DOĞRU
                    <small>Yönetici</small>
                  </p>
                </li>
                <!-- Menu Footer-->
                <li class="user-footer">
                  <div class="pull-left">
                    <a href="#" class="btn btn-default btn-flat">Profil</a>
                  </div>
                  <div class="pull-right">
                    <a href="#" class="btn btn-default btn-flat">Çıkış yap</a>
                  </div>
                </li>
              </ul>
            </li>
          </ul>
        </div>
      </nav>
    </header>
    <aside class="main-sidebar">
      <?php
        include "apps/includes/navbar.php";
      ?>
    </aside>

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
                <h3>150</h3>
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
                <h3>53</h3>
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
                <h3>44</h3>
                <p>Kullanıcılar</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <section class="col-lg-6">
            <div class="box box-primary">
              <div class="box-header">
                <i class="fa fa-comments-o"></i>
                <h3 class="box-title">Ekip Sohbet</h3>
              </div>
              <div class="box-body chat" id="chat-box">
                <div class="item">
                  <img src="apps/img/user4-128x128.jpg" alt="user image" class="online" />
                  <p class="message">
                    <a href="#" class="name">
                      <small class="text-muted pull-right"><i class="fa fa-clock-o"></i> 2:15</small>
                      Mike Doe
                    </a>
                    I would like to meet you to discuss the latest news about
                    the arrival of the new theme. They say it is going to be one the
                    best themes on the market
                  </p>
                  <div class="attachment">
                    <h4>Attachments:</h4>
                    <p class="filename">
                      Theme-thumbnail-image.jpg
                    </p>
                    <div class="pull-right">
                      <button class="btn btn-primary btn-sm btn-flat">Open</button>
                    </div>
                  </div>
                </div>
                <div class="item">
                  <img src="apps/img/user3-128x128.jpg" alt="user image" class="offline" />
                  <p class="message">
                    <a href="#" class="name">
                      <small class="text-muted pull-right"><i class="fa fa-clock-o"></i> 5:15</small>
                      Alexander Pierce
                    </a>
                    I would like to meet you to discuss the latest news about
                    the arrival of the new theme. They say it is going to be one the
                    best themes on the market
                  </p>
                </div>
                <div class="item">
                  <img src="apps/img/user2-160x160.jpg" alt="user image" class="offline" />
                  <p class="message">
                    <a href="#" class="name">
                      <small class="text-muted pull-right"><i class="fa fa-clock-o"></i> 5:30</small>
                      Susan Doe
                    </a>
                    I would like to meet you to discuss the latest news about
                    the arrival of the new theme. They say it is going to be one the
                    best themes on the market
                  </p>
                </div>
              </div>
              <div class="box-footer">
                <div class="input-group">
                  <input class="form-control" placeholder="Mesaj yazınız..." />
                  <div class="input-group-btn">
                    <button class="btn btn-success"><i class="fa fa-plus"></i></button>
                  </div>
                </div>
              </div>
            </div>
          </section>
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

  <script src="apps/plugins/jQuery/jQuery-2.1.3.min.js"></script>
  <script src="http://code.jquery.com/ui/1.11.2/jquery-ui.min.js" type="text/javascript"></script>
  <script>
    $.widget.bridge('uibutton', $.ui.button);
  </script>
  <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
  <script src="http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
  <script src="apps/plugins/morris/morris.min.js" type="text/javascript"></script>
  <script src="apps/plugins/sparkline/jquery.sparkline.min.js" type="text/javascript"></script>
  <script src="apps/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js" type="text/javascript"></script>
  <script src="apps/plugins/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script>
  <script src="apps/plugins/knob/jquery.knob.js" type="text/javascript"></script>
  <script src="apps/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
  <script src="apps/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
  <script src="apps/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
  <script src="apps/plugins/iCheck/icheck.min.js" type="text/javascript"></script>
  <script src="apps/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
  <script src='apps/plugins/fastclick/fastclick.min.js'></script>
  <script src="apps/js/app.min.js" type="text/javascript"></script>

  <script src="apps/js/pages/dashboard.js" type="text/javascript"></script>
  <script src="apps/js/demo.js" type="text/javascript"></script>
</body>

</html>