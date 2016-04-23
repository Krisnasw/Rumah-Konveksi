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

$module=$_GET['module'];
$act=$_GET['act'];

// Hapus slider
if ($module=='slider' AND $act=='hapus'){
  $data=mysql_fetch_array(mysql_query("SELECT gambar FROM slider WHERE id_slider='$_GET[id]'"));
  if ($data['gambar']!=''){
    mysql_query("DELETE FROM slider WHERE id_slider='$_GET[id]'");
    unlink("../../../foto_slider/$data[gambar]");   
    unlink("../../../foto_slider/kecil_$data[gambar]");
  }
  else{
    mysql_query("DELETE FROM slider WHERE id_slider='$_GET[id]'");  
  }
  header('location:../../media.php?module='.$module);
}

// Input Slider
elseif ($module=='slider' AND $act=='input'){
  $lokasi_file    = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file      = $_FILES['fupload']['name'];
  $acak           = rand(000,999);
  $nama_file_u = $acak.$nama_file; 
  
	$nama_file_unik = seo_gambar($nama_file_u);
  // Apabila ada gambar yang diupload
  if (!empty($lokasi_file)){
    if ($tipe_file != "image/jpeg" AND $tipe_file != "image/pjpeg" AND $tipe_file != "image/x-png" AND $tipe_file != "image/png"){
    echo "<script>window.alert('Upload Gagal, Pastikan File yang di Upload bertipe *.JPG');
        window.location=('../../media.php?module=slider')</script>";
    }
    else{
    UploadSlider($nama_file_unik);
    mysql_query("INSERT INTO slider(judul, teks,
                                    gambar,
									jenis_slider,
									status) 
                            VALUES('$_POST[judul]','$_POST[text]',
                                   '$nama_file_unik',
								   '$_POST[jenis_slide]',
								   'Y')");
  header('location:../../media.php?module='.$module);
  }
  }
  else{
    mysql_query("INSERT INTO slider(judul, teks,
									jenis_slider,
									status) 
                            VALUES('$_POST[judul]','$_POST[text]',
								   '$_POST[jenis_slide]',
								   'Y')");
  header('location:../../media.php?module='.$module);
  }
}

// Update Slider
elseif ($module=='slider' AND $act=='update'){
  $lokasi_file    = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file      = $_FILES['fupload']['name'];
  $acak           = rand(000,999);
  $nama_file_u = $acak.$nama_file; 
$nama_file_unik = seo_gambar($nama_file_u);
  // Apabila gambar tidak diganti
  if (empty($lokasi_file)){
    mysql_query("UPDATE slider SET judul = '$_POST[judul]',
								   teks = '$_POST[text]',
								   jenis_slider = '$_POST[jenis_slide]',
                                   status  = '$_POST[status]'  
                WHERE id_slider = '$_POST[id]'");
  header('location:../../media.php?module='.$module);
  }
  else{
    if ($tipe_file != "image/jpeg" AND $tipe_file != "image/pjpeg" AND $tipe_file != "image/x-png" AND $tipe_file != "image/png"){
		echo "<script>window.alert('Upload Gagal, Pastikan File yang di Upload bertipe *.JPG');
        window.location=('../../media.php?module=$module')</script>";
    }
    else{
		UploadSlider($nama_file_unik);
		mysql_query("UPDATE slider SET judul = '$_POST[judul]',
								   teks = '$_POST[text]',
								   gambar = '$nama_file_unik',
								   jenis_slider = '$_POST[jenis_slide]',
                                   status  = '$_POST[status]'  
                WHERE id_slider = '$_POST[id]'");
		header('location:../../media.php?module='.$module);
  }
  }
}

elseif ($module=='slider' AND $act=='simpankonfigursi'){
	if(!empty($act)){
		mysql_query("UPDATE konfigurasi SET Nilai='$_POST[slidertampil]'
					WHERE idKonfigurasi='1'");
		header('location:../../media.php?module='.$module);
	}
}
}
?>
