<?php
date_default_timezone_set('UTC');
include "config/koneksi.php";
/**
*  Created by OutAttacker
*/
class Boneka
{
	
	public function Custom($pengirim, $email, $alamat, $pesan, $gambar, $ext, $ukuran, $lokasi, $telp)
	{
		$kode_orders = rand(1111, 9999);
		$sid = session_id();
		$tgl_sekarang = date('l jS \of F Y h:i:s A');
		$dir = "foto_produk/$gambar.$ext";

		if ($ext != "image/jpeg" AND $ext != "image/jpg" AND $ext != "image/png" AND $ext != "image/x-png") {
			# code...
			if ($ukuran > 500000) {
				# code...
				echo "<script>alert('Ukuran Melebihi Batas'); document.location.href='./custom.html' </script>";
			} else {
				$upload = move_uploaded_file($lokasi, $dir);
				if ($upload) {
					# code...
					$inp = mysql_query("INSERT INTO orders (kode_orders, id_kustomer, id_session, status_order, tgl_order, jam_order, nama_pemesan, email, alamat, telp, gambar)VALUES('$kode_orders', '$_POST[id_kustomer]', '$sid','Baru', '$tgl_sekarang', '$jam_sekarang','$pengirim', '$email', '$alamat', '$telp', '$gambar.$ext')");

					if ($inp) {
						# code...
						echo "<script>alert('Custom Order Sukses'); document.location.href='./custom.html' </script>";
					} else {
						echo "<script>alert('Custom Order Gagal'); document.location.href='./custom.html' </script>";
					}
				}
			}
		}
		else
		{
			echo "<script>alert('File Harus Berformat PNG, JPG, JPEG'); </script>";
		}
	}
}

?>