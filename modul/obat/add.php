<?php
	$kode_obat	= trim(@$_GET['id']);
	
	if(empty($kode_obat)){
?>


<div class="az-dashboard-one-title">
    <div>
         <h2 class="az-dashboard-title">Tambah Obat</h2>
    </div>
</div>

<a href="menu.php?mod=obat" class="btn btn-primary mb-3">Kembali</a>

<?php
	if(isset($_POST['tambah'])){
		$kode_obat	= $_POST['kode_obat'];
		$nm_obat		= $_POST['nm_obat'];
		$id_jenis		= $_POST['id_jenis'];
		$harga		= $_POST['harga'];
		$stok		= $_POST['stok'];
		
		$proses			= mysqli_query($konek,"INSERT INTO obat (kode_obat, nm_obat, id_jenis, harga, stok) VALUE ('".$kode_obat."','".$nm_obat."','".$id_jenis."','".$harga."','".$stok."')");
		
		if($proses){
			header("Location: menu.php?mod=obat");
		}else{
			echo"<div class='alert alert-danger'>Gagal menyimpan data.</div>";
		}
	}
?>

<form class="row" method="post">
	<div class="col-md-6">
		<div class="form-group">
			<label>Kode Obat:</label>
			<input type="text" name="kode_obat" class="form-control" placeholder="Kode Obat" required>
		</div>
		<div class="form-group">
			<label>Nama Obat:</label>
			<input type="text" name="nm_obat" class="form-control" placeholder="Nama Obat" required>
		</div>
		<div class="form-group">
			<label>Jenis:</label>
			<select class="form-control" name="id_jenis" required>
				<option value="">- Pilih Jenis -</option>
				<?php
					$sjenis = mysqli_query($konek,"SELECT * FROM jenis");
					while($djenis = mysqli_fetch_array($sjenis)){
						echo"<option value='".$djenis['id_jenis']."'>".$djenis['nm_jenis']."</option>";
					}
				?>
			</select>
		</div>
		<div class="form-group">
			<label>Harga (Rp):</label>
			<input type="number" name="harga" class="form-control" placeholder="Harga" required>
		</div>
		<div class="form-group">
			<label>Stok:</label>
			<input type="number" name="stok" class="form-control" placeholder="Stok Obat" required>
		</div>
		<div class="form-group">
			<button type="reset" class="btn btn-dark">Reset</button>
			<button type="submit" name="tambah" class="btn btn-primary">Simpan</button>
		</div>
	</div>
</form>

<?php
	}else{
		
		$sdata	= mysqli_query($konek,"SELECT * FROM obat WHERE kode_obat = '".$kode_obat."'");
		$hdata	= mysqli_num_rows($sdata);
		if($hdata == 0){
			echo"<div class='alert alert-danger'>Data Obat tidak ditemukan.</div>";
		}else{
			$ddata = mysqli_fetch_array($sdata);
?>



<div class="az-dashboard-one-title">
    <div>
         <h2 class="az-dashboard-title">Edit Obat</h2>
    </div>
</div>

<a href="menu.php?mod=obat" class="btn btn-primary mb-3">Kembali</a>

<?php
	if(isset($_POST['edit'])){
		$nm_obat		= $_POST['nm_obat'];
		$id_jenis		= $_POST['id_jenis'];
		$harga		= $_POST['harga'];
		$stok		= $_POST['stok'];
		
		$proses			= mysqli_query($konek,"UPDATE obat SET nm_obat = '".$nm_obat."', id_jenis = '".$id_jenis."', harga = '".$harga."', stok = '".$stok."' WHERE kode_obat = '".$kode_obat."'");
		
		if($proses){
			header("Location: menu.php?mod=obat");
		}else{
			echo"<div class='alert alert-danger'>Gagal menyimpan data.</div>";
		}
	}
?>

<form class="row" method="post">
	<div class="col-md-6">
		<div class="form-group">
			<label>Kode Obat:</label>
			<input type="text" class="form-control" value="<?= $ddata['kode_obat'] ?>" readonly>
		</div>
		<div class="form-group">
			<label>Nama Obat:</label>
			<input type="text" name="nm_obat" class="form-control" value="<?= $ddata['nm_obat'] ?>" placeholder="Nama Obat" required>
		</div>
		<div class="form-group">
			<label>Jenis:</label>
			<select class="form-control" name="id_jenis" required>
				<option value="">- Pilih Jenis -</option>
				<?php
					$sjenis = mysqli_query($konek,"SELECT * FROM jenis");
					while($djenis = mysqli_fetch_array($sjenis)){
						if($ddata['id_jenis'] == $djenis['id_jenis']){
							echo"<option value='".$djenis['id_jenis']."' selected>".$djenis['nm_jenis']."</option>";
						}else{
							echo"<option value='".$djenis['id_jenis']."'>".$djenis['nm_jenis']."</option>";
						}
						
					}
				?>
			</select>
		</div>
		<div class="form-group">
			<label>Harga (Rp):</label>
			<input type="number" name="harga" class="form-control" value="<?= $ddata['harga'] ?>" placeholder="Harga" required>
		</div>
		<div class="form-group">
			<label>Stok:</label>
			<input type="number" name="stok" class="form-control" value="<?= $ddata['stok'] ?>" placeholder="Stok Obat" required>
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