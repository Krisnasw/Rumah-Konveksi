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

// Hapus partner
if ($module=='partner' AND $act=='hapus'){
  $data=mysql_fetch_array(mysql_query("SELECT gambar FROM partner WHERE id_partner='$_GET[id]'"));
  if ($data['gambar']!=''){
    mysql_query("DELETE FROM partner WHERE id_partner='$_GET[id]'");
    unlink("../../../foto_partner/$data[gambar]");   
  }
  else{
    mysql_query("DELETE FROM partner WHERE id_partner='$_GET[id]'");  
  }
  header('location:../../media.php?module='.$module);
}

// Input partner
elseif ($module=='partner' AND $act=='input'){
  $lokasi_file    = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_	      = $_FILES['fupload']['name'];
  $nama_file      = seo_gambar($nama_);
  $acak           = rand(000,999);
  $nama_file_unik = $acak.$nama_file; 

  // Apabila ada gambar yang diupload
  if (!empty($lokasi_file)){
    if ($tipe_file != "image/jpeg" AND $tipe_file != "image/pjpeg" AND $tipe_file != "image/png" AND $tipe_file != "image/x-png"){
    echo "<script>window.alert('Upload Gagal, Pastikan File yang di Upload bertipe *.JPG');
        window.location=('../../media.php?module=partner')</script>";
    }
    else{
    UploadPartner($nama_file_unik);
    mysql_query("INSERT INTO partner(nama_partner, deskripsi, gambar) 
                            VALUES('$_POST[nama_partner]','$_POST[deskripsi]','$nama_file_unik')");
  header('location:../../media.php?module='.$module);
  }
  }
  else{
    mysql_query("INSERT INTO partner(nama_partner) 
                            VALUES('$_POST[nama_partner]')");
  header('location:../../media.php?module='.$module);
  }
}

// Update partner
elseif ($module=='partner' AND $act=='update'){
  $lokasi_file    = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_	      = $_FILES['fupload']['name'];
  $nama_file      = seo_gambar($nama_);
  $acak           = rand(000,999);
  $nama_file_unik = $acak.$nama_file; 

  // Apabila gambar tidak diganti
  if (empty($lokasi_file)){
    mysql_query("UPDATE partner SET nama_partner = '$_POST[nama_partner]', 
									deskripsi = '$_POST[deskripsi]' WHERE id_partner = '$_POST[id]'");
  header('location:../../media.php?module='.$module);
 
  }
  else{
    if ($tipe_file != "image/jpeg" AND $tipe_file != "image/pjpeg" AND $tipe_file != "image/png" AND $tipe_file != "image/x-png"){
		echo "<script>window.alert('Upload Gagal, Pastikan File yang di Upload bertipe *.JPG');
        window.location=('../../media.php?module=$module')</script>";
    }
    else{
		UploadPartner($nama_file_unik);
		$data=mysql_fetch_array(mysql_query("SELECT gambar FROM partner WHERE id_partner='$_GET[id]'"));
		if ($data['gambar']!=''){
			unlink("../../../foto_partner/$data[gambar]");   
			mysql_query("UPDATE partner SET nama_partner = '$_POST[nama_partner]', deskripsi = '$_POST[deskripsi]', gambar = '$nama_file_unik'
					WHERE id_partner = '$_POST[id]'");
			header('location:../../media.php?module='.$module); 
		}
		else{
			mysql_query("UPDATE partner SET nama_partner = '$_POST[nama_partner]', deskripsi = '$_POST[deskripsi]', gambar = '$nama_file_unik'
					WHERE id_partner = '$_POST[id]'");
			header('location:../../media.php?module='.$module); 
		}
  }
  }
}
}
?>
