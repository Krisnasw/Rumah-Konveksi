<?php
session_start();
if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
include "../../../config/koneksi.php";

$module=$_GET['module'];
$act=$_GET['act'];

// Hapus footer
if ($module=='footer' AND $act=='hapus'){
  mysql_query("DELETE FROM footer WHERE id_footer='$_GET[id]'");
  header('location:../../media.php?module='.$module);
}

// Input footer
elseif ($module=='footer' AND $act=='input'){
    mysql_query("INSERT INTO footer(nama_menu,link) 
                            VALUES('$_POST[nama_menu]','$_POST[link]')");
	header('location:../../media.php?module='.$module);
}

// Update footer
elseif ($module=='footer' AND $act=='update'){
  
    mysql_query("UPDATE footer SET nama_menu = '$_POST[nama_menu]', link  = '$_POST[link]'
                             WHERE id_footer   = '$_POST[id]'");
  header('location:../../media.php?module='.$module);
}
}
?>