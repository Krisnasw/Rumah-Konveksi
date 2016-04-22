<?php
//error_reporting(E_ALL);
include "../config/koneksi.php";
include "../config/library.php";
include "../config/fungsi_rupiah.php";

if ($_GET['module'] =='resetpass' ) {

   $id = $_GET['id'];
    list($alamat_website) = mysql_fetch_array(mysql_query("SELECT alamat_website FROM identitas WHERE id_identitas='1'"));
    
    $data = mysql_query("SELECT * FROM kustomer WHERE id_kustomer ='$id'");
    $rdata = mysql_fetch_array($data);
    
    $mail_klien = $rdata['email']; 
    $id_kustomer = $rdata['id_kustomer'];

$html = '
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1"> <!-- So that mobile will display zoomed in -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge"> <!-- enable media queries for windows phone 8 -->
  <meta name="format-detection" content="telephone=no"> <!-- disable auto telephone linking in iOS -->
  <title>Single Column</title>
  
  <style type="text/css">
body {
  margin: 0;
  padding: 0;
  -ms-text-size-adjust: 100%;
  -webkit-text-size-adjust: 100%;
}

table {
  border-spacing: 0;
}

table td {
  border-collapse: collapse;
}

.ExternalClass {
  width: 100%;
}

.ExternalClass,
.ExternalClass p,
.ExternalClass span,
.ExternalClass font,
.ExternalClass td,
.ExternalClass div {
  line-height: 100%;
}

.ReadMsgBody {
  width: 100%;
  background-color: #ebebeb;
}

table {
  mso-table-lspace: 0pt;
  mso-table-rspace: 0pt;
}

img {
  -ms-interpolation-mode: bicubic;
}

.yshortcuts a {
  border-bottom: none !important;
}

@media screen and (max-width: 599px) {
  .force-row,
  .container {
    width: 100% !important;
    max-width: 100% !important;
  }
}
@media screen and (max-width: 400px) {
  .container-padding {
    padding-left: 12px !important;
    padding-right: 12px !important;
  }
}
.ios-footer a {
  color: #aaaaaa !important;
  text-decoration: underline;
}
</style>
</head>

<body style="margin:0; padding:0;" bgcolor="#F0F0F0" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">

<!-- 100% background wrapper (grey background) -->
<table border="0" width="100%" height="100%" cellpadding="0" cellspacing="0" bgcolor="#F0F0F0">
  <tr>
    <td align="center" valign="top" bgcolor="#F0F0F0" style="background-color: #F0F0F0;">

      <br>
      <!-- 600px container (white background) -->
      <table border="0" width="600" cellpadding="0" cellspacing="0" class="container" style="width:600px;max-width:600px">
        <tr>
          <td class="container-padding header" align="left" style="font-family:Helvetica, Arial, sans-serif;font-size:24px;font-weight:bold;padding-bottom:12px;color:#DF4726;padding-left:24px;padding-right:24px">
            &nbsp;
          </td>
        </tr>
        <tr>
          <td class="container-padding content" align="left" style="padding-left:24px;padding-right:24px;padding-top:12px;padding-bottom:12px;background-color:#ffffff">
            <br>

<div class="title" style="font-family:Helvetica, Arial, sans-serif;font-size:18px;font-weight:600;color:#374550">RESET YOUR PASSWORD</div>
<br>

<div class="body-text" style="font-family:Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;text-align:left;color:#333333">
  
  Hi '.$rdata['nama'].',
  We were told that you forgot your password on Boneka Shop.<br>
  To reset your password, please click this link :<br>
    <a href="'.$alamat_website.'/reset-password-'.$id_kustomer.'" target="_blank">Reset Password</a>
  <br><br>
  Thanks,<br>
  AksaMedia Tim.
  <br><br>
</div>

          </td>
        </tr>
        <tr>
          <td class="container-padding footer-text" align="left" style="font-family:Helvetica, Arial, sans-serif;font-size:12px;line-height:16px;color:#aaaaaa;padding-left:24px;padding-right:24px">
            <br><br>
            <a href="'.$alamat_website.'" style="color:#aaaaaa" target="_blank">'.$alamat_website.'</a> © 2015 AksaMedia Tim.
            <br><br>

            <br>
            <br><br>

          </td>
        </tr>
      </table>
    </td>
  </tr>
</table>
</body>
</html>
';
/**
 * This example shows settings to use when sending via Google's Gmail servers.
 */

//SMTP needs accurate times, and the PHP time zone MUST be set
//This should be done in your php.ini, but this is how to do it if you don't have access to that
date_default_timezone_set('Etc/UTC');

require 'PHPMailerAutoload.php';

//Create a new PHPMailer instance
$mail = new PHPMailer;

//Tell PHPMailer to use SMTP
$mail->isSMTP();

//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
$mail->SMTPDebug = 0;

//Ask for HTML-friendly debug output
$mail->Debugoutput = 'html';

//Set the hostname of the mail server
$mail->Host = 'smtp.gmail.com';

//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
$mail->Port = 587;

//Set the encryption system to use - ssl (deprecated) or tls
$mail->SMTPSecure = 'tls';

//Whether to use SMTP authentication
$mail->SMTPAuth = true;

//Username to use for SMTP authentication - use full email address for gmail
$mail->Username = "developer.aksamedia@gmail.com";

//Password to use for SMTP authentication
$mail->Password = "12345jos";

//Set who the message is to be sent from
$mail->setFrom('developer.aksamedia@gmail.com', 'RESET YOUR PASSWORD');

//Set an alternative reply-to address
$mail->addReplyTo("$mail_klien", 'RESET YOUR PASSWORD');

//Set who the message is to be sent to
$mail->addAddress("$mail_klien", "$mail_klien");

//Set the subject line
$mail->Subject = 'RESET PASSWORD';

//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
//$mail->msgHTML("$html");
$mail->isHTML(true);
$mail->Body = $html;

//Replace the plain text body with one created manually
//$mail->AltBody = 'This is a plain-text message body';

//Attach an image file
//$mail->addAttachment('images/phpmailer_mini.png');

//send the message, check for errors
  if (!$mail->send()) {
  
    $data = array("domain" => "boneka_zalora", "email_tujuan" => "$mail_klien", "judul" => "RESET YOUR PASSWORD", "body" => "$html");                                                                    
  $data_string = http_build_query($data);                                                                                   
                                                                                                                       
  $ch = curl_init('http://103.11.74.16/~k4127357/services/mail.php');                                                                      
  curl_setopt($ch, CURLOPT_POST, true);                                                                     
  curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
  curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);                                                                                                                                                                                                                                                                                               
  $result = curl_exec($ch);
  
  echo "<script>alert('Kami akan mengirimkan alamat untuk reset password ke email anda.'); window.location='$alamat_website'</script>";
  } else {
      echo "<script>window.location='$alamat_website'</script>";
  }
} 


