<?php
session_start();
error_reporting(0);
include "config/koneksi.php";
include "config/library.php";
include "config/fungsi_rupiah.php";
include "config/fungsi_antiinjeksi.php";
include "config/class_paging.php";
include "config/fungsi_thumb.php";

$module=$_GET[module];
$act=$_GET[act];

// Hapus artikel
if ($module=='account' AND $act=='hapus'){
  mysql_query("DELETE FROM kustomer WHERE id_kustomer='$_GET[id]'");
  header('location:media.php?module='.$module);
}

// Input artikel
elseif ($module=='account' AND $act=='input'){
  $lokasi_file    = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file      = $_FILES['fupload']['name'];
  $acak           = rand(000000,999999);
  $nama_file_unik = $acak.$nama_file; 
    // Apabila ada gambar yang diupload
  if (!empty($lokasi_file)){
    if ($tipe_file != "image/jpeg" AND $tipe_file != "image/pjpeg" AND $tipe_file != "image/png" AND $tipe_file != "image/x-png"){
    echo "<script>window.alert('Upload Gagal, Pastikan File yang di Upload bertipe *.JPG');
        window.location=('media.php?module=account')</script>";
    }
    else{
    UploadBerita($nama_file_unik);
   mysql_query("INSERT INTO kustomer(nama, email,
                                    telp, gambar, alamat) 
                            VALUES('$_POST[nama]','$_POST[email]',
                                   '$_POST[telp]','$nama_file_unik','$_POST[alamat]')");
  header('location:media.php?module='.$module);
  }
  }
  else{
    mysql_query("INSERT INTO kustomer(nama, email,
                                    telp, alamat) 
                            VALUES('$_POST[nama]','$_POST[email]',
                                   '$_POST[telp]','$_POST[alamat]')");
  header('location:media.php?module='.$module);
  }  
}

