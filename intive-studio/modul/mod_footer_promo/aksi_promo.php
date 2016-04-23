<?php
session_start();
if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
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

// Hapus album
if ($module=='footer-promo' AND $act=='hapus'){

	
	  $data=mysql_fetch_array(mysql_query("SELECT gambar FROM footer_promo WHERE id='$_GET[id]'"));
	  if ($data['gambar']!=''){
		 mysql_query("DELETE FROM footer_promo WHERE id='$_GET[id]'");
		 unlink("../../../foto_footer/$_GET[namafile]");   
		 unlink("../../../foto_footer/kecil_$_GET[namafile]");  
		
	  }
	  else{
		 mysql_query("DELETE FROM footer_promo WHERE id='$_GET[id]'");
	  }
  
		header('location:../../media.php?module='.$module);

  
}

// Input album
elseif ($module=='footer-promo' AND $act=='input'){
  $lokasi_file = $_FILES['fupload']['tmp_name'];
  $nama_	   = $_FILES['fupload']['name'];
  $nama_file   = seo_gambar($nama_);
  $tipe_file   = $_FILES['fupload']['type'];
  $acak           = rand(000000,999999);
  $nama_file_unik = $acak.$nama_file; 
  // Apabila ada gambar yang diupload
  if (!empty($lokasi_file)){
    if ($tipe_file != "image/jpeg" AND $tipe_file != "image/pjpeg" AND $tipe_file != "image/png" AND $tipe_file != "image/x-png"){
    echo "<script>window.alert('Upload Gagal, Pastikan File yang di Upload bertipe *.JPG');
        window.location=('../../media.php?module=footer-promo')</script>";
    }
    else{
      UploadFooter($nama_file_unik);
      mysql_query("INSERT INTO footer_promo VALUES ('', '$_POST[jdl_album]', '$_POST[deskripsi]', '$_POST[url]', '$nama_file_unik')") or die(mysql_error());
    header('location:../../media.php?module='.$module);
    }
  }
  else{
    mysql_query("INSERT INTO footer_promo VALUES ('', '$_POST[jdl_album]', '$_POST[deskripsi]', '$_POST[url]', '')") or die(mysql_error());
  header('location:../../media.php?module='.$module);
  }
}

// Update album
elseif ($module=='footer-promo' AND $act=='update'){
	$lokasi_file = $_FILES['fupload']['tmp_name'];
  $nama_	   = $_FILES['fupload']['name'];
  $nama_file   = seo_gambar($nama_);
  $tipe_file   = $_FILES['fupload']['type'];
  $acak           = rand(000000,999999);
  $nama_file_unik = $acak.$nama_file; 

  $album_seo = seo_title($_POST['jdl_album']);


  // Apabila gambar tidak diganti
  if (empty($lokasi_file)){
    mysql_query("UPDATE footer_promo SET judul     = '$_POST[jdl_album]',
                                  url     = '$_POST[url]', 
                                  deskripsi ='$_POST[deskripsi]'
                             WHERE id = '$_POST[id]'");
  header('location:../../media.php?module='.$module);
  }
  else{
    if ($tipe_file != "image/jpeg" AND $tipe_file != "image/jpeg" AND $tipe_file != "image/png" AND $tipe_file != "image/x-png"){
    echo "<script>window.alert('Upload Gagal, Pastikan File yang di Upload bertipe *.JPG');
        window.location=('../../media.php?module=gallery')</script>";
    }
    else{
      UploadFooter($nama_file_unik);
      mysql_query("UPDATE footer_promo SET judul  = '$_POST[jdl_album]',
                                     url = '$_POST[url]',
                                     gambar   = '$nama_file_unik', 
                                    deskripsi ='$_POST[deskripsi]'    
                               WHERE id = '$_POST[id]'");
    header('location:../../media.php?module='.$module);
    } 
  }
}


}
?>
