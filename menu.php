<?php
    require("config.php");

    if(empty($sesid)){
      //Klaau belum login
      header("Location: index.php");
    }else{
      //Klau sudah login
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta name="description" content="<?= identitas('nama') ?>">
    <meta name="author" content="<?= identitas('author') ?>">

    <title><?= identitas('nama') ?></title>

    <link href="lib/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="lib/ionicons/css/ionicons.min.css" rel="stylesheet">
    <link href="lib/typicons.font/typicons.css" rel="stylesheet">
    <link href="lib/flag-icon-css/css/flag-icon.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/azia.css">

  </head>
  <body>

    <?php
        include"inc/header.php";
    ?>

    <div class="az-content az-content-dashboard">
      <div class="container">
        <div class="az-content-body">

          <?php
            $modul  = trim(@$_GET['mod']);
            if(empty($modul) || $modul == "dashboard"){
              include"modul/dashboard.php";
            }else if($modul == "user"){
				include"modul/user.php";
            }else if($modul == "add-user"){
				include"modul/add_user.php";
            }else if($modul == "gantipass"){
				include"modul/gantipass.php";
            }else if($modul == "obat"){
				include"modul/obat/data.php";
            }else if($modul == "add-obat"){
				include"modul/obat/add.php";
            }else if($modul == "add-transaksi"){
				include"modul/transaksi/add.php";
            }else if($modul == "transaksi"){
				include"modul/transaksi/data.php";
            }else{
              echo"<div class='alert alert-danger'>Halaman tidak ditemukan.</div>";
            }
          ?>
        

        </div>
      </div>
    </div>

    <?php
        include"inc/footer.php";
    ?>


    <script src="lib/jquery/jquery.min.js"></script>
    <script src="lib/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="lib/ionicons/ionicons.js"></script>
    <script src="lib/jquery.flot/jquery.flot.js"></script>
    <script src="lib/jquery.flot/jquery.flot.resize.js"></script>
    <script src="lib/chart.js/Chart.bundle.min.js"></script>
    <script src="lib/peity/jquery.peity.min.js"></script>
    <script src="js/azia.js"></script>

  </body>
</html>
<?php } ?>