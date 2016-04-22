<?php
session_start();
if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
include "../../../config/koneksi.php";
include "../../../config/library.php";
include "../../../config/fungsi_thumb.php";
include "../../../config/fungsi_seo.php";
include "../../../config/ImageManipulator.php";

$module=$_GET[module];
$act=$_GET[act];

// Update profil
if ($module=='profilmu' AND $act=='update'){
  $lokasi_file    = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_	   = $_FILES['fupload']['name'];
  $nama_file   = seo_gambar($nama_);

  // Apabila ada gambar yang diupload
  if (!empty($lokasi_file)){
    UploadBanner($nama_file);
    mysql_query("UPDATE users SET nama_lengkap = '$_POST[nama]', email = '$_POST[email]',
                                  gambar         = '$nama_file', no_telp = '$_POST[no_telp]'   	
                            WHERE id_users      = '$_POST[id]'") or die(mysql_error()) or die(mysql_error);
  }
  else{
    mysql_query("UPDATE users SET nama_lengkap = '$_POST[nama]', email = '$_POST[email]',
                                 no_telp = '$_POST[no_telp]'     
                            WHERE id_users      = '$_POST[id]'")or die(mysql_error());
  }
  header('location:../../media.php?module='.$module);
}
}
?>
