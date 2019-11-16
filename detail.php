         <?php
         define('BASEPATH', dirname(__FILE__));
         session_start();

         if(!isset($_SESSION['siswa'])) {
            header('location:./');
         }

         if(isset($_GET['id'])) {

            require('./include/connection.php');

            $sql = $con->prepare("SELECT * FROM t_kandidat WHERE id_kandidat = ?") or die($con->error);
            $sql->bind_param('i', $_GET['id']);
            $sql->execute();
            $sql->store_result();
            $sql->bind_result($id, $nama, $foto, $visi, $misi, $suara, $periode);
            $sql->fetch();
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
            <h2>Profil Calon Ketua</h2>
         <hr />
            <div class="row">
                     <div class="col-md-2">
                        <div>
                           <img src="./assets/img/kandidat/<?php echo $foto; ?>" class="img-responsive">
                        </div>
                     </div>

                     <div class="col-md-10">
                        <table class="table">
                           <tr>
                              <td width="90px">Nama Calon</td>
                              <td>: <?php echo $nama; ?></td>
                           </tr>
                           <tr>
                              <td>Visi</td>
                              <td>: <?php echo nl2br($visi); ?></td>
                           </tr>
                           <tr>
                              <td>Misi</td>
                              <td>: <?php echo nl2br($misi); ?></td>
                           </tr>
                        </table>
                        <div>
                           <button onclick="window.history.go(-1)" class="btn btn-warning">Kembali</button>
                           <a href="./submit.php?id=<?php echo $id; ?>&s=<?php echo $suara; ?>" class="btn btn-success">Beri Suara</a>
                        </div>
                     </div>
            </div>
         </div>
                              </section>
                  </div>
            <?php

         } else {

            header('loaction: ./');

         }
         ?>
      </div>
   </body>
</html>
