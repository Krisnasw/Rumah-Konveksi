<?php
session_start();
if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
include "../../../config/koneksi.php";
include "../../../config/fungsi_seo.php";

$module=$_GET[module];
$act=$_GET[act];

// Hapus subkategori
if ($module=='subkategori' AND $act=='hapus'){
  mysql_query("DELETE FROM subkategori WHERE id_subkategori='$_GET[id]'");
  header('location:../../media.php?module='.$module);
}

// Input subkategori
elseif ($module=='subkategori' AND $act=='input'){
  $subkategori_seo = seo_title($_POST['nama_sub']);
  mysql_query("INSERT INTO subkategori(nama_sub,subkategori_seo,id_main,aktif) VALUES('$_POST[nama_sub]','$subkategori_seo','$_POST[id_kategori]','Y')");
  header('location:../../media.php?module='.$module);
}

// Update subkategori
elseif ($module=='subkategori' AND $act=='update'){
  $subkategori_seo = seo_title($_POST['nama_sub']);
  mysql_query("UPDATE subkategori SET nama_sub = '$_POST[nama_sub]', subkategori_seo = '$subkategori_seo' ,id_main='$_POST[id_kategori]' WHERE id_subkategori = '$_POST[id]'");
  header('location:../../media.php?module='.$module);
}
}
?>
