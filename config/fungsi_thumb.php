<?php

function UploadImage($fupload_name){
  //direktori gambar
  $vdir_upload = "../../../foto_produk/";
  $vfile_upload = $vdir_upload . $fupload_name;
  $tipe_file      = $_FILES['fupload']['type'];

  //Simpan gambar dalam ukuran sebenarnya
  move_uploaded_file($_FILES["fupload"]["tmp_name"], $vfile_upload);

  //identitas file asli
  if($tipe_file != "image/jpeg"){
    $im_src = imagecreatefrompng($vfile_upload);
  }else{
    $im_src = imagecreatefromjpeg($vfile_upload);
  }
  $src_width = imageSX($im_src);
  $src_height = imageSY($im_src);

  //Simpan dalam versi small 90 pixel
  //Set ukuran gambar hasil perubahan
  $dst_width = 212;
  $dst_height = ($dst_width/$src_width)*$src_height;

  //proses perubahan ukuran
  $im = imagecreatetruecolor($dst_width,$dst_height);
  imagecopyresampled($im, $im_src, 0, 0, 0, 0, $dst_width, $dst_height, $src_width, $src_height);

  //Simpan gambar
  if($tipe_file != "image/jpeg"){
  imagepng($im,$vdir_upload . "small_" . $fupload_name);
  }else{
  imagejpeg($im,$vdir_upload . "small_" . $fupload_name);
  }
  
  //Simpan dalam versi medium 270 pixel
  //Set ukuran gambar hasil perubahan
  $lrg_width = 245;
  $lrg_height = ($lrg_width/$src_width)*$src_height;

  //proses perubahan ukuran
  $im_lrg = imagecreatetruecolor($lrg_width,$lrg_height);
  imagecopyresampled($im_lrg, $im_src, 0, 0, 0, 0, $lrg_width, $lrg_height, $src_width, $src_height);

  //Simpan gambar
  // imagejpeg($im_lrg,$vdir_upload . "medium_" . $fupload_name);
  
  //Hapus gambar di memori komputer
  imagedestroy($im_src);
  imagedestroy($im);
}

function UploadFooter($fupload_name){
  //direktori banner
  $vdir_upload = "../../../foto_footer/";
  $vfile_upload = $vdir_upload . $fupload_name;
  $tipe_file      = $_FILES['fupload']['type'];
  
  //Simpan gambar dalam ukuran sebenarnya
  move_uploaded_file($_FILES["fupload"]["tmp_name"], $vfile_upload);
  
  //identitas file asli
  if($tipe_file != "image/jpeg"){
    $im_src = imagecreatefrompng($vfile_upload);
  }else{
    $im_src = imagecreatefromjpeg($vfile_upload);
  }
  
  $src_width = imageSX($im_src);
  $src_height = imageSY($im_src);

  //Simpan dalam versi small 268 pixel
  //Set ukuran gambar hasil perubahan
  $dst_width = 300;
  $dst_height = 350;

  //proses perubahan ukuran
  $im = imagecreatetruecolor($dst_width,$dst_height);
  imagecopyresampled($im, $im_src, 0, 0, 0, 0, $dst_width, $dst_height, $src_width, $src_height);

  //Simpan gambar
  if($tipe_file != "image/jpeg"){
  imagepng($im,$vdir_upload . "small_" . $fupload_name);
  }else{
  imagejpeg($im,$vdir_upload . "small_" . $fupload_name);
  }
  
  //Hapus gambar di memori komputer
  imagedestroy($im_src);
  imagedestroy($im);
}

