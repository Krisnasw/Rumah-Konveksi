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

// Hapus artikel
if ($module=='event' AND $act=='hapus'){
  mysql_query("DELETE FROM event WHERE id_news='$_GET[id]'");
  header('location:../../media.php?module='.$module);
}

// Input artikel
elseif ($module=='event' AND $act=='input'){
  $lokasi_file    = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file      = $_FILES['fupload']['name'];
  $acak           = rand(000000,999999);
  $nama_file_unik = $acak.$nama_file; 

  $artikel_seo      = seo_title($_POST[judul]);
  
    // Apabila ada gambar yang diupload
  if (!empty($lokasi_file)){
    if ($tipe_file != "image/jpeg" AND $tipe_file != "image/pjpeg" AND $tipe_file != "image/png" AND $tipe_file != "image/x-png"){
    echo "<script>window.alert('Upload Gagal, Pastikan File yang di Upload bertipe *.JPG');
        window.location=('../../media.php?module=slider')</script>";
    }
    else{
    UploadBerita($nama_file_unik);
   mysql_query("INSERT INTO event(judul, artikel_seo,
                                    deskripsi, gambar, tgl_posting) 
                            VALUES('$_POST[judul]','$artikel_seo',
                                   '$_POST[deskripsi]','$nama_file_unik','$tgl_sekarang')");
  header('location:../../media.php?module='.$module);
  }
  }
  else{
    mysql_query("INSERT INTO event(judul, artikel_seo,
                                    deskripsi, tgl_posting) 
                            VALUES('$_POST[judul]','$artikel_seo',
                                   '$_POST[deskripsi]','$tgl_sekarang')");
  header('location:../../media.php?module='.$module);
  }  
}

// Update artikel
elseif ($module=='event' AND $act=='update'){ 
  $lokasi_file    = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file      = $_FILES['fupload']['name'];
  $acak           = rand(000000,999999);
  $nama_file_unik = $acak.$nama_file; 
  
  $artikel_seo      = seo_title($_POST[judul]);
  
  // Apabila gambar tidak diganti
  if (empty($lokasi_file)){
    mysql_query("UPDATE event SET judul = '$_POST[judul]',
									artikel_seo = '$artikel_seo',
                                   deskripsi   = '$_POST[deskripsi]'
                             WHERE id_news   = '$_POST[id]'");
  
  header('location:../../media.php?module='.$module);
  }
  else{
    if ($tipe_file != "image/jpeg" AND $tipe_file != "image/pjpeg" AND $tipe_file != "image/png" AND $tipe_file != "image/x-png"){
		echo "<script>window.alert('Upload Gagal, Pastikan File yang di Upload bertipe *.JPG');
        window.location=('../../media.php?module=$module')</script>";
    }
    else{
		UploadBerita($nama_file_unik);
    mysql_query("UPDATE event SET judul = '$_POST[judul]',
									artikel_seo = '$artikel_seo',
                                   deskripsi   = '$_POST[deskripsi]',
								   gambar = '$nama_file_unik'
                             WHERE id_news   = '$_POST[id]'");
  
  header('location:../../media.php?module='.$module);
	}
  } 


}
}
?>
