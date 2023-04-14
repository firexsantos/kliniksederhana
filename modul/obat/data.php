<div class="az-dashboard-one-title">
    <div>
         <h2 class="az-dashboard-title">Master Obat</h2>
    </div>
</div>

<a href="menu.php?mod=add-obat" class="btn btn-primary mb-3">Tambah Data</a>

<?php
	if(isset($_POST['hapus'])){
		$kode_obat	= $_POST['kode_obat'];
		$proses			= mysqli_query($konek,"DELETE FROM obat WHERE kode_obat = '".$kode_obat."'");
		if($proses){
			echo"<div class='alert alert-success'>Berhasil menghapus data</div>";
		}else{
			echo"<div class='alert alert-danger'>Gagal menghapus data</div>";
		}
	}
?>

<table class="table table-hover table-striped">
	<thead>
		<tr>
			<th>NO.</th>
			<th>Kode Obat</th>
			<th>Nama Obat</th>
			<th>Jenis</th>
			<th>Harga</th>
			<th>Stok</th>
			<th>Aksi</th>
		</tr>
	</thead>
	<tbody>
		<?php
			$sdata	= mysqli_query($konek,"SELECT a.*, b.nm_jenis FROM obat a, jenis b WHERE a.id_jenis = b.id_jenis");
			$nourut	= 1;
			while($ddata = mysqli_fetch_array($sdata)){
				echo"
					<tr>
						<td>".$nourut."</td>
						<td>".$ddata['kode_obat']."</td>
						<td>".$ddata['nm_obat']."</td>
						<td>".$ddata['nm_jenis']."</td>
						<td>".$ddata['harga']."</td>
						<td>".$ddata['stok']."</td>
						<td>
							<form method='post' class='btn-group'>
								<input type='hidden' name='kode_obat' value='".$ddata['kode_obat']."'>
								<button type='submit' name='hapus' class='btn btn-danger btn-sm'>Hapus</button>
								<a href='menu.php?mod=add-obat&id=".$ddata['kode_obat']."' class='btn btn-primary'>Edit</a>
							</form>
						</td>
					</tr>
				";
				$nourut++;
			}
		?>
	</tbody>
</table>