function UploadBanner($fupload_name){
  //direktori banner
  $vdir_upload = "../../../foto_banner/";
  $vfile_upload = $vdir_upload . $fupload_name;
  $tipe_file      = $_FILES['fupload']['type'];
  
  //Simpan gambar dalam ukuran sebenarnya
  move_uploaded_file($_FILES["fupload"]["tmp_name"], $vfile_upload);
  
  //identitas file asli
  if($tipe_file != "image/jpeg"){
    $im_src = imagecreatefrompng($vfile_upload);
  }else{
    $im_src = imagecreatefromjpeg($vfile_upload);
  }
  
  $src_width = imageSX($im_src);
  $src_height = imageSY($im_src);

  //Simpan dalam versi small 268 pixel
  //Set ukuran gambar hasil perubahan
  $dst_width = 300;
  $dst_height = 350;

  //proses perubahan ukuran
  $im = imagecreatetruecolor($dst_width,$dst_height);
  imagecopyresampled($im, $im_src, 0, 0, 0, 0, $dst_width, $dst_height, $src_width, $src_height);

  //Simpan gambar
  if($tipe_file != "image/jpeg"){
  imagepng($im,$vdir_upload . "small_" . $fupload_name);
  }else{
  imagejpeg($im,$vdir_upload . "small_" . $fupload_name);
  }
  
  //Hapus gambar di memori komputer
  imagedestroy($im_src);
  imagedestroy($im);
}


function UploadBerita($fupload_name){
  //direktori berita
  $vdir_upload = "../../../foto_berita/";
  $vfile_upload = $vdir_upload . $fupload_name;
  $tipe_file      = $_FILES['fupload']['type'];

  //Simpan gambar dalam ukuran sebenarnya
  move_uploaded_file($_FILES["fupload"]["tmp_name"], $vfile_upload);
  
  //identitas file asli
  if($tipe_file != "image/jpeg"){
    $im_src = imagecreatefrompng($vfile_upload);
  }else{
    $im_src = imagecreatefromjpeg($vfile_upload);
  }
  
  $src_width = imageSX($im_src);
  $src_height = imageSY($im_src);

  //Simpan dalam versi small 268 pixel
  //Set ukuran gambar hasil perubahan
  $dst_width = 230;
  $dst_height = ($dst_width/$src_width)*$src_height;;

  //proses perubahan ukuran
  $im = imagecreatetruecolor($dst_width,$dst_height);
  imagecopyresampled($im, $im_src, 0, 0, 0, 0, $dst_width, $dst_height, $src_width, $src_height);

  //Simpan gambar
  if($tipe_file != "image/jpeg"){
  imagepng($im,$vdir_upload . "small_" . $fupload_name);
  }else{
  imagejpeg($im,$vdir_upload . "small_" . $fupload_name);
  }
  
  //Hapus gambar di memori komputer
  imagedestroy($im_src);
  imagedestroy($im);
}

function UploadPartner($fupload_name){
  //direktori partner
  $vdir_upload = "../../../foto_partner/";
  $vfile_upload = $vdir_upload . $fupload_name;

  //Simpan gambar dalam ukuran sebenarnya
  move_uploaded_file($_FILES["fupload"]["tmp_name"], $vfile_upload);
}

function UploadFavicon($fupload_name){
  //direktori file
  $vdir_upload = "../../../files";
  $vfile_upload = $vdir_upload . $fupload_name;

  //Simpan gambar dalam ukuran sebenarnya
  move_uploaded_file($_FILES["fupload"]["tmp_name"], $vfile_upload);
}
function UploadFile($fupload_name){
  //direktori file
  $vdir_upload = "../../../files/";
  $vfile_upload = $vdir_upload . $fupload_name;

  //Simpan gambar dalam ukuran sebenarnya
  move_uploaded_file($_FILES["fupload"]["tmp_name"], $vfile_upload);
}
function UploadFile2($fupload_name){
  //direktori file
  $vdir_upload = "../../../files/";
  $vfile_upload = $vdir_upload . $fupload_name;

  //Simpan gambar dalam ukuran sebenarnya
  move_uploaded_file($_FILES["fupload2"]["tmp_name"], $vfile_upload);
}

