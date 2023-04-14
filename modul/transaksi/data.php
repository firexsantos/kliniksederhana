<div class="az-dashboard-one-title">
    <div>
         <h2 class="az-dashboard-title">Transaksi Penjualan</h2>
    </div>
</div>

<a href="menu.php?mod=add-transaksi" class="btn btn-primary mb-3">Tambah Data</a>

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
			<th>No. Transaksi</th>
			<th>Tanggal</th>
			<th>Grand Total</th>
			<th>Bayar</th>
			<th>Kembali</th>
			<th>Admin</th>
			<th>Aksi</th>
		</tr>
	</thead>
	<tbody>
		<?php
			$sdata	= mysqli_query($konek,"SELECT a.*, b.nm_pengguna FROM transaksi a, pengguna b WHERE a.id_pengguna = b.id_pengguna");
			$nourut	= 1;
			while($ddata = mysqli_fetch_array($sdata)){
				echo"
					<tr>
						<td>".$nourut.".</td>
						<td>".$ddata['no_transaksi']."</td>
						<td>".$ddata['tgl_transaksi']."</td>
						<td>".rupiah($ddata['grandtotal'])."</td>
						<td>".rupiah($ddata['bayar'])."</td>
						<td>".rupiah($ddata['kembali'])."</td>
						<td>".$ddata['nm_pengguna']."</td>
						<td>
							<a href='pdf.php?id=".$ddata['no_transaksi']."' class='btn btn-dark'>Cetak Struk</a>
						</td>
					</tr>
				";
				$nourut++;
			}
		?>
	</tbody>
</table>