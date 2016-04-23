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

	if ($module=='cta' AND $act=='update'){
		mysql_query("UPDATE cta SET pin = '$_POST[pin]', email = '$_POST[email]',
									  telp_telkomsel = '$_POST[telp_telkomsel]', telp_indosat = '$_POST[telp_indosat]'   	
								WHERE id_cta       = '$_POST[id]'");
	 
	  header('location:../../media.php?module='.$module);
	}
}
?>
