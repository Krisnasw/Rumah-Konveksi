<?php
session_start();
error_reporting(0);
if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
include "../../../config/koneksi.php";

$module=$_GET['module'];
$act=$_GET['act'];

// Hapus hubungi
if ($module=='hubungi' AND $act=='hapus'){
  mysql_query("DELETE FROM hubungi WHERE id_hubungi='$_GET[id]'");
  header('location:../../media.php?module='.$module);
}
// Update Hubungi
elseif ($module=='hubungi' AND $act=='update'){

    mysql_query("UPDATE hubungi SET nama  = '$_POST[nama]',
									email  = '$_POST[email]',
									subjek  = '$_POST[subjek]',
                                   pesan='$_POST[pesan]'    
                             WHERE id_hubungi = '$_POST[id]'");
  header('location:../../media.php?module='.$module);
 }
}
?>
