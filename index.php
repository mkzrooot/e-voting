
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>E-Voting | Ikatan Alumni</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="../assets/css/AdminLTE.min.css">
    <link rel="stylesheet" href="../assets/css/skins/_all-skins.min.css">
    <style>
      .box {
        padding: 30px;
      }
      img.kandidat {
        width:250px;
        height: 230px;
      }
      .suara {
        position: absolute;
        right: 20px;
        bottom: 120px;
      }
    </style>
  </head>
  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        <section class="content">
          <div class="row">
            <div class="col-md-12">
              <div class="box box-success">
                  <div class="welcome">
                  <h2 class="text-center"><b>Ikatan Alumni Ubhara</b></h2>
                  <center><img class="text-center" src="./assets/img/3.png" width="200"></center>
                  <?php
define('BASEPATH', dirname(__FILE__));
session_start();

if (isset($_SESSION['siswa'])) {
   header('location:./vote.php');
}

if (isset($_POST['submit'])) {

   require('include/connection.php');

   $nis     = $_POST['nis'];
   $thn     = date('Y');
   $dpn     = date('Y') + 1;
   $periode = $thn.'/'.$dpn;

   $cek = $con->prepare("SELECT * FROM t_pemilih WHERE nis = ? && periode = ?") or die($con->error);
   $cek->bind_param('ss', $nis, $periode);
   $cek->execute();
   $cek->store_result();
   if ($cek->num_rows() > 0) {echo '<div class="alert alert-danger">Anda sudah memberikan suara.</div>';
   } else {
      $sql = $con->prepare("SELECT * FROM t_user WHERE id_user = ? && pemilih = 'Y'") or die($con->error);
      $sql->bind_param('s', $nis);
      $sql->execute();
      $sql->store_result();
      if ($sql->num_rows() > 0 ) {
         $sql->bind_result($id, $user, $kelas, $jk, $pemilih);
         $sql->fetch();
         $_SESSION['siswa'] = $id;
         header('location:./vote.php');
      } else {echo '<div class="alert alert-danger">Nomor Anda tidak terdaftar.</div>';}
   }
}?>
                        <?php
                        if (isset($_GET['page'])) {
                        switch ($_GET['page']) {
                              case 'thanks':
                              include('./thanks.php');
                              break;

                              default:
                              include('./form.php');
                              break;
                        }
                        } else {
                        include('./form.php');
                        }
                        ?>
                  </div>
              </div>
              <!-- /.box -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->

        </section>
        <!-- /.content -->
      </div>
      <!-- /.content-wrapper -->

      <footer class="main-footer">
        <div class="pull-right">
          <b>Codex</b> by Juliandz
        </div>
      </footer>

    </div>
    <!-- ./wrapper -->
  </body>
</html>
