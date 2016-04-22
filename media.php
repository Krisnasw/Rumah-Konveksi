<?php 
	error_reporting(0);
	session_start();	
	include "config/koneksi.php";
	include "config/fungsi_indotgl.php";
	include "config/class_paging.php";
	include "config/fungsi_combobox.php";
	include "config/library.php";
	include "config/fungsi_autolink.php";
	include "config/fungsi_rupiah.php";
	include "config/fungsi_antiinjeksi.php";
	include "config/fungsi_seo.php";
	
	// Memilih template yang aktif saat ini
  $pilih_template=mysql_query("SELECT folder FROM templates WHERE aktif='Y'");
  $f=mysql_fetch_array($pilih_template);
  
  $identitas=mysql_query("SELECT * FROM identitas");
  $ridentitas=mysql_fetch_array($identitas);
  
  include "$f[folder]/template1.php"; 
?>