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

// Hapus Kategori
if ($module=='kategori' AND $act=='hapus'){

	$id_kategori = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
	if(!empty($id_kategori)){
		$path = '../../../foto_produk/';
		$Gb = mysql_query("SELECT gambar FROM kategori WHERE id_kategori='$id_kategori'");
		$Rg = mysql_fetch_array($Gb);
		if(!empty($Rg['gambar'])){
			unlink($path.$Rg['gambar']);
		}
		mysql_query("DELETE FROM kategori WHERE id_kategori='$id_kategori'");
		header('location:../../media.php?module='.$module);
	}
	else{
		echo "<script>window.alert('ID tidak boleh kosong');
			window.location=('../../media.php?module=$module')</script>";
	}
}

// Input kategori
elseif ($module=='kategori' AND $act=='input'){
  $lokasi_file    = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file      = $_FILES['fupload']['name'];
  
  $lokasi_file2    = $_FILES['fupload1']['tmp_name'];
  $tipe_file2      = $_FILES['fupload1']['type'];
  $nama_file2      = $_FILES['fupload1']['name'];
  $acak           = rand(000,999);
  $nama_file_unik = $acak.$nama_file; 
  $nama_file_unik2 = $acak.$nama_file2; 
  
	$kategori_seo = seo_title($_POST['nama_kategori']);
	
	   // Apabila ada gambar yang diupload
	if (!empty($lokasi_file)){
		if ($tipe_file != "image/jpeg" AND $tipe_file != "image/pjpeg" AND $tipe_file != "image/x-png" AND $tipe_file != "image/png"){
		echo "<script>window.alert('Upload Gagal, Pastikan File yang di Upload bertipe *.JPG');
			window.location=('../../media.php?module=kategori')</script>";
		}
		else{
		UploadImage($nama_file_unik);
			if(!empty($lokasi_file2)){
				if($tipe_file2 != "image/jpeg" AND $tipe_file2 != "image/pjpeg" AND $tipe_file2 != "image/x-png" AND $tipe_file2 != "image/png"){
					$gbr2 = '';
				}
				else{
					UploadFile($nama_file_unik2);
					$gbr2 = $nama_file_unik2;
				}
			}
			else{
				$gbr2 = 'icon.png';
			}
		mysql_query("INSERT INTO kategori(nama_kategori,kategori_seo,gambar,icon) VALUES('$_POST[nama_kategori]','$kategori_seo','$nama_file_unik','$gbr2')");
		
		header('location:../../media.php?module='.$module);
		}
	}
	else{
		mysql_query("INSERT INTO kategori(nama_kategori,kategori_seo) VALUES('$_POST[nama_kategori]','$kategori_seo')");
		
		header('location:../../media.php?module='.$module);
	}  	
}

// Update kategori
elseif ($module=='kategori' AND $act=='update'){
  $lokasi_file    = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file      = $_FILES['fupload']['name'];
  
  $lokasi_file2    = $_FILES['fupload1']['tmp_name'];
  $tipe_file2      = $_FILES['fupload1']['type'];
  $nama_file2      = $_FILES['fupload1']['name'];
  $acak           = rand(000,999);
  $nama_file_unik = $acak.$nama_file; 
  $nama_file_unik2 = $acak.$nama_file2; 
  
	$kategori_seo 	= seo_title($_POST['nama_kategori']);
	
	  // Apabila gambar tidak diganti
  if (empty($lokasi_file)){
  
	if(!empty($lokasi_file2)){
		if($tipe_file2 != "image/jpeg" AND $tipe_file2 != "image/pjpeg" AND $tipe_file2 != "image/x-png" AND $tipe_file2 != "image/png"){
			echo "<script>window.alert('Upload Gagal, Pastikan File yang di Upload bertipe *.JPG');
			window.location=('../../media.php?module=$module')</script>";			
		}
		else{
			UploadFile($nama_file_unik2);
			mysql_query("UPDATE kategori SET icon = '$nama_file_unik2'
                             WHERE id_kategori   = '$_POST[id]'");
		}
	}
	
    mysql_query("UPDATE kategori SET nama_kategori = '$_POST[nama_kategori]', kategori_seo='$kategori_seo' 
				WHERE id_kategori = '$_POST[id]'");
  
  header('location:../../media.php?module='.$module);
  }
  else{
    if ($tipe_file != "image/jpeg" AND $tipe_file != "image/pjpeg"){
		echo "<script>window.alert('Upload Gagal, Pastikan File yang di Upload bertipe *.JPG');
        window.location=('../../media.php?module=$module')</script>";
    }
    else{
		UploadImage($nama_file_unik);
		
   mysql_query("UPDATE kategori SET nama_kategori = '$_POST[nama_kategori]', kategori_seo='$kategori_seo' , gambar = '$nama_file_unik'
				WHERE id_kategori = '$_POST[id]'");
				
	if(!empty($lokasi_file2)){
		if($tipe_file2 != "image/jpeg" AND $tipe_file2 != "image/pjpeg" AND $tipe_file2 != "image/x-png" AND $tipe_file2 != "image/png"){
			echo "<script>window.alert('Upload Gagal, Pastikan File yang di Upload bertipe *.JPG');
			window.location=('../../media.php?module=$module')</script>";
		}
		else{
			UploadFile($nama_file_unik2);
			mysql_query("UPDATE kategori SET icon = '$nama_file_unik2'
                             WHERE id_kategori   = '$_POST[id]'");
		}
	}
  
  header('location:../../media.php?module='.$module);
	}
  } 
	
}
}
?>
