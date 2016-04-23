<?php
include "config/koneksi.php";
function antiinjection($data){
  $filter_sql = mysql_real_escape_string(stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES))));
  return $filter_sql;
}

$email	  = antiinjection($_POST['email']);
$pass     = antiinjection($_POST['password']);

$kar1=strstr($_POST['email'], "@");
$kar2=strstr($_POST['email'], ".");

$log=mysql_query("SELECT * FROM kustomer WHERE email='$email' AND password='$pass'");
$ketemu=mysql_num_rows($log);
$r=mysql_fetch_array($log);

// Apabila password ditemukan
if ($ketemu > 0){
  session_start();

  $_SESSION[id]  		  = $r[id_kustomer];
  $_SESSION[namalengkap]  = $r[nama];
  $_SESSION[passuser]     = $r[password];
  $_SESSION[email]	      = $r[email];
  $_SESSION[alamat]       = $r[alamat];
  $_SESSION[telp]	      = $r[telp];
  
  // cek id_session
  $sid = session_id();
  $sql = mysql_query("SELECT * FROM orders_temp ot LEFT JOIN produk p 
				ON ot.id_produk=p.id_produk WHERE ot.id_session='$sid'");
  $ketemuid=mysql_num_rows($sql);	
  if($ketemuid < 1){
	header('location:account');
  } else {
	header('location:check-out');	  
  }
}
elseif (strlen($kar1)==0 OR strlen($kar2)==0){
  echo "<script>window.alert('Alamat Email Anda Salah');
        window.location=('login')</script>";
}
else{  
	echo "<script>window.alert('Maaf, Email atau Password Anda Salah');
        window.location=('login')</script>";
}
?>