// Upload gambar untuk album galeri foto
function UploadAlbum($fupload_name){
  //direktori gambar
  $vdir_upload = "../../../img_album/";
  $vfile_upload = $vdir_upload . $fupload_name;
  $tipe_file      = $_FILES['fupload']['type'];

  //Simpan gambar dalam ukuran sebenarnya
  move_uploaded_file($_FILES["fupload"]["tmp_name"], $vfile_upload);

  //identitas file asli
  if($tipe_file != "image/jpeg"){
    $im_src = imagecreatefrompng($vfile_upload);
  }else{
    $im_src = imagecreatefromjpeg($vfile_upload);
  }
  
  $src_width = imageSX($im_src);
  $src_height = imageSY($im_src);

  //Simpan dalam versi small 268 pixel
  //Set ukuran gambar hasil perubahan
  $dst_width = 318;
  $dst_height = ($dst_width/$src_width)*$src_height;

  //proses perubahan ukuran
  $im = imagecreatetruecolor($dst_width,$dst_height);
  imagecopyresampled($im, $im_src, 0, 0, 0, 0, $dst_width, $dst_height, $src_width, $src_height);

  //Simpan gambar
  if($tipe_file != "image/jpeg"){
  imagepng($im,$vdir_upload . "small_" . $fupload_name);
  }else{
  imagejpeg($im,$vdir_upload . "small_" . $fupload_name);
  }
  
  //Hapus gambar di memori komputer
  imagedestroy($im_src);
  imagedestroy($im);
}

// Upload gambar untuk galeri foto
function UploadGallery($fupload_name){
  //direktori gambar
  $vdir_upload = "../../../img_galeri/";
  $vfile_upload = $vdir_upload . $fupload_name;
  

  //Simpan gambar dalam ukuran sebenarnya
  move_uploaded_file($_FILES["fupload"]["tmp_name"], $vfile_upload);

  //identitas file asli
  $im_src = imagecreatefromjpeg($vfile_upload);
  $src_width = imageSX($im_src);
  $src_height = imageSY($im_src);

  //Simpan dalam versi small 270 pixel
  //Set ukuran gambar hasil perubahan
  $dst_width = 318;
  $dst_height = ($dst_width/$src_width)*$src_height;

  //proses perubahan ukuran
  $im = imagecreatetruecolor($dst_width,$dst_height);
  imagecopyresampled($im, $im_src, 0, 0, 0, 0, $dst_width, $dst_height, $src_width, $src_height);

  //Simpan gambar
  if($tipe_file != "image/jpeg"){
  imagepng($im,$vdir_upload . "kecil_" . $fupload_name);
  }else{
  imagejpeg($im,$vdir_upload . "kecil_" . $fupload_name);
  }
  
  //Hapus gambar di memori komputer
  imagedestroy($im_src);
  imagedestroy($im);
}

// Upload gambar untuk Slider
function UploadSlider($fupload_name){
  //direktori gambar
  $vdir_upload = "../../../foto_slider/";
  $vfile_upload = $vdir_upload . $fupload_name;

  //Simpan gambar dalam ukuran sebenarnya
  move_uploaded_file($_FILES["fupload"]["tmp_name"], $vfile_upload);

  //identitas file asli
  if($tipe_file != "image/jpeg"){
    $im_src = imagecreatefrompng($vfile_upload);
  }else{
    $im_src = imagecreatefromjpeg($vfile_upload);
  }
  
  $src_width = imageSX($im_src);
  $src_height = imageSY($im_src);

  //Simpan dalam versi small 80 pixel
  //Set ukuran gambar hasil perubahan
  $dst_width = 1920;
  $dst_height = 550;

  //proses perubahan ukuran
  $im = imagecreatetruecolor($dst_width,$dst_height);
  imagecopyresampled($im, $im_src, 0, 0, 0, 0, $dst_width, $dst_height, $src_width, $src_height);

  //Simpan gambar
  if($tipe_file != "image/jpeg"){
  imagepng($im,$vdir_upload . "large_" . $fupload_name);
  }else{
  imagejpeg($im,$vdir_upload . "large_" . $fupload_name);
  }
    
  //Hapus gambar di memori komputer
  imagedestroy($im_src);
  imagedestroy($im);
}
?>
