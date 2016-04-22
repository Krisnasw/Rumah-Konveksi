<?php
session_start();
if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
include "../../../config/koneksi.php";
include "../../../config/library.php";
include "../../../config/fungsi_thumb.php";
include "../../../config/fungsi_seo.php";

$module=$_GET['module'];
$act=$_GET['act'];

// Hapus halamanstatis
if ($module=='halamanstatis' AND $act=='hapus'){
  mysql_query("DELETE FROM halamanstatis WHERE id_halaman='$_GET[id]'");
  header('location:../../media.php?module='.$module);
}

// Input halamanstatis
elseif ($module=='halamanstatis' AND $act=='input'){
  $lokasi_file    = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_	   = $_FILES['fupload']['name'];
  $nama_file   = seo_gambar($nama_);
    // Apabila ada gambar yang diupload
  if (!empty($lokasi_file)){
    UploadFile($nama_file);
							
	mysql_query("INSERT INTO halamanstatis(judul,isi_halaman,gambar,tgl_posting) 
                            VALUES('$_POST[judul]','$_POST[isi_halaman]','$nama_file','$tgl_sekarang')");
	
	header('location:../../media.php?module='.$module);
  }
  else{
    	mysql_query("INSERT INTO halamanstatis(judul,isi_halaman,tgl_posting) 
                            VALUES('$_POST[judul]','$_POST[isi_halaman]','$tgl_sekarang')");
  }
  header('location:../../media.php?module='.$module);
  
   
}

// Update halamanstatis
elseif ($module=='halamanstatis' AND $act=='update'){
  $lokasi_file    = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_	   = $_FILES['fupload']['name'];
  $nama_file   = seo_gambar($nama_);
  
    // Apabila ada gambar yang diupload
  if (!empty($lokasi_file)){
    UploadFile($nama_file);
	mysql_query("UPDATE halamanstatis SET judul = '$_POST[judul]', isi_halaman  = '$_POST[isi_halaman]',
										 gambar = '$nama_file'
                             WHERE id_halaman   = '$_POST[id]'");
  }
  else{
    mysql_query("UPDATE halamanstatis SET judul = '$_POST[judul]', isi_halaman  = '$_POST[isi_halaman]'
                             WHERE id_halaman   = '$_POST[id]'");
  }
  header('location:../../media.php?module='.$module);
}
}
?>
