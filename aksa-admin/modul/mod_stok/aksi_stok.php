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

$module=$_GET[module];
$act=$_GET[act];

// Hapus stok
if ($module=='stok' AND $act=='hapus'){
	
		 mysql_query("DELETE FROM stok WHERE id_stok='$_GET[id]'");
	 
		header('location:../../media.php?module='.$module);
  
}

// Input stok
elseif ($module=='stok' AND $act=='input'){
	$id = $_POST[id_produk];
	$stok = $_POST[penambahan_stok];
	$stok_awal = $_POST[stok_awal];
	$stok_baru = $stok_awal + $stok;
    mysql_query("INSERT INTO stok(id_produk,
                                    penambahan_stok,
                                    tgl) 
                            VALUES('$id',
                                   '$stok',
								   '$tgl_sekarang')");
				
    mysql_query("UPDATE produk SET stok     = '$stok_baru'
                             WHERE id_produk = '$id'");
							 
  header('location:../../media.php?module='.$module);

}

// Update stok
elseif ($module=='stok' AND $act=='update'){

  // Apabila gambar tidak diganti
  if (empty($lokasi_file)){
    mysql_query("UPDATE stok SET jdl_stok     = '$_POST[jdl_stok]',
                                  stok_seo     = '$stok_seo', 
                                  keterangan='$_POST[keterangan]', 
                                  aktif='$_POST[aktif]' 
                             WHERE id_stok = '$_POST[id]'");
  header('location:../../media.php?module='.$module);
  }
  else{
    if ($tipe_file != "image/jpeg" AND $tipe_file != "image/pjpeg" AND $tipe_file != "image/png" AND $tipe_file != "image/x-png"){
    echo "<script>window.alert('Upload Gagal, Pastikan File yang di Upload bertipe *.JPG');
        window.location=('../../media.php?module=stok')</script>";
    }
    else{
    UploadAlbum($nama_file_unik);
    mysql_query("UPDATE stok SET jdl_stok  = '$_POST[jdl_stok]',
                                   stok_seo = '$stok_seo',
                                   gbr_stok    = '$nama_file_unik', 
                                  keterangan='$_POST[keterangan]', 
                                   aktif='$_POST[aktif]'    
                             WHERE id_stok = '$_POST[id]'");
  header('location:../../media.php?module='.$module);
  }
  }
}

// Input Galeri
elseif ($module=='stok' AND $act=='inputgaleri'){
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
                                    id_stok,
                                    gbr_gallery) 
                            VALUES('$_POST[jdl_gallery]',
                                   '$gallery_seo',
                                   '$_POST[stok]',
                                   '$nama_file_unik')");
  header('location:../../media.php?module='.$module.'&act=view&id='.$_POST[stok]);
  }
  }
  else{
    mysql_query("INSERT INTO gallery(jdl_gallery,
                                    gallery_seo,
                                    id_stok) 
                            VALUES('$_POST[jdl_gallery]',
                                   '$gallery_seo',
                                   '$_POST[stok]')");
  header('location:../../media.php?module='.$module.'&act=view&id='.$_POST[stok]);
  }
}

// Hapus galeri
if ($module=='stok' AND $act=='hapusgaleri'){
	
	  $data=mysql_fetch_array(mysql_query("SELECT gbr_gallery,id_stok FROM gallery WHERE id_gallery='$_GET[id]'"));
	  if ($data['gbr_gallery']!=''){
		 mysql_query("DELETE FROM gallery WHERE id_gallery='$_GET[id]'");
		 unlink("../../../img_galeri/$_GET[namafile]");   
		 unlink("../../../img_galeri/kecil_$_GET[namafile]");  
		
	  }
	  else{
		 mysql_query("DELETE FROM gallery WHERE id_gallery='$_GET[id]'");
	  }
  
		header('location:../../media.php?module='.$module.'&act=view&id='.$data[id_stok]);
  
}

// Update galeri
if ($module=='stok' AND $act=='updategaleri'){
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
                                   id_stok = '$_POST[stok]' 
                             WHERE id_gallery   = '$_POST[id]'");
  header('location:../../media.php?module='.$module.'&act=view&id='.$_POST[stok]);
  }
  else{
    if ($tipe_file != "image/jpeg" AND $tipe_file != "image/pjpeg" AND $tipe_file != "image/png" AND $tipe_file != "image/x-png"){
    echo "<script>window.alert('Upload Gagal, Pastikan File yang di Upload bertipe *.JPG');
        window.location=('../../media.php?module=stok')</script>";
    }
    else{
    UploadGallery($nama_file_unik);
    mysql_query("UPDATE gallery SET jdl_gallery  = '$_POST[jdl_gallery]',
                                   gallery_seo   = '$gallery_seo', 
                                   id_stok = '$_POST[stok]', 
                                   gbr_gallery      = '$nama_file_unik'   
                             WHERE id_gallery   = '$_POST[id]'");
  header('location:../../media.php?module='.$module.'&act=view&id='.$_POST[stok]);
  }
  }
}

}
?>