if ($_GET['module'] =='checkout' ) {

  list($alamat_website) = mysql_fetch_array(mysql_query("SELECT alamat_website FROM identitas WHERE id_identitas='1'"));
  
  $kode_orders =  $_POST['kode_orders']; 
  $sid = $_POST['id_session'];   
  $sqlproduk = mysql_query("SELECT id_produk FROM orders_temp WHERE id_session='$sid'");
   
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $alamat = $_POST['alamat'];
    $telp = $_POST['telp'];
    $total = $_POST['total']; 
  
    // put the product in cart table
    mysql_query("INSERT INTO orders (kode_orders, id_kustomer, id_session, status_order, tgl_order, jam_order, nama_pemesan, email, alamat, telp, jumlah_dibayar)
          VALUES ('$kode_orders', '$_POST[id_kustomer]', '$sid','Baru', '$tgl_sekarang', '$jam_sekarang','$nama', '$email', '$alamat', '$telp', '$total')");
            
    while ($rpro = mysql_fetch_array ($sqlproduk)) {
        
    $sql2 = mysql_query("SELECT stok,dibeli FROM produk WHERE id_produk='$rpro[id_produk]'");
    $r=mysql_fetch_array($sql2);
    
    $sql = mysql_query("SELECT jumlah FROM orders_temp
          WHERE id_produk='$rpro[id_produk]' AND id_session='$sid'");
    $rsql=mysql_fetch_array($sql);
    
    $stok=$r['stok'];
    $jml = $rsql['jumlah'];
    
    $dibeli = $r['dibeli'] + $jml;
    $stok_baru = $stok - $jml;    

    mysql_query("INSERT INTO orders_detail (id_produk, jumlah, id_kustomer, kode_orders)
            VALUES ('$rpro[id_produk]', '$jml', '$_POST[id_kustomer]', '$_POST[kode_orders]')");
    }       
      
  $sqlorder=mysql_query("SELECT * FROM orders_detail, produk 
                     WHERE orders_detail.id_produk=produk.id_produk 
                     AND orders_detail.kode_orders='$kode_orders'");
        // email admin   
  $emailx = mysql_query("SELECT * FROM email WHERE id_email='1'");
  $remail = mysql_fetch_array($emailx);
             

$body_mail = '
<!DOCTYPE html">
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1"> <!-- So that mobile will display zoomed in -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge"> <!-- enable media queries for windows phone 8 -->
  <meta name="format-detection" content="telephone=no"> <!-- disable auto telephone linking in iOS -->
  <title>Single Column</title>
  
  <style type="text/css">
body {
  margin: 0;
  padding: 0;
  -ms-text-size-adjust: 100%;
  -webkit-text-size-adjust: 100%;
}

table {
  border-spacing: 0;
}

table td {
  border-collapse: collapse;
}

.ExternalClass {
  width: 100%;
}

.ExternalClass,
.ExternalClass p,
.ExternalClass span,
.ExternalClass font,
.ExternalClass td,
.ExternalClass div {
  line-height: 100%;
}

.ReadMsgBody {
  width: 100%;
  background-color: #ebebeb;
}

table {
  mso-table-lspace: 0pt;
  mso-table-rspace: 0pt;
}

img {
  -ms-interpolation-mode: bicubic;
}

.yshortcuts a {
  border-bottom: none !important;
}

@media screen and (max-width: 599px) {
  .force-row,
  .container {
    width: 100% !important;
    max-width: 100% !important;
  }
}
@media screen and (max-width: 400px) {
  .container-padding {
    padding-left: 12px !important;
    padding-right: 12px !important;
  }
}
.ios-footer a {
  color: #aaaaaa !important;
  text-decoration: underline;
}
</style>
</head>

<body style="margin:0; padding:0;" bgcolor="#F0F0F0" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">

<!-- 100% background wrapper (grey background) -->
<table border="0" width="100%" height="100%" cellpadding="0" cellspacing="0" bgcolor="#F0F0F0">
  <tr>
    <td align="center" valign="top" bgcolor="#F0F0F0" style="background-color: #F0F0F0;">

      <br>
      <!-- 600px container (white background) -->
      <table border="0" width="600" cellpadding="0" cellspacing="0" class="container" style="width:600px;max-width:600px">
        <tr>
          <td class="container-padding header" align="left" style="font-family:Helvetica, Arial, sans-serif;font-size:24px;font-weight:bold;padding-bottom:12px;color:#DF4726;padding-left:24px;padding-right:24px">
            &nbsp;
          </td>
        </tr>
        <tr>
          <td class="container-padding content" align="left" style="padding-left:24px;padding-right:24px;padding-top:12px;padding-bottom:12px;background-color:#ffffff">
            <br>

<div class="title" style="font-family:Helvetica, Arial, sans-serif;font-size:18px;font-weight:600;color:#374550">Pesanan Anda Dari Toko Boneka</div>
<br>

<div class="body-text" style="font-family:Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;text-align:left;color:#333333">';


  $body_mail .= "<h2>Berikut Detail Pesanan Anda </h2>";
  $body_mail .= "$remail[header]";
           
  $body_mail .= "<h3>Kode Order $kode_orders </h3>";
  $body_mail .= "  
          <table border='0' width='400' class='container' style='width:400px;max-width:400px'>
            <thead>
              <tr>
                <th class='container-padding content'>Nama Produk</th>
                <th class='container-padding content'>Jumlah</th>
                <th align=rightclass='container-padding content'>Harga Satuan</th>
                <th align=rightclass='container-padding content'>Sub Total</th>
              </tr>
            </thead>
            <tbody>";     
  $nn = 0;
  $totalharga = 0;
  while($s=mysql_fetch_array($sqlorder)){
    // rumus untuk menghitung subtotal dan total    
    if($s['diskon'] != 0){
      $disc   = ($s['diskon']/100)*$s['harga'];
      $harga  = $s['harga']-$disc; 
    }
    else{
      $harga  = $s['harga'];
    }
    
    $subtotal    = $harga * $s['jumlah'];
    $totalharga     = $totalharga + $subtotal;
    $harga_rp = format_rupiah($harga);
    $subtotal_rp = format_rupiah($subtotal);    
    $total_rp    = format_rupiah($totalharga);
    
    $body_mail .='<tr>
          <td class="container-padding content">'.$s['nama_produk'].'</td>
          <td align=center class="container-padding content">'.$s['jumlah'].'</td>
          <td align=right class="container-padding content">Rp. '.$harga_rp.'</td>
          <td align=right class="container-padding content">Rp. '.$subtotal_rp.'</td>
        </tr>'        
      ;
    $nn++;
  } 
  $body_mail .= '
            <tr>
              <td colspan=3 align=right>Total : </td>
              <td align=right><b>Rp. '.$total_rp.'</b></td>
            </tr>  
            </tbody>
          </table>';
  


$body_mail .='  
</div>
          </td>
        </tr>
        <tr>
          <td class="container-padding footer-text" align="left" style="font-family:Helvetica, Arial, sans-serif;font-size:12px;line-height:16px;color:#aaaaaa;padding-left:24px;padding-right:24px">
            <br><br>
            <a href="'.$alamat_website.'" style="color:#aaaaaa" target="_blank">'.$alamat_website.'</a> © 2015 AksaMedia Tim.
            <br><br>

            <br>
            <br><br>

          </td>
        </tr>
      </table>
    </td>
  </tr>
</table>
</body>
</html>
';
      deleteCart($sid);

date_default_timezone_set('Etc/UTC');

require 'PHPMailerAutoload.php';

//Create a new PHPMailer instance
$mail = new PHPMailer;

//Tell PHPMailer to use SMTP
$mail->isSMTP();

//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
$mail->SMTPDebug = 0;

//Ask for HTML-friendly debug output
$mail->Debugoutput = 'html';

//Set the hostname of the mail server
$mail->Host = 'smtp.gmail.com';

//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
$mail->Port = 587;

//Set the encryption system to use - ssl (deprecated) or tls
$mail->SMTPSecure = 'tls';

//Whether to use SMTP authentication
$mail->SMTPAuth = true;

//Username to use for SMTP authentication - use full email address for gmail
$mail->Username = "developer.aksamedia@gmail.com";

//Password to use for SMTP authentication
$mail->Password = "12345jos";

//Set who the message is to be sent from
$mail->setFrom('developer.aksamedia@gmail.com', 'Pesanan Toko Boneka');

//Set an alternative reply-to address
$mail->addReplyTo('developer.aksamedia@gmail.com', 'Pesanan Toko Boneka');

//Set who the message is to be sent to
$mail->addAddress("$email", "$email");

//Set the subject line
$mail->Subject = 'Pesanan Anda';

//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
//$mail->msgHTML("$html");
$mail->isHTML(true);
$mail->Body = $body_mail;

//Replace the plain text body with one created manually
//$mail->AltBody = 'This is a plain-text message body';

//Attach an image file
//$mail->addAttachment('images/phpmailer_mini.png');

//send the message, check for errors
  if (!$mail->send()) {
  
  $data = array("domain" => "Toko Boneka", "email_tujuan" => "$email", "judul" => "Pesanan dari Toko Boneka", "body" => "$body_mail");                                                                    
  $data_string = http_build_query($data);                                                                                   
                                                                                                                       
  $ch = curl_init('http://103.11.74.16/~k4127357/services/mail.php');                                                                      
  curl_setopt($ch, CURLOPT_POST, true);                                                                     
  curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
  curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);                                                                                                                                                                                                                                                                                               
  $result = curl_exec($ch);
  
  echo "<script>alert('Kami akan mengirimkan detail produk ke email anda.'); window.location='$alamat_website'</script>";
  } 
  else {
      echo "<script>window.location='$alamat_website'</script>";
  }
 
}


function deleteCart($sid){
  mysql_query("DELETE FROM orders_temp WHERE id_session = '$sid'");
}