<?php
    $konek  = mysqli_connect("localhost","root","firman88","kliniksederhana");

    function identitas($data){
        if($data == "nama"){
            return "E-Klinik Sehati";
        }else if($data == "author"){
            return "Firman Santosa";
        }
    }

    @session_start();
    $sesid    = @$_SESSION['sesid'];
    $sesnama    = @$_SESSION['sesnama'];
	
	
	function autotrans(){
		global $konek;
		date_default_timezone_set('Asia/Jakarta');
		$tglauto			= date("ymd");
		
		$sdata 				= mysqli_query($konek, "SELECT MAX(RIGHT(no_transaksi, 5)) as max_id FROM transaksi WHERE LEFT(no_transaksi,6) = '".$tglauto."'");
		$hdata				= mysqli_num_rows($sdata);
		if ($hdata > 0) {
			$ddata			= mysqli_fetch_array($sdata);
			$id_max_data	= $ddata['max_id'];
			$sort_data 		= (int) substr($id_max_data, 0, 5);
			$sort_data++;
			$new_data 		= $tglauto .".TRANS.". sprintf("%05s", $sort_data);
		} else {
			$new_data		= $tglauto .".TRANS.00001";
		}
		return $new_data;
	}
	
	
	function rupiah($angka){

		$hasil_rupiah = number_format($angka, 0, ',', '.');
		return $hasil_rupiah;
	}
?>
