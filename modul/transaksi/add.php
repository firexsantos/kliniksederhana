<div class="az-dashboard-one-title">
    <div>
         <h2 class="az-dashboard-title">Tambah Transaksi Penjualan</h2>
    </div>
</div>

<a href="menu.php?mod=transaksi" class="btn btn-primary mb-2">Kembali</a>
<hr>
<?php
	if(isset($_POST['tambah'])){
		
		$no_transaksi	= autotrans();
		$kode_obat		= $_POST['kode_obat'];
		$qty			= $_POST['qty'];
		
		//Untuk mendapatkan harga obat
		$sharga			= mysqli_query($konek,"SELECT * FROM obat WHERE kode_obat = '".$kode_obat."'");
		$dharga			= mysqli_fetch_array($sharga);
		$harga			= $dharga['harga'];
		
		$total			= $harga * $qty;
		
		//Cek detail
		$scek	= mysqli_query($konek,"SELECT * FROM transaksi_detail WHERE no_transaksi = '".$no_transaksi."' AND kode_obat = '".$kode_obat."'");
		$hcek	= mysqli_num_rows($scek);
		if($hcek > 0){
			$dcek	= mysqli_fetch_array($scek);
			$newqty			= $qty + $dcek['qty'];
			$newtotal		= $harga * $newqty;
			$proses			= mysqli_query($konek,"UPDATE transaksi_detail SET qty = '".$newqty."', total = '".$newtotal."' WHERE no_transaksi = '".$no_transaksi."' AND kode_obat = '".$kode_obat."'");
		}else{
			$proses			= mysqli_query($konek,"INSERT INTO transaksi_detail (no_transaksi, kode_obat, qty, total) VALUE ('".$no_transaksi."','".$kode_obat."','".$qty."','".$total."')");
		}
		
		
		if($proses){
			header("Location: menu.php?mod=add-transaksi");
		}else{
			echo"<div class='alert alert-danger'>Gagal menyimpan data.</div>";
		}
	}else if(isset($_POST['selesaikan'])){
		$no_transaksi	= autotrans();
		$grandtotal		= $_POST['grandtotal'];
		$bayar			= $_POST['bayar'];
		$kembali		= $bayar - $grandtotal;
		if($bayar >= $grandtotal){
			$proses		= mysqli_query($konek,"INSERT INTO transaksi (no_transaksi, grandtotal, bayar, kembali, id_pengguna) VALUE ('".$no_transaksi."','".$grandtotal."','".$bayar."','".$kembali."','".$sesid."')");
			if($proses){
				header("Location: menu.php?mod=transaksi");
			}else{
				echo"<div class='alert alert-danger'>Gagal menyimpan data.</div>";
			}
		}else{
			echo"<div class='alert alert-danger'>Jumlah bayar tidak sesuai dengan total</div>";
		}
		
		
	}else if(isset($_POST['hapusdetail'])){
		$id_detail	= $_POST['id_detail'];
		$proses			= mysqli_query($konek,"DELETE FROM transaksi_detail WHERE id_detail = '".$id_detail."'");
		if($proses){
			echo"<div class='alert alert-success'>Berhasil menghapus data</div>";
		}else{
			echo"<div class='alert alert-danger'>Gagal menghapus data</div>";
		}
	}
?>

<div class="row">
	<form method="post" class="col-md-4">
		<div class="form-group">
			<label>No. Transaksi: <span class="text-danger">Auto</span></label>
			<input type="text" name="no_transaksi" value="<?php echo autotrans();?>" class="form-control font-weight-bold text-danger" placeholder="Nomor Transaksi" readonly>
		</div>
		<div class="form-group">
			<label>Obat:</label>
			<select class="form-control" name="kode_obat" required>
				<option value="">- Pilih Obat -</option>
				<?php
					$sobat = mysqli_query($konek,"SELECT a.*, b.nm_jenis FROM obat a, jenis b WHERE a.id_jenis = b.id_jenis");
					while($dobat = mysqli_fetch_array($sobat)){
						echo"<option value='".$dobat['kode_obat']."'>".$dobat['kode_obat']." - ".$dobat['nm_obat']." (".$dobat['nm_jenis'].")</option>";
					}
				?>
			</select>
		</div>
		<div class="form-group">
			<label>Qty:</label>
			<input type="number" name="qty" class="form-control" placeholder="Jumlah" required>
		</div>
		<div class="form-group">
			<button type="reset" class="btn btn-dark">Reset</button>
			<button type="submit" name="tambah" class="btn btn-primary">Tambah</button>
		</div>
	</form>
	
	<div class="col-md-8">
		<table class="table table-hover table-striped">
			<thead>
				<tr>
					<th class="text-center">No.</th>
					<th>Kode Obat</th>
					<th>Nama Obat</th>
					<th>@Harga</th>
					<th>Qty</th>
					<th>Total</th>
					<th>Aksi</th>
				</tr>
			</thead>
			<tbody>
				<?php
					$nodetail	= 1;
					$sdetail	= mysqli_query($konek, "SELECT a.*, b.nm_obat, b.harga FROM transaksi_detail a, obat b WHERE a.kode_obat = b.kode_obat AND a.no_transaksi = '".autotrans()."'");
					$grand		= 0;
					while($ddetail = mysqli_fetch_array($sdetail)){
						echo"
							<tr>
								<td class='text-center'>".$nodetail.".</td>
								<td>".$ddetail['kode_obat']."</td>
								<td>".$ddetail['nm_obat']."</td>
								<td>".$ddetail['harga']."</td>
								<td>".$ddetail['qty']."</td>
								<td>Rp ".rupiah($ddetail['total'])."</td>
								<td class='text-center'>
									<form method='post' class='btn-group'>
										<input type='hidden' name='id_detail' value='".$ddetail['id_detail']."'>
										<button type='submit' name='hapusdetail' class='btn btn-danger btn-sm'>Hapus</button>
									</form>
								</td>
							</tr>
						";
						$nodetail++;
						$grand = $grand + $ddetail['total'];
					}
				?>
			</tbody>
			<tfoot>
				<tr>
					<th colspan="5">Grand Total :</th>
					<th colspan="2">Rp <?= rupiah($grand) ?></th>
				</tr>
			</tfoot>
		</table>
		
		<a href="#" class="btn btn-success btn-lg float-right" data-toggle="modal" data-target="#modalSelesaikan">Selesaikan Transaksi</a>
		
		<?php
			$sgrand	= mysqli_query($konek,"SELECT SUM(total) AS grandtotal FROM transaksi_detail WHERE no_transaksi = '".autotrans()."'");
			$dgrand	= mysqli_fetch_array($sgrand);
		?>
		
		<form method="post" class="modal fade" id="modalSelesaikan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  <div class="modal-dialog">
			<div class="modal-content">
			  <div class="modal-header bg-success text-light">
				<h5 class="modal-title" id="exampleModalLabel">Selesaikan Transaksi</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				  <span aria-hidden="true">&times;</span>
				</button>
			  </div>
			  <div class="modal-body">
				<div class="form-group">
					<label>Grand Total:</label>
					<input type="text" name="grandtotal" value="<?= $dgrand['grandtotal'] ?>" class="form-control" readonly>
				</div>
				<div class="form-group">
					<label>Total Bayar:</label>
					<input type="number" name="bayar" class="form-control" required>
				</div>
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
				<button type="submit" name="selesaikan" class="btn btn-success">Selesaikan</button>
			  </div>
			</div>
		  </div>
		</form>


	</div>
	
</div>