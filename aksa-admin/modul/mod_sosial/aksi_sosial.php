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

$module=$_GET[module];
$act=$_GET[act];

// Hapus sosial
if ($module=='sosial' AND $act=='hapus'){
  mysql_query("DELETE FROM sosial WHERE id_sosial='$_GET[id]'");
  header('location:../../media.php?module='.$module);
}

// Input sosial
elseif ($module=='sosial' AND $act=='input'){
  $lokasi_file    = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file      = $_FILES['fupload']['name'];
  $acak           = rand(000000,999999);
  $nama_file_unik = $acak.$nama_file; 

  $sosial_seo      = seo_title($_POST[nama]);
  
    // Apabila ada gambar yang diupload
  if (!empty($lokasi_file)){
    if ($tipe_file != "image/jpeg" AND $tipe_file != "image/pjpeg" AND $tipe_file != "image/png" AND $tipe_file != "image/x-png"){
    echo "<script>window.alert('Upload Gagal, Pastikan File yang di Upload bertipe *.JPG');
        window.location=('../../media.php?module=slider')</script>";
    }
    else{
    UploadFile($nama_file_unik);
   mysql_query("INSERT INTO sosial(nama, link, 
							gambar, aktif) 
                            VALUES('$_POST[nama]','$_POST[link]',
							'$nama_file_unik','$_POST[aktif]')");
  header('location:../../media.php?module='.$module);
  }
  }
  else{
    mysql_query("INSERT INTO sosial(nama,
                                    link, aktif) 
                            VALUES('$_POST[nama]',
                                   '$_POST[link]','$_POST[aktif]')");
  header('location:../../media.php?module='.$module);
  }  
}

// Update sosial
elseif ($module=='sosial' AND $act=='update'){ 
  $lokasi_file    = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file      = $_FILES['fupload']['name'];
  $acak           = rand(000000,999999);
  $nama_file_unik = $acak.$nama_file; 
  
  
  // Apabila gambar tidak diganti
  if (empty($lokasi_file)){
    mysql_query("UPDATE sosial SET nama = '$_POST[nama]', 
                                   link   = '$_POST[link]',
                                   aktif   = '$_POST[aktif]'
                             WHERE id_sosial   = '$_POST[id]'");
  
  header('location:../../media.php?module='.$module);
  }
  else{
    if ($tipe_file != "image/jpeg" AND $tipe_file != "image/pjpeg" AND $tipe_file != "image/png" AND $tipe_file != "image/x-png"){
		echo "<script>window.alert('Upload Gagal, Pastikan File yang di Upload bertipe *.JPG');
        window.location=('../../media.php?module=$module')</script>";
    }
    else{
		UploadFile($nama_file_unik);
    mysql_query("UPDATE sosial SET nama = '$_POST[nama]', 
                                   link   = '$_POST[link]',
                                   aktif   = '$_POST[aktif]',
								   gambar = '$nama_file_unik'
                             WHERE id_sosial   = '$_POST[id]'");
  
  header('location:../../media.php?module='.$module);
	}
  } 


}
}
?>
