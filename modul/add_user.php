<?php
	$id_pengguna	= trim(@$_GET['id']);
	
	if(empty($id_pengguna)){
?>


<div class="az-dashboard-one-title">
    <div>
         <h2 class="az-dashboard-title">Tambah User</h2>
    </div>
</div>

<a href="menu.php?mod=user" class="btn btn-primary mb-3">Kembali</a>

<?php
	if(isset($_POST['tambah'])){
		$nm_pengguna	= $_POST['nm_pengguna'];
		$username		= $_POST['username'];
		$password		= md5($_POST['password']);
		
		$proses			= mysqli_query($konek,"INSERT INTO pengguna (nm_pengguna, username, password) VALUE ('".$nm_pengguna."','".$username."','".$password."')");
		
		if($proses){
			header("Location: menu.php?mod=user");
		}else{
			echo"<div class='alert alert-danger'>Gagal menyimpan data.</div>";
		}
	}
?>

<form class="row" method="post">
	<div class="col-md-6">
		<div class="form-group">
			<label>Nama Pengguna:</label>
			<input type="text" name="nm_pengguna" class="form-control" placeholder="Nama pengguna" required>
		</div>
		<div class="form-group">
			<label>Username:</label>
			<input type="text" name="username" class="form-control" placeholder="Username" required>
		</div>
		<div class="form-group">
			<label>Password:</label>
			<input type="password" name="password" class="form-control" placeholder="Password" required>
		</div>
		<div class="form-group">
			<button type="reset" class="btn btn-dark">Reset</button>
			<button type="submit" name="tambah" class="btn btn-primary">Simpan</button>
		</div>
	</div>
</form>

<?php
	}else{
		
		$sdata	= mysqli_query($konek,"SELECT * FROM pengguna WHERE id_pengguna = '".$id_pengguna."'");
		$hdata	= mysqli_num_rows($sdata);
		if($hdata == 0){
			echo"<div class='alert alert-danger'>ID. Pengguna tidak ditemukan.</div>";
		}else{
			$ddata = mysqli_fetch_array($sdata);
?>



<div class="az-dashboard-one-title">
    <div>
         <h2 class="az-dashboard-title">Edit User</h2>
    </div>
</div>

<a href="menu.php?mod=user" class="btn btn-primary mb-3">Kembali</a>

<?php
	if(isset($_POST['edit'])){
		$nm_pengguna	= $_POST['nm_pengguna'];
		$username		= $_POST['username'];
		
		$proses			= mysqli_query($konek,"UPDATE pengguna SET nm_pengguna = '".$nm_pengguna."', username = '".$username."' WHERE id_pengguna = '".$id_pengguna."'");
		
		if($proses){
			header("Location: menu.php?mod=user");
		}else{
			echo"<div class='alert alert-danger'>Gagal menyimpan data.</div>";
		}
	}
?>

<form class="row" method="post">
	<div class="col-md-6">
		<div class="form-group">
			<label>Nama Pengguna:</label>
			<input type="text" name="nm_pengguna" value="<?= $ddata['nm_pengguna'] ?>" class="form-control" placeholder="Nama pengguna" required>
		</div>
		<div class="form-group">
			<label>Username:</label>
			<input type="text" name="username" class="form-control" value="<?= $ddata['username'] ?>" placeholder="Username" required>
		</div>
		<div class="form-group">
			<button type="reset" class="btn btn-dark">Reset</button>
			<button type="submit" name="edit" class="btn btn-primary">Simpan</button>
		</div>
	</div>
</form>


<?php
	}
	}
?>