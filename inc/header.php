<div class="az-header">
      <div class="container">
        <div class="az-header-left">
          <a href="menu.php" class="az-logo"><span></span> <?= identitas('nama') ?></a>
          <a href="" id="azMenuShow" class="az-header-menu-icon d-lg-none"><span></span></a>
        </div>
        <div class="az-header-menu">
          <div class="az-header-menu-header">
            <a href="menu.php" class="az-logo"><span></span> <?= identitas('nama') ?></a>
            <a href="" class="close">&times;</a>
          </div>
          <ul class="nav">
            <li class="nav-item active show">
              <a href="menu.php" class="nav-link"><i class="typcn typcn-chart-area-outline"></i> Dashboard</a>
            </li>
            <li class="nav-item">
              <a href="menu.php?mod=user" class="nav-link">Master User</a>
            </li>
			<li class="nav-item">
              <a href="menu.php?mod=obat" class="nav-link">Master Obat</a>
            </li>
			<li class="nav-item">
              <a href="menu.php?mod=transaksi" class="nav-link">Transaksi</a>
            </li>
          </ul>
        </div>



        <div class="az-header-right">
          <div class="dropdown az-profile-menu">
            <a href="" class="az-img-user"><img src="img/faces/face1.jpg" alt=""></a>
            <div class="dropdown-menu">
              <div class="az-dropdown-header d-sm-none">
                <a href="" class="az-header-arrow"><i class="icon ion-md-arrow-back"></i></a>
              </div>
              <div class="az-header-profile">
                <div class="az-img-user">
                  <img src="img/faces/face1.jpg" alt="">
                </div><!-- az-img-user -->
                <h6><?= $sesnama ?></h6>
                <span>Admin Klinik</span>
              </div>
              <a href="logout.php" class="dropdown-item"><i class="typcn typcn-power-outline"></i> Keluar</a>
            </div>
          </div>
        </div>
      </div>
    </div>