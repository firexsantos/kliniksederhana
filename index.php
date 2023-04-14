<?php
    require("config.php");
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
    <link rel="stylesheet" href="css/azia.css">

  </head>
  <body class="az-body">

    <div class="az-signin-wrapper">
      <div class="az-card-signin">
        <h1 class="az-logo"><?= identitas('nama') ?></h1>
        
        <?php
          if(isset($_POST['login'])){
            $username   = $_POST['username'];
            $password   = md5($_POST['password']);
            $query      = mysqli_query($konek,"SELECT * FROM pengguna WHERE `username` = '".$username."' AND `password` = '".$password."'");
            $cek        = mysqli_num_rows($query);
            if($cek > 0){
              $ddata    = mysqli_fetch_array($query);
              $_SESSION['sesid'] = $ddata['id_pengguna'];
              $_SESSION['sesnama'] = $ddata['nm_pengguna'];
              header("Location: menu.php");
            }else{
              echo"<div class='alert alert-danger'><b>Username</b> dan <b>Password</b> tidak cocok.</div>";
            }
          }
        ?>

        <div class="az-signin-header">
        
          <form method="post">
            <div class="form-group">
              <label>Username :</label>
              <input type="text" name="username" class="form-control" placeholder="Ketik username anda"  required>
            </div><!-- form-group -->
            <div class="form-group">
              <label>Password :</label>
              <input type="password" name="password" class="form-control" placeholder="Ketik password anda" required>
            </div><!-- form-group -->
            <button class="btn btn-az-primary btn-block" type="submit" name="login">Masuk ke Panel</button>
          </form>
        </div><!-- az-signin-header -->
        <div class="az-signin-footer">
          <p><a href="">Lupa password?</a></p>
          <p>Belum punya akun? <a href="#">Buat akun baru</a></p>
        </div>
      </div>
    </div>

    <script src="lib/jquery/jquery.min.js"></script>
    <script src="lib/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="lib/ionicons/ionicons.js"></script>
    <script src="js/jquery.cookie.js" type="text/javascript"></script>
    <script src="js/jquery.cookie.js" type="text/javascript"></script>

    <script src="js/azia.js"></script>
    <script>
      $(function(){
        'use strict'

      });
    </script>
  </body>
</html>
