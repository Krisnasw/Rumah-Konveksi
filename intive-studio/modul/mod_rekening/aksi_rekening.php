<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
include "../../../config/koneksi.php";
include "../../../config/fungsi_thumb.php";
include "../../../config/fungsi_seo.php";

$module=$_GET['module'];
$act=$_GET['act'];

// Hapus rekening
if ($module=='rekening' AND $act=='hapus'){
  
  mysql_query("DELETE FROM rekening WHERE id_rekening='$_GET[id]'");  
 
  header('location:../../media.php?module='.$module);
}

// Input Slider
elseif ($module=='rekening' AND $act=='input'){
	
    mysql_query("INSERT INTO rekening(bank,
									no_rekening,
									nama_pemilik, keterangan) 
                            VALUES('$_POST[bank]','$_POST[norek]',
								   '$_POST[nama]','Y')");
  header('location:../../media.php?module='.$module);
  
}

// Update Slider
elseif ($module=='rekening' AND $act=='update'){

    mysql_query("UPDATE rekening SET bank = '$_POST[bank]',
								   no_rekening = '$_POST[norek]',
                                   nama_pemilik  = '$_POST[nama]', 
								   keterangan = '$_POST[keterangan]'
                WHERE id_rekening = '$_POST[id]'");
  header('location:../../media.php?module='.$module);

}
}
?>
