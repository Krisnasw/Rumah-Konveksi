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

// Hapus album
if ($module=='album' AND $act=='hapus'){
	$q_cek_galeri = mysql_query("select * from gallery where id_album='$_GET[id]'");
	$n_cek_galeri = mysql_num_rows($q_cek_galeri);
	
	if($n_cek_galeri != 0){
		echo "<script>window.alert('Masih ada Gambar di album ini, album tidak dapat dihapus !');
        window.location=('../../media.php?module=album')</script>";
	}
	else{
	
	  $data=mysql_fetch_array(mysql_query("SELECT gbr_album FROM album WHERE id_album='$_GET[id]'"));
	  if ($data['gbr_album']!=''){
		 mysql_query("DELETE FROM album WHERE id_album='$_GET[id]'");
		 unlink("../../../img_album/$_GET[namafile]");   
		 unlink("../../../img_album/kecil_$_GET[namafile]");  
		
	  }
	  else{
		 mysql_query("DELETE FROM album WHERE id_album='$_GET[id]'");
	  }
  
		header('location:../../media.php?module='.$module);
  }
  
}

// Input album
elseif ($module=='album' AND $act=='input'){
  $lokasi_file = $_FILES['fupload']['tmp_name'];
  $nama_	   = $_FILES['fupload']['name'];
  $nama_file   = seo_gambar($nama_);
  $tipe_file   = $_FILES['fupload']['type'];
  $acak           = rand(000000,999999);
  $nama_file_unik = $acak.$nama_file; 

  $album_seo = seo_title($_POST['jdl_album']);

  // Apabila ada gambar yang diupload
  if (!empty($lokasi_file)){
    if ($tipe_file != "image/jpeg" AND $tipe_file != "image/pjpeg" AND $tipe_file != "image/png" AND $tipe_file != "image/x-png"){
    echo "<script>window.alert('Upload Gagal, Pastikan File yang di Upload bertipe *.JPG');
        window.location=('../../media.php?module=album')</script>";
    }
    else{
    UploadAlbum($nama_file_unik);
    mysql_query("INSERT INTO album(jdl_album,
                                    album_seo,
                                    gbr_album, keterangan) 
                            VALUES('$_POST[jdl_album]',
                                   '$album_seo',
                                   '$nama_file_unik','$_POST[keterangan]')");
  header('location:../../media.php?module='.$module);
  }
  }
  else{
    mysql_query("INSERT INTO album(jdl_album,
                                    album_seo, keterangan) 
                            VALUES('$_POST[jdl_album]',
                                   '$album_seo','$_POST[keterangan]')");
  header('location:../../media.php?module='.$module);
  }
}

