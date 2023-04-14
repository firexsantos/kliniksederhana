<div class="az-dashboard-one-title">
    <div>
         <h2 class="az-dashboard-title">Master User</h2>
    </div>
</div>

<a href="menu.php?mod=add-user" class="btn btn-primary mb-3">Tambah Data</a>

<?php
	if(isset($_POST['hapus'])){
		$id_pengguna	= $_POST['id_pengguna'];
		$proses			= mysqli_query($konek,"DELETE FROM pengguna WHERE id_pengguna = '".$id_pengguna."'");
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
			<th>Nama</th>
			<th>Username</th>
			<th>Aksi</th>
		</tr>
	</thead>
	<tbody>
		<?php
			$sdata	= mysqli_query($konek,"SELECT * FROM pengguna");
			$nourut	= 1;
			while($ddata = mysqli_fetch_array($sdata)){
				echo"
					<tr>
						<td>".$nourut."</td>
						<td>".$ddata['nm_pengguna']."</td>
						<td>".$ddata['username']."</td>
						<td>
							<form method='post' class='btn-group'>
								<input type='hidden' name='id_pengguna' value='".$ddata['id_pengguna']."'>
								<button type='submit' name='hapus' class='btn btn-danger btn-sm'>Hapus</button>
								<a href='menu.php?mod=add-user&id=".$ddata['id_pengguna']."' class='btn btn-primary'>Edit</a>
								<a href='menu.php?mod=gantipass&id=".$ddata['id_pengguna']."' class='btn btn-warning'>Edit Password</a>
							</form>
						</td>
					</tr>
				";
				$nourut++;
			}
		?>
	</tbody>
</table>