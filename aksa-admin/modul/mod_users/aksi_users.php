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

// Hapus users
if ($module=='users' AND $act=='hapus'){
  $data=mysql_fetch_array(mysql_query("SELECT gambar FROM users WHERE id_users='$_GET[id]'"));
  if ($data['gambar']!=''){
     mysql_query("DELETE FROM users WHERE id_users='$_GET[id]'");
     unlink("../../../foto_users/$_GET[namafile]");   
  }
  else{
    mysql_query("DELETE FROM users WHERE id_users='$_GET[id]'");
  }
  header('location:../../media.php?module='.$module);
}

// Input users
elseif ($module=='users' AND $act=='input'){
  $lokasi_file = $_FILES['fupload']['tmp_name'];
  $nama_     = $_FILES['fupload']['name'];
  $nama_file   = seo_gambar($nama_);
  $tipe_file   = $_FILES['fupload']['type'];
  
  $password = md5($_POST[password]);

  if (!empty($lokasi_file)){
    if ($tipe_file != "image/jpeg" AND $tipe_file != "image/pjpeg" AND $tipe_file != "image/png" AND $tipe_file != "image/x-png"){
    echo "<script>window.alert('Upload Gagal, Pastikan File yang di Upload bertipe *.JPG');
        window.location=('../../media.php?module=users)</script>";
    }else{
    UploadBanner($nama_file);
    mysql_query("INSERT INTO users(username, password,
                                    nama_lengkap, email, 
                                    no_telp, tgl,
                                    level, blokir, gambar) 
                            VALUES('$_POST[username]','$password','$_POST[nama]',
                                   '$_POST[email]','$_POST[telp]',
                                   '$tgl_sekarang','$_POST[level]','$_POST[blokir]','$nama_file')");
  header('location:../../media.php?module='.$module);
}
}else{
  mysql_query("INSERT INTO users(username, password,
                                    nama_lengkap, email, 
                                    no_telp, tgl,
                                    level, blokir) 
                            VALUES('$_POST[username]','$password','$_POST[nama]',
                                   '$_POST[email]','$_POST[telp]',
                                   '$tgl_sekarang','$_POST[level]','$_POST[blokir]')");
  header('location:../../media.php?module='.$module);

}
}

// Update users
elseif ($module=='users' AND $act=='update'){
$lokasi_file = $_FILES['fupload']['tmp_name'];
  $nama_     = $_FILES['fupload']['name'];
  $nama_file   = seo_gambar($nama_);
  $tipe_file   = $_FILES['fupload']['type'];

$password = md5($_POST[password]);
  
 if(!empty($_POST[password]) AND empty($lokasi_file)){
    mysql_query("UPDATE users SET username      = '$_POST[username]',
                                  password		= '$password',
                                  nama_lengkap  = '$_POST[nama]',
                                  email 		= '$_POST[email]',
                                  no_telp 		= '$_POST[telp]',
                                  level 		= '$_POST[level]',
                                  blokir 		= '$_POST[blokir]'  
                             WHERE id_users = '$_POST[id]'");
  header('location:../../media.php?module='.$module);
  
  }elseif(!empty($_POST[password]) AND !empty($lokasi_file)){
    if ($tipe_file != "image/jpeg" AND $tipe_file != "image/pjpeg" AND $tipe_file != "image/png" AND $tipe_file != "image/x-png"){
    echo "<script>window.alert('Upload Gagal, Pastikan File yang di Upload bertipe *.JPG');
        window.location=('../../media.php?module=users)</script>";
    }else{
      UploadBanner($nama_file);
      mysql_query("UPDATE users SET username      = '$_POST[username]',
                                  password    = '$password',
                                  nama_lengkap  = '$_POST[nama]',
                                  email     = '$_POST[email]',
                                  no_telp     = '$_POST[telp]',
                                  level     = '$_POST[level]',
                                  blokir    = '$_POST[blokir]',
                                  gambar    = '$nama_file'  
                             WHERE id_users = '$_POST[id]'");
  header('location:../../media.php?module='.$module);

    }

  }elseif(empty($_POST[password]) AND !empty($lokasi_file)){
      if ($tipe_file != "image/jpeg" AND $tipe_file != "image/pjpeg" AND $tipe_file != "image/png" AND $tipe_file != "image/x-png"){
    echo "<script>window.alert('Upload Gagal, Pastikan File yang di Upload bertipe *.JPG');
        window.location=('../../media.php?module=users)</script>";
    }else{
      UploadBanner($nama_file);
      mysql_query("UPDATE users SET username      = '$_POST[username]',
                                  nama_lengkap  = '$_POST[nama]',
                                  email     = '$_POST[email]',
                                  no_telp     = '$_POST[telp]',
                                  level     = '$_POST[level]',
                                  blokir    = '$_POST[blokir]',
                                  gambar    = '$nama_file'  
                             WHERE id_users = '$_POST[id]'");
  header('location:../../media.php?module='.$module);
  }
}else{

  mysql_query("UPDATE users SET username      = '$_POST[username]',
                                  nama_lengkap  = '$_POST[nama]',
                                  email     = '$_POST[email]',
                                  no_telp     = '$_POST[telp]',
                                  level     = '$_POST[level]',
                                  blokir    = '$_POST[blokir]'
                             WHERE id_users = '$_POST[id]'");
  header('location:../../media.php?module='.$module);
}
}

}
?>