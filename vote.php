<?php
define("BASEPATH", dirname(__FILE__));
session_start();
if(!isset($_SESSION['siswa'])) {
   header('location:./index.php');
}

?>

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
         <?php
         require('./include/connection.php');

         $thn     = date('Y');
         $dpn     = date('Y') + 1;
         $periode = $thn.'/'.$dpn;

         $sql = $con->prepare("SELECT * FROM t_kandidat WHERE periode = ?") or die($con->error);
         $sql->bind_param('s', $periode);
         $sql->execute();
         $sql->store_result();
         if ($sql->num_rows() > 0) {
            $numb = $sql->num_rows();
            echo '<div class="text-center" style="padding-top:20px;">
                     <h2>Daftar Calon Ketua Alumni</h2>
                  </div>
                  <hr />';

            echo '<div class="row">';

            echo '<div class="col-md-10 col-md-offset-1">';

               for ($i = 1; $i <= $numb; $i++) {
                  $sql->bind_result($id, $nama, $foto, $visi, $misi, $suara, $periode);
                  $sql->fetch();
         ?>
                  <div class="col-md-3">
                    <section class="wow fadeInDown" data-wow-delay="<?php echo $i; ?>s">
                      <div class="thumbnail">  
                        <div class="text-center">
                           <img src="./assets/img/kandidat/<?php echo $foto; ?>" width="150" class="img">
                           <p class="nama"><b><?php echo $nama; ?></b></p>
                           <div class="caption">
                              <a href="./detail.php?id=<?php echo $id; ?>" class="btn btn-warning btn-block">Lihat Visi Misi</a>
                              <a href="./submit.php?id=<?php echo $id; ?>&s=<?php echo $suara; ?>" class="btn btn-success btn-block">Beri Suara</a>
                           </div>
                          </div>
                        </div>
                     </section>
                  </div>
         <?php
               }

            echo '</div>';

         } else {

            echo '<div class="callout warning">
                     <h2>Belum Ada Calon Ketua</h2>
                  </div>';
         }

         echo '</div>';
         ?>


      <script type="text/javascript" src="./assets/js/jquery.js"></script>
      <script type="text/javascript" src="./assets/js/wow.js"></script>
      <script type="text/javascript">
         wow = new WOW(
            {
               animateClass: 'animated',
               offset:100,
               callback:function(box) {
                  console.log("WOW: animating <" + box.tagName.toLowerCase() + ">")
               }
            }
         );
         wow.init();
      </script>
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