// Update album
elseif ($module=='album' AND $act=='update'){
	$lokasi_file = $_FILES['fupload']['tmp_name'];
  $nama_	   = $_FILES['fupload']['name'];
  $nama_file   = seo_gambar($nama_);
  $tipe_file   = $_FILES['fupload']['type'];
  $acak           = rand(000000,999999);
  $nama_file_unik = $acak.$nama_file; 

  $album_seo = seo_title($_POST['jdl_album']);

  // Apabila gambar tidak diganti
  if (empty($lokasi_file)){
    mysql_query("UPDATE album SET jdl_album     = '$_POST[jdl_album]',
                                  album_seo     = '$album_seo', 
                                  keterangan='$_POST[keterangan]', 
                                  aktif='$_POST[aktif]' 
                             WHERE id_album = '$_POST[id]'");
  header('location:../../media.php?module='.$module);
  }
  else{
    if ($tipe_file != "image/jpeg" AND $tipe_file != "image/pjpeg" AND $tipe_file != "image/png" AND $tipe_file != "image/x-png"){
    echo "<script>window.alert('Upload Gagal, Pastikan File yang di Upload bertipe *.JPG');
        window.location=('../../media.php?module=album')</script>";
    }
    else{
    UploadAlbum($nama_file_unik);
    mysql_query("UPDATE album SET jdl_album  = '$_POST[jdl_album]',
                                   album_seo = '$album_seo',
                                   gbr_album    = '$nama_file_unik', 
                                  keterangan='$_POST[keterangan]', 
                                   aktif='$_POST[aktif]'    
                             WHERE id_album = '$_POST[id]'");
  header('location:../../media.php?module='.$module);
  }
  }
}

// Input Galeri
elseif ($module=='album' AND $act=='inputgaleri'){
  $lokasi_file    = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_	   = $_FILES['fupload']['name'];
  $nama_file   = seo_gambar($nama_);
  $acak           = rand(000000,999999);
  $nama_file_unik = $acak.$nama_file; 
  
  $gallery_seo      = seo_title($_POST['jdl_gallery']);

  // Apabila ada gambar yang diupload
  if (!empty($lokasi_file)){
    if ($tipe_file != "image/jpeg" AND $tipe_file != "image/pjpeg" AND $tipe_file != "image/png" AND $tipe_file != "image/x-png"){
    echo "<script>window.alert('Upload Gagal, Pastikan File yang di Upload bertipe *.JPG');
        window.location=('../../media.php?module=galerifoto')</script>";
    }
    else{
    UploadGallery($nama_file_unik);
    mysql_query("INSERT INTO gallery(jdl_gallery,
                                    gallery_seo,
                                    id_album,
                                    gbr_gallery) 
                            VALUES('$_POST[jdl_gallery]',
                                   '$gallery_seo',
                                   '$_POST[album]',
                                   '$nama_file_unik')");
  header('location:../../media.php?module='.$module.'&act=view&id='.$_POST[album]);
  }
  }
  else{
    mysql_query("INSERT INTO gallery(jdl_gallery,
                                    gallery_seo,
                                    id_album) 
                            VALUES('$_POST[jdl_gallery]',
                                   '$gallery_seo',
                                   '$_POST[album]')");
  header('location:../../media.php?module='.$module.'&act=view&id='.$_POST[album]);
  }
}

// Hapus galeri
if ($module=='album' AND $act=='hapusgaleri'){
	
	  $data=mysql_fetch_array(mysql_query("SELECT gbr_gallery,id_album FROM gallery WHERE id_gallery='$_GET[id]'"));
	  if ($data['gbr_gallery']!=''){
		 mysql_query("DELETE FROM gallery WHERE id_gallery='$_GET[id]'");
		 unlink("../../../img_galeri/$_GET[namafile]");   
		 unlink("../../../img_galeri/kecil_$_GET[namafile]");  
		
	  }
	  else{
		 mysql_query("DELETE FROM gallery WHERE id_gallery='$_GET[id]'");
	  }
  
		header('location:../../media.php?module='.$module.'&act=view&id='.$data[id_album]);
  
}

// Update galeri
if ($module=='album' AND $act=='updategaleri'){
	$lokasi_file    = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_	   = $_FILES['fupload']['name'];
  $nama_file   = seo_gambar($nama_);
  $acak           = rand(000000,999999);
  $nama_file_unik = $acak.$nama_file; 

  $gallery_seo      = seo_title($_POST['jdl_gallery']);

  // Apabila gambar tidak diganti
  if (empty($lokasi_file)){
    mysql_query("UPDATE gallery SET jdl_gallery  = '$_POST[jdl_gallery]',
                                   gallery_seo   = '$gallery_seo', 
                                   id_album = '$_POST[album]' 
                             WHERE id_gallery   = '$_POST[id]'");
  header('location:../../media.php?module='.$module.'&act=view&id='.$_POST[album]);
  }
  else{
    if ($tipe_file != "image/jpeg" AND $tipe_file != "image/pjpeg" AND $tipe_file != "image/png" AND $tipe_file != "image/x-png"){
    echo "<script>window.alert('Upload Gagal, Pastikan File yang di Upload bertipe *.JPG');
        window.location=('../../media.php?module=album')</script>";
    }
    else{
    UploadGallery($nama_file_unik);
    mysql_query("UPDATE gallery SET jdl_gallery  = '$_POST[jdl_gallery]',
                                   gallery_seo   = '$gallery_seo', 
                                   id_album = '$_POST[album]', 
                                   gbr_gallery      = '$nama_file_unik'   
                             WHERE id_gallery   = '$_POST[id]'");
  header('location:../../media.php?module='.$module.'&act=view&id='.$_POST[album]);
  }
  }
}

}
?>
