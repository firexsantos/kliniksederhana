<?php
	$id_pengguna	= trim(@$_GET['id']);
	

		
		$sdata	= mysqli_query($konek,"SELECT * FROM pengguna WHERE id_pengguna = '".$id_pengguna."'");
		$hdata	= mysqli_num_rows($sdata);
		if($hdata == 0){
			echo"<div class='alert alert-danger'>ID. Pengguna tidak ditemukan.</div>";
		}else{
			$ddata = mysqli_fetch_array($sdata);
?>



<div class="az-dashboard-one-title">
    <div>
         <h2 class="az-dashboard-title">Edit Password User : <?= $ddata['nm_pengguna'] ?></h2>
    </div>
</div>

<a href="menu.php?mod=user" class="btn btn-primary mb-3">Kembali</a>

<?php
	if(isset($_POST['editpass'])){
		$password	= md5($_POST['password']);
		
		$proses			= mysqli_query($konek,"UPDATE pengguna SET password = '".$password."' WHERE id_pengguna = '".$id_pengguna."'");
		
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
			<label>Password Baru:</label>
			<input type="password" name="password" class="form-control" placeholder="Ketik password baru" required>
		</div>
		<div class="form-group">
			<button type="reset" class="btn btn-dark">Reset</button>
			<button type="submit" name="editpass" class="btn btn-primary">Simpan</button>
		</div>
	</div>
</form>


<?php
	}
?>