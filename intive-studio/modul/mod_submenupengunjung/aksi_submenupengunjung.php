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

if($_POST[menu_utama]==0){
	$submenu = mysql_fetch_array(mysql_query("SELECT * FROM submenu WHERE id_sub=$_POST[sub_menu]"));
	$menu_utama = $submenu[id_main];
} else {
	$menu_utama = $_POST[menu_utama];
}

// Hapus sub menu
if ($module=='submenupengunjung' AND $act=='hapus'){
  mysql_query("DELETE FROM submenu WHERE id_sub='$_GET[id]'");
  header('location:../../media.php?module='.$module);
}

// Input menu utama
elseif ($module=='submenupengunjung' AND $act=='input'){
  mysql_query("INSERT INTO submenu(nama_sub, link_sub, id_main, aktif, adminsubmenu) 
							VALUES('$_POST[nama_sub]','$_POST[link]', '$menu_utama', 'Y','N')");
  header('location:../../media.php?module='.$module);
}

// Update sub menu
elseif ($module=='submenupengunjung' AND $act=='update'){
    mysql_query("UPDATE submenu SET nama_sub    = '$_POST[nama_sub]',
                                    id_main     = '$menu_utama',
                                    link_sub    = '$_POST[link]',
								  aktif       = '$_POST[aktif]'
                              WHERE id_sub      = '$_POST[id]'");
  header('location:../../media.php?module='.$module);
}
}
?>
