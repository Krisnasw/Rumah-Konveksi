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

// Input menu utama
if ($module=='menupengunjung' AND $act=='input'){
  mysql_query("INSERT INTO mainmenu(nama_menu,link,aktif,adminmenu,no_urut) VALUES('$_POST[nama_menu]','$_POST[link]','$_POST[aktif]','$_POST[adminmenu]','$_POST[no_urut]')");
  header('location:../../media.php?module='.$module);
}

// Update menu utama
elseif ($module=='menupengunjung' AND $act=='update'){
  mysql_query("UPDATE mainmenu SET nama_menu='$_POST[nama_menu]', link='$_POST[link]', aktif='$_POST[aktif]', adminmenu='$_POST[adminmenu]', no_urut='$_POST[nu]' 
               WHERE id_main = '$_POST[id]'");
  header('location:../../media.php?module='.$module);
}
}
?>
