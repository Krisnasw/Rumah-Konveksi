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

// Hapus subsubkategori
if ($module=='subsubkategori' AND $act=='hapus'){
  mysql_query("DELETE FROM subsubkategori WHERE id_subkategori='$_GET[id]'");
  header('location:../../media.php?module='.$module);
}

// Input subsubkategori
elseif ($module=='subsubkategori' AND $act=='input'){
  $subkategori_seo = seo_title($_POST['nama_sub']);
  mysql_query("INSERT INTO subsubkategori(nama_sub,subkategori_seo,id_main,id_submain) VALUES('$_POST[nama_sub]','$subkategori_seo','$_POST[kategori]','$_POST[subkategori]')");
  header('location:../../media.php?module='.$module);
}

// Update subsubkategori
elseif ($module=='subsubkategori' AND $act=='update'){
  $subkategori_seo = seo_title($_POST['nama_sub']);
  mysql_query("UPDATE subsubkategori SET nama_sub = '$_POST[nama_sub]', subkategori_seo = '$subkategori_seo' ,id_main='$_POST[kategori]',id_submain='$_POST[subkategori]' WHERE id_subkategori = '$_POST[id]'");
  header('location:../../media.php?module='.$module);
}
}
?>
