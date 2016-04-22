<?php
$subject = $_POST['subject'];
$email  = $_POST['email'];
$order_reference = $_POST['order_reference'];
$message = $_POST['message'];
if($email==""){
    echo "<div class='alert alert-warning'><i class='fa fa-exclamation-triangle'></i> <span>Please enter your email address.</span></div>";
    die;
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  echo "<div class='alert alert-warning'><i class='fa fa-exclamation-triangle'></i> <span>Invalid email format.</span></div>"; 
  die;
}
if($message==""){
    echo "<div class='alert alert-warning'><i class='fa fa-exclamation-triangle'></i> <span>Please enter message.</span></div>";
    die;
}
$to      = 'webmaster@example.co';
$headers = 'From: webmaster@example.com' . "\r\n" .
    'Reply-To: webmaster@example.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();
$message.=" <br> Order Reference: ".$order_reference;
if(mail($to, $subject, $message, $headers)){
    die('done');
}else{
    echo "<i class='fa fa-exclamation-triangle'></i> <span>Send message error.</span>";
    die;
}
?> 
<?php