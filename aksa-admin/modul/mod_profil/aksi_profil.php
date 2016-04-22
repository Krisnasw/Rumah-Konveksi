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
include "../../../config/fungsi_thumb.php";
include "../../../config/fungsi_seo.php";

$module=$_GET[module];
$act=$_GET[act];

// Update profil
if ($module=='profil' AND $act=='update'){
  $lokasi_file    = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_	   = $_FILES['fupload']['name'];
  $nama_file   = seo_gambar($nama_);

  // Apabila ada gambar yang diupload
  if (!empty($lokasi_file)){
    UploadFile($nama_file);
    mysql_query("UPDATE modul SET static_content = '$_POST[isi]', alamat = '$_POST[alamat]',
                                  gambar         = '$nama_file', jam = '$_POST[jam]', kontak = '$_POST[kontak]',
								  meta_keyword = '$_POST[keterangan]'    	
                            WHERE id_modul       = '$_POST[id]'");
  }
  else{
    mysql_query("UPDATE modul SET static_content = '$_POST[isi]', alamat = '$_POST[alamat]', jam = '$_POST[jam]', 
									kontak = '$_POST[kontak]', meta_keyword = '$_POST[keterangan]'
                            WHERE id_modul       = '$_POST[id]'");
  }
  header('location:../../media.php?module='.$module);
}
}
?>