// Update artikel
elseif ($module=='account' AND $act=='update'){ 
  $lokasi_file    = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file      = $_FILES['fupload']['name'];
  $acak           = rand(000000,999999);
  $nama_file_unik = $acak.$nama_file;
  // Apabila gambar tidak diganti
  if (empty($lokasi_file)){
    mysql_query("UPDATE event SET judul = '$_POST[judul]',
									artikel_seo = '$artikel_seo',
                                   deskripsi   = '$_POST[deskripsi]'
                             WHERE id_news   = '$_POST[id]'");
  
  header('location:../../media.php?module='.$module);
  }
  else{
    if ($tipe_file != "image/jpeg" AND $tipe_file != "image/pjpeg" AND $tipe_file != "image/png" AND $tipe_file != "image/x-png"){
		echo "<script>window.alert('Upload Gagal, Pastikan File yang di Upload bertipe *.JPG');
        window.location=('../../media.php?module=$module')</script>";
    }
    else{
		UploadBerita($nama_file_unik);
    mysql_query("UPDATE event SET judul = '$_POST[judul]',
									artikel_seo = '$artikel_seo',
                                   deskripsi   = '$_POST[deskripsi]',
								   gambar = '$nama_file_unik'
                             WHERE id_news   = '$_POST[id]'");
  
  header('location:../../media.php?module='.$module);
	}
  } 


}

$module=$_GET['module'];
$act=$_GET['act'];

if ($module=='keranjang' AND $act=='tambah'){
	$sid = session_id();
	$sql2 = mysql_query("SELECT stok,dibeli FROM produk WHERE id_produk='$_GET[id]'");
	$r=mysql_fetch_array($sql2);
	$stok=$r[stok];
	$dibeli=$r[dibeli]+1;
	
	$jumlah = $_POST[jml];
	if (!empty($jumlah)) {
		$jml = $jumlah;
	} else { $jml = '1'; }
  
  if ($stok == 0){
      echo "<script> alert('stok habis'); window.location = 'semua-produk.html'

      </script>";
  }
  else{
	// check if the product is already
	// in cart table for this session
	$sql = mysql_query("SELECT id_produk FROM orders_temp
			WHERE id_produk='$_GET[id]' AND id_session='$sid'");
			
	$ketemu=mysql_num_rows($sql);
	if ($ketemu==0){
		// put the product in cart table
		mysql_query("INSERT INTO orders_temp (id_produk, jumlah, id_session, tgl_order_temp, jam_order_temp, stok_temp)
				VALUES ('$_GET[id]', '$jml', '$sid', '$tgl_sekarang', '$jam_sekarang', '$stok')");
				
		// update dibeli
		mysql_query("UPDATE produk SET dibeli=$dibeli WHERE id_produk='$_GET[id]'"); 
	} else {
		// update product quantity in cart table
		mysql_query("UPDATE orders_temp 
		        SET jumlah = jumlah + 1
				WHERE id_session ='$sid' AND id_produk='$_GET[id]'");		
	}	
	deleteAbandonedCart();
	header('location:keranjang-belanja.html');
	// echo "<script> window.location = 'keranjang-belanja.html'</script>";
  }				
}

elseif ($module=='keranjang' AND $act=='hapus'){
	mysql_query("DELETE FROM orders_temp WHERE id_orders_temp='$_GET[id]'");
	header('location:keranjang-belanja.html');
	// echo "<script> window.location = 'keranjang-belanja.html'</script>";	
}

elseif ($module=='keranjang' AND $act=='update'){
  $id       = $_POST['id'];
  $jml_data = count($id);
  $jumlah   = $_POST['jml']; // quantity
  for ($i=1; $i <= $jml_data; $i++){
	$sql2 = mysql_query("SELECT stok_temp FROM orders_temp WHERE id_orders_temp='".$id[$i]."'");
	while($r=mysql_fetch_array($sql2)){
		if ($jumlah[$i] > $r[stok_temp]){
			echo "<script>window.alert('Jumlah yang dibeli melebihi stok yang ada');
			window.location=('keranjang-belanja.html')</script>";
		}
		elseif($jumlah[$i] == 0){
			echo "<script>window.alert('Anda tidak boleh menginputkan angka 0 atau mengkosongkannya!');
			window.location=('keranjang-belanja.html')</script>";
		}
		else{
		  mysql_query("UPDATE orders_temp SET jumlah = '".$jumlah[$i]."'
										  WHERE id_orders_temp = '".$id[$i]."'");
		  header('location:keranjang-belanja.html');
		// echo "<script> window.location = 'keranjang-belanja.html'</script>";
		}
	}
  }
}

if ($module=='keranjang' AND $act=='checkout'){
	
	$kode_orders = 	$_POST[kode_orders];		
	$sid = session_id();
	
	$sqlproduk = mysql_query("SELECT id_produk FROM orders_temp WHERE id_session='$sid'");

	// if (empty($_POST[shipping[same_as_billing]])) {
		// if (empty($_POST[nama2]) && empty($_POST[email2]) && empty($_POST[alamat2]) && empty($_POST[telp2])) {				
			$nama = $_POST[nama];
			$email = $_POST[email];
			$alamat = $_POST[alamat];
			$telp = $_POST[telp];
		// } else {
		// 	$nama = $_POST[nama2];
		// 	$email = $_POST[email2];
		// 	$alamat = $_POST[alamat2];
		// 	$telp = $_POST[telp2];	
		// }	
		$total = $_POST[total];	
	
		// put the product in cart table
		mysql_query("INSERT INTO orders (kode_orders, id_kustomer, id_session, status_order, tgl_order, jam_order, nama_pemesan, email, alamat, telp, jumlah_dibayar)
					VALUES ('$kode_orders', '$_POST[id_kustomer]', '$sid','Baru', '$tgl_sekarang', '$jam_sekarang','$nama', '$email', '$alamat', '$telp', '$total')");
						
		while ($rpro = mysql_fetch_array ($sqlproduk)) {
				
		$sql2 = mysql_query("SELECT stok,dibeli FROM produk WHERE id_produk='$rpro[id_produk]'");
		$r=mysql_fetch_array($sql2);
		
		$sql = mysql_query("SELECT jumlah FROM orders_temp
					WHERE id_produk='$rpro[id_produk]' AND id_session='$sid'");
		$rsql=mysql_fetch_array($sql);
		
		$stok=$r[stok];
		$jml = $rsql[jumlah];
	  
		$dibeli = $r[dibeli] + $jml;
		$stok_baru = $stok - $jml;		
						
		  // if ($stok == 0){
			  // echo "stok habis";
		  // }
		  // else{
			// check if the product is already
			// in cart table for this session
			// $ketemu=mysql_num_rows($sqlpro);
			// if ($ketemu==0){
				// put the product in cart table						
				mysql_query("INSERT INTO orders_detail (id_produk, jumlah, id_kustomer, kode_orders)
						VALUES ('$rpro[id_produk]', '$jml', '$_POST[id_kustomer]', '$_POST[kode_orders]')");
						
				// update stok dibeli
				// mysql_query("UPDATE produk SET dibeli=$dibeli, stok ='$stok_baru' WHERE id_produk='$rpro[id_produk]'"); 
			// } else {
				// update product quantity in cart table
				// mysql_query("UPDATE orders_temp 
						// SET jumlah = jumlah + $jumlah
						// WHERE id_session ='$sid' AND id_produk='$rpro[id_produk]'");		
			// }	
			
		}				
			
	$sqlorder=mysql_query("SELECT * FROM orders_detail, produk 
                     WHERE orders_detail.id_produk=produk.id_produk 
                     AND orders_detail.kode_orders='$kode_orders'");
					 
	$emailx = mysql_query("SELECT * FROM email WHERE id_email='1'");
	$remail = mysql_fetch_array($emailx);
						 
	$body_mail = "<h2>Berikut Detail Pesanan Anda </h2>\r\n";
	$body_mail .= "$remail[header]\r\n";
					 
	$body_mail .= "<h3>Kode Order $kode_orders </h3>\r\n";
	$body_mail .= "	 
					<table class=\"table table-striped\">
						<thead>
							<tr>
								<th>Nama Produk</th>
								<th>Jumlah</th>
								<th>Harga Satuan</th>
								<th>Sub Total</th>
							</tr>
						</thead>
						<tbody>";			
	$nn = 0;
	while($s=mysql_fetch_array($sqlorder)){
		// rumus untuk menghitung subtotal dan total		
		if($s[diskon] != 0){
			$disc        = ($s[diskon]/100)*$s[harga];
			$harga  = number_format(($s[harga]-$disc),0,",","."); 
		}
		else{
			$harga       = $s[harga];
		}
		
		$subtotal    = $harga * $s[jumlah];
		$harga_rp = format_rupiah($harga);
		$totalharga     = $totalharga + $subtotal;
		$subtotal_rp = format_rupiah($subtotal);    
		$total_rp    = format_rupiah($totalharga);

		// $subtotalberat = $s[berat] * $s[jumlah]; // total berat per item produk 
		// $totalberat  = $totalberat + $subtotalberat; // grand total berat all produk yang dibeli
		
		$body_mail .="
				<tr>
					<td>$s[nama_produk]</td>
					<td align=center>$s[jumlah]</td>
					<td align=right>Rp. $harga_rp</td>
					<td align=right>Rp. $subtotal_rp</td>
				</tr>
			";
		$nn++;
	}	
	$total_rp = format_rupiah($totalharga + $biayaongkir);
	$body_mail .= "			
						<tr>
							<td colspan=3 align=right>Ongkos Kirim : </td>
							<td align=right>Rp. $biayaongkir</td>
						</tr>
						<tr>
							<td colspan=3 align=right>Total : </td>
							<td align=right><b>Rp. $total_rp</b></td>
						</tr> 	
						</tbody>
					</table>
				\r\n";
	
	$body_mail .= "$remail[footer]\r\n";
	$headers = "From: $remail[email]\r\n";
	$headers .= "Reply-to: $remail[email]\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=UTF-8\r\n";
	// $mail_sent = @mail($email, "Pesanan anda ", $body_mail, $headers);
	// $mail_sent = @mail("andhika.tri@gmail.com", "Konfirmasi ", $body_mail, $headers);
	
	// echo $mail_sent ? "<script>alert('Terimakasih, Pesanan Anda kami terima'); window.location = './'</script>" : "Gagal";	
	// echo $mail_sent ? "berhasil" : "Gagal";	
			
			deleteCart();
			// header('location:./');
	echo "<script>window.location='mail/mail.php?module=checkout'</script>";
	// echo "<script> window.location = 'opsipembayaran'</script>";	
}


if ($module=='keranjang' AND $act=='konfirmasi'){
	$kode_orders = $_POST[kode_orders];
	$id_kustomer = $_POST[id_kustomer];
	$dari_bank = $_POST[dari_bank];
	$ke_bank = $_POST[ke_bank];
	$pengirim = $_POST[pengirim];
	$jumlah = $_POST[jumlah];
	
	// put the product in cart table
	mysql_query("INSERT INTO konfirmasi (id_kustomer, kode_konfirmasi, dari_bank, ke_bank, pengirim, tgl, jam, jumlah, status)
				VALUES ('$id_kustomer','$kode_orders','$dari_bank','$ke_bank','$pengirim','$tgl_sekarang','$jam_sekarang','$jumlah','Baru Dibayar')");
				
	mysql_query("UPDATE orders SET status_order = 'Baru Dibayar' WHERE kode_orders ='$kode_orders' AND id_kustomer = '$id_kustomer'");		
			

	$sql2=mysql_query("SELECT * FROM orders_detail, produk 
                     WHERE orders_detail.id_produk=produk.id_produk 
                     AND orders_detail.kode_orders='$kode_orders'");
					 
	$rorder = mysql_fetch_array(mysql_query("SELECT email, nama_pemesan, alamat, jumlah_dibayar, biaya_ongkir FROM orders
                     WHERE kode_orders='$kode_orders'"));
					 			 
	$emailx = mysql_query("SELECT * FROM email WHERE id_email='1'");
	$remail = mysql_fetch_array($emailx);
	
	$qDataKonf = mysql_query("SELECT * FROM konfirmasi WHERE kode_konfirmasi = '$kode_orders'");
	$rDataKonf = mysql_fetch_array($qDataKonf);
					 
	$body_mail = "<h2>Detail Konfirmasi </h2>\r\n";
	$body_mail .= "$remail[header]\r\n";
					 
	$body_mail .= "<h3>Kode Order $kode_orders </h3>\r\n";
	$body_mail .= "	 
					<table class=\"table table-striped\">
						<thead>
							<tr>
								<th>Nama Produk</th>
								<th>Jumlah</th>
								<th>Harga Satuan</th>
								<th>Sub Total</th>
							</tr>
						</thead>
						<tbody>";

			
	$n = 1;
	while($s=mysql_fetch_array($sql2)){
		// rumus untuk menghitung subtotal dan total		
		// $disc        = ($s[diskon]/100)*$s[harga];
		// $hargadisc   = number_format(($s[harga]-$disc),0,",","."); 
		if($s[promo] == 'Y'){
		 $harga       = $s[harga_promo];
		}
		else{
		 $harga       = $s[harga];
		}
		
		$subtotal    = $harga * $s[jumlah];
		$harga_rp = format_rupiah($harga);
		$total       = $total + $subtotal;
		$subtotal_rp = format_rupiah($subtotal);    
		$total_rp    = format_rupiah($total);

		// $subtotalberat = $s[berat] * $s[jumlah]; // total berat per item produk 
		// $totalberat  = $totalberat + $subtotalberat; // grand total berat all produk yang dibeli
		
		$body_mail .="
				<tr>
					<td>$s[nama_produk]</td>
					<td align=center>$s[jumlah]</td>
					<td align=right>Rp. $harga_rp</td>
					<td align=right>Rp. $subtotal_rp</td>
				</tr>
			";
		$n++;
	}
	$ongkoskirim = $rorder[biaya_ongkir];
	$grandtotal    = $total + $ongkoskirim; 
	
	$ongkoskirim_rp = format_rupiah($ongkoskirim);
	$ongkoskirim1_rp = format_rupiah($ongkoskirim1); 
	$grandtotal_rp  = format_rupiah($grandtotal);	
	
	$body_mail .= "			
						<tr>
							<td colspan=3 align=right>Total : </td>
							<td align=right><b>Rp. $total_rp</b></td>
						</tr> 
						<tr>
							<td colspan=3 align=right>Ongkos Kirim : </td>
							<td align=right><b>Rp. $ongkoskirim_rp</b></td>
						</tr><tr>
							<td colspan=3 align=right>Grand Total : </td>
							<td align=right><b>Rp. $grandtotal_rp</b></td>
						</tr>					

						</tbody>
					</table>
	
				\r\n";
	
	$body_mail .= "<table class=\"table table-striped\">
						<tr>
							<th colspan=2>Data Konfirmasi</th>
						</tr>
						<tr>
							<td>Nama Pemilik Rekening</td>
							<td> : $rDataKonf[pengirim]</td>
						</tr>
						<tr>
							<td>Transfer Ke Bank</td>
							<td> : $rDataKonf[ke_bank]</td>
						</tr>
						<tr>
							<td>Nominal</td>
							<td> : $rDataKonf[jumlah]</td>
						</tr>
						<tr>
							<td>Tanggal Transfer</td>
							<td> : $rDataKonf[tgl]</td>
						</tr>
						<tr>
							<td>Nama Pemesan</td>
							<td> : $rorder[nama_pemesan]</td>
						</tr>
						<tr>
							<td>Alamat Pengiriman</td>
							<td> : $rorder[alamat], $rorder[kota], $rorder[provinsi]</td>
						</tr>
					</table>\r\n";
	$body_mail .= "$remail[footer]\r\n";
	$headers = "From: $remail[email]\r\n";
	$headers .= "Reply-to: $remail[email]\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=UTF-8\r\n";
	// $mail_sent = @mail($rorder[email], "Konfirmasi dari Alazazi.co.id", $body_mail, $headers);
	// kirim email ke admin
	$mail_sent = @mail($remail[email], "Konfirmasi pembayaran", $body_mail, $headers);
	// $mail_sent = @mail("andhika.tri@gmail.com", "Konfirmasi", $body_mail, $headers);
	
	echo $mail_sent ? "<script>alert('Terimakasih, kami akan segera memprosesnya'); window.location = './'</script>" : "Gagal";	
			
}

/*
	Delete all cart entries older than one day
*/
function deleteAbandonedCart(){
	$kemarin = date('Y-m-d', mktime(0,0,0, date('m'), date('d') - 1, date('Y')));
	mysql_query("DELETE FROM orders_temp 
	        WHERE tgl_order_temp < '$kemarin'");
}
function deleteCart($sid){
	mysql_query("DELETE FROM orders_temp WHERE id_session = '$sid'");
}
?>
