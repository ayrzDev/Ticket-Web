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
    <link href="resources/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
    <link href="resources/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <link href="resources/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.js"></script>
    <script src="resources/js/core.js"></script>
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
                    Kullanıcı DÜzenleme
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Ana Sayfa</a></li>
                    <li><a href="#">Kullanıcılar</a></li>
                    <li class="active">Kullanıcı Düzenle</li>
                </ol>
            </section>
            <section class="content">
                <div class="row">
                    <div id="callback"></div>
                    <div class="col-md-6">
                        <div class="box-body">
                            <div class="form-group">
                                <label>Ad Soyad:</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-user"></i>
                                    </div>
                                    <?php
                                        $names = $user->getName($_GET["id"]);
                                    ?>
                                    <input type="text" class="form-control" name="name" value="<?= $names[0] ?>"/>
                                    
                                    <input type="text" class="form-control" name="surname" value="<?= $names[1]?>" />
                                </div><!-- /.input group -->
                            </div><!-- /.form group -->

                            <!-- phone mask -->
                            <div class="form-group">
                                <label>Email:</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-envelope"></i>
                                    </div>
                                    <input type="email" class="form-control" name="email" value="<?= $names[2]?>" data-inputmask='"mask": "(999) 999-9999"'
                                        data-mask />
                                </div><!-- /.input group -->
                            </div><!-- /.form group -->

                            <!-- phone mask -->
                            <div class="form-group">
                                <label>Departman:</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-group"></i>
                                    </div>
                                    <select class="form-control" name="department" id="department">
                                        <?php
                                            $db = $class->dbConnection();
                                        if($db){
                                            $departments = $db->prepare("SELECT * FROM departments");
                                            $departments->execute();
                                            if($departments->rowCount() != 0){
                                                echo "<option value='0'>Yok</option>";
                                            foreach ($departments as $departments_veri) {
                                                if($user->getUserDepartment($_GET["id"]) == $departments_veri["id"]){
                                                    echo "<option value='{$departments_veri['id']}' selected>{$departments_veri['name']}</option>";
                                                }else{
                                                echo "<option value='{$departments_veri['id']}'>{$departments_veri['name']}</option>";
                                                }
                                            }
                                            }
                                        }
                                        ?>
                                    </select>
                                </div><!-- /.input group -->
                            </div><!-- /.form group -->

                            <!-- IP mask -->
                            <div class="form-group">
                                <label>Yetki:</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-laptop"></i>
                                    </div>
                                    <select class="form-control" name="permission" id="permission">
                                        <?php
                                        if($db){
                                            $roles = $db->prepare("SELECT * FROM roles");
                                            $roles->execute();
                                            if($roles->rowCount() != 0){
                                                echo "<option value='0'>Üye</option>";
                                            foreach ($roles as $roles_veri) {
                                                if($user->getPermission($_GET["id"]) == $roles_veri["id"]){
                                                    echo "<option value='{$roles_veri['id']}' selected>{$roles_veri['name']}</option>";
                                                }else{
                                                echo "<option value='{$roles_veri['id']}'>{$roles_veri['name']}</option>";
                                                }
                                            }
                                            }
                                        }?>
                                    </select>
                                </div><!-- /.input group -->
                            </div><!-- /.form group -->

                            <button class="btn btn-success updateUser" id="<?= $_GET["id"] ?>" name="updateUser">Kaydet</button>

                        </div><!-- /.box-body -->
                    </div><!-- /.col (left) -->
                    <!-- <div class="col-md-6">
              
                        <div class="box-body">
                            <!-- Date range -->
                            <!-- <div class="form-group">
                                <label>Mevcut Şifre:</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-key"></i>
                                    </div>
                                    <input type="password" class="form-control pull-right" name="oldpassword" id="reservation" />
                                </div><!-- /.input group -->
                            </div><!-- /.form group -->

                            <!-- Date and time range -->
                            <!-- <div class="form-group">
                                <label>Yeni Şifre:</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-key"></i>
                                    </div>
                                    <input type="password" class="form-control pull-right" name="newpassword" id="reservationtime" />
                                </div><!-- /.input group -->
                            <!-- </di   v>/.form group -->
                            <!-- <button class="btn btn-success">Şifre Değiştir</button> -->

                        </div><!-- /.box-body -->
                    </div><!-- /.box -->


                </div>/.col (right) -->
        </div><!-- /.row -->

        </section><!-- /.content -->
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