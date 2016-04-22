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
if ($module=='gallery' AND $act=='hapus'){

	
	  $data=mysql_fetch_array(mysql_query("SELECT gbr_gallery FROM gallery WHERE id_gallery'$_GET[id]'"));
	  if ($data['gbr_gallery']!=''){
		 mysql_query("DELETE FROM gallery WHERE id_gallery='$_GET[id]'");
		 unlink("../../../img_album/$_GET[namafile]");   
		 unlink("../../../img_album/kecil_$_GET[namafile]");  
		
	  }
	  else{
		 mysql_query("DELETE FROM gallery WHERE id_gallery='$_GET[id]'");
	  }
  
		header('location:../../media.php?module='.$module);

  
}

// Input album
elseif ($module=='gallery' AND $act=='input'){
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
        window.location=('../../media.php?module=gallery')</script>";
    }
    else{
    UploadAlbum($nama_file_unik);
    mysql_query("INSERT INTO gallery(jdl_gallery,
                                    gallery_seo,
                                    gbr_gallery, keterangan,tgl,id_user) 
                            VALUES('$_POST[jdl_album]',
                                   '$album_seo',
                                   '$nama_file_unik','$_POST[deskripsi]','$tgl_sekarang', '$_SESSION[id_user]')") or die(mysql_error());
  header('location:../../media.php?module='.$module);
  }
  }
  else{
    mysql_query("INSERT INTO gallery(jdl_gallery,
                                    gallery_seo, keterangan,tgl,id_user) 
                            VALUES('$_POST[jdl_album]',
                                   '$album_seo','$_POST[deskripsi]','$tgl_sekarang', '$_SESSION[id_user]')")or die(mysql_error());
  header('location:../../media.php?module='.$module);
  }
}

// Update album
elseif ($module=='gallery' AND $act=='update'){
	$lokasi_file = $_FILES['fupload']['tmp_name'];
  $nama_	   = $_FILES['fupload']['name'];
  $nama_file   = seo_gambar($nama_);
  $tipe_file   = $_FILES['fupload']['type'];
  $acak           = rand(000000,999999);
  $nama_file_unik = $acak.$nama_file; 

  $album_seo = seo_title($_POST['jdl_album']);

  // Apabila gambar tidak diganti
  if (empty($lokasi_file)){
    mysql_query("UPDATE gallery SET jdl_gallery     = '$_POST[jdl_album]',
                                  gallery_seo     = '$album_seo', 
                                  keterangan='$_POST[deskripsi]'
                             WHERE id_gallery = '$_POST[id]'");
  header('location:../../media.php?module='.$module);
  }
  else{
    if ($tipe_file != "image/jpeg" AND $tipe_file != "image/pjpeg" AND $tipe_file != "image/png" AND $tipe_file != "image/x-png"){
    echo "<script>window.alert('Upload Gagal, Pastikan File yang di Upload bertipe *.JPG');
        window.location=('../../media.php?module=gallery')</script>";
    }
    else{
    UploadAlbum($nama_file_unik);
    mysql_query("UPDATE gallery SET jdl_gallery  = '$_POST[jdl_album]',
                                   gallery_seo = '$album_seo',
                                   gbr_gallery   = '$nama_file_unik', 
                                  keterangan='$_POST[deskripsi]'    
                             WHERE id_gallery = '$_POST[id]'");
  header('location:../../media.php?module='.$module);
  }
  }
}


}
?>
