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

$module=$_GET[module];
$act=$_GET[act];

// Update email
if ($module=='email' AND $act=='update'){

    mysql_query("UPDATE email SET email   = '$_POST[email]',
                                  header = '$_POST[header]',
                                  footer = '$_POST[footer]'
                                WHERE id_email   = '$_POST[id]'");

  header('location:../../media.php?module='.$module);
}
}
?>
