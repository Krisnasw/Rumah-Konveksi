<?php
session_start();
if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
include "../../../config/koneksi.php";
include "../../../config/library.php";

$module=$_GET[module];
$act=$_GET[act];

// Hapus stok
if ($module=='konfirmasi' AND $act=='hapus'){
	
		 mysql_query("DELETE FROM stok WHERE id_stok='$_GET[id]'");
	 
		header('location:../../media.php?module='.$module);
  
}

// Update
elseif ($module=='konfirmasi' AND $act=='update'){

    mysql_query("UPDATE orders SET status_order = '$_POST[status_order]'
                             WHERE kode_orders  = '$_POST[kode_orders]'");
	// update stok di produk						 
    // mysql_query("UPDATE stok SET stok     = '$_POST[stok]',
                             // WHERE id_produk = '$_POST[id]'");
  header('location:../../media.php?module='.$module);
  
}

}
?>
