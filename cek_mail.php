<?php
include "config/koneksi.php";
function antiinjection($data){
  $filter_sql = mysql_real_escape_string(stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES))));
  return $filter_sql;
}

$email	  = antiinjection($_POST['email']);

$kar1=strstr($_POST['email'], "@");
$kar2=strstr($_POST['email'], ".");

$log=mysql_query("SELECT * FROM kustomer WHERE email='$email'");
$r=mysql_fetch_array($log);

if($r['email'] == $email){
  echo "<script>window.location='mail/mail.php?module=resetpass&id=$r[id_kustomer]'</script>";
}
elseif (strlen($kar1)==0 OR strlen($kar2)==0){
  echo "<script>window.alert('Alamat Email Anda Salah');
        window.location=('forget-password')</script>";
}
else{
  echo "<script>alert('Email Not Found !'); window.location=('forget-password')</script>";
}
?>