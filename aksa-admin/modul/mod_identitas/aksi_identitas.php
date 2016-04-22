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

// Update identitas
if ($module=='identitas' AND $act=='update'){
  $lokasi_file = $_FILES['fupload']['tmp_name'];
  $nama_	   = $_FILES['fupload']['name'];
  $nama_file   = seo_gambar($nama_);
  
  $lokasi_file2 = $_FILES['fupload2']['tmp_name'];
  $nama2   		= $_FILES['fupload2']['name'];
  $nama_file2   = seo_gambar($nama2);

  // Apabila ada gambar yang diupload
  if (!empty($lokasi_file)){
    UploadFile($nama_file);
    mysql_query("UPDATE identitas SET nama_website   = '$_POST[nama_website]',
                                      alamat_website = '$_POST[alamat_website]',
                                      meta_deskripsi = '$_POST[meta_deskripsi]',
                                      meta_keyword   = '$_POST[meta_keyword]',
                                      favicon        = '$nama_file'    
                                WHERE id_identitas   = '$_POST[id]'");
  }elseif (!empty($lokasi_file2)){
    UploadFile2($nama_file2);
    mysql_query("UPDATE identitas SET nama_website   = '$_POST[nama_website]',
                                      alamat_website = '$_POST[alamat_website]',
                                      meta_deskripsi = '$_POST[meta_deskripsi]',
                                      meta_keyword   = '$_POST[meta_keyword]',
                                      logo        = '$nama_file2'    
                                WHERE id_identitas   = '$_POST[id]'");
  }elseif (!empty($lokasi_file) && !empty($lokasi_file2)){
    UploadFile($nama_file);
    UploadFile2($nama_file2);
    mysql_query("UPDATE identitas SET nama_website   = '$_POST[nama_website]',
                                      alamat_website = '$_POST[alamat_website]',
                                      meta_deskripsi = '$_POST[meta_deskripsi]',
                                      meta_keyword   = '$_POST[meta_keyword]',
                                      favicon        = '$nama_file',  
                                      logo        	 = '$nama_file2'    
                                WHERE id_identitas   = '$_POST[id]'");
  }
  else{
    mysql_query("UPDATE identitas SET nama_website   = '$_POST[nama_website]',
                                      alamat_website = '$_POST[alamat_website]',
                                      meta_deskripsi = '$_POST[meta_deskripsi]',
                                      meta_keyword   = '$_POST[meta_keyword]'
                                WHERE id_identitas   = '$_POST[id]'");
  }
  header('location:../../media.php?module='.$module);
}
}
?>
