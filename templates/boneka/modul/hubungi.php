<script language="javascript">
function validasi(form){
  if (form.nama.value == ""){
    alert("Anda belum mengisikan Nama");
    form.nama.focus();
    return (false);
  } 
  else if (form.email.value == ""){
    alert("Anda belum mengisikan Email");
    form.email.focus();
    return (false);
  }
  else if (form.pesan.value == ""){
    alert("Anda belum mengisikan Pesan");
    form.pesan.focus();
    return (false);
  }
  else {
    return (true);
  }
}
</script>
<?php
//If the form is submitted
if(isset($_POST['submitted'])) {
    
   // require a name from user
    if(trim($_POST['nama']) === '') {
         echo "<script>window.alert('Anda Belum Mengisi Nama');
        window.location=('hubungi-kami.html')</script>";
        $hasError = true;
    } else {
        $nama = trim($_POST['nama']);
    }
    
  // need valid email
    if(trim($_POST['email']) === '')  {
      echo "<script>window.alert('Anda Belum Mengisi Email');
            window.location=('hubungi-kami.html')</script>";
        $hasError = true;
    } else if (!preg_match("/^[[:alnum:]][a-z0-9_.-]*@[a-z0-9.-]+\.[a-z]{2,4}$/i", trim($_POST['email']))) {
      echo "<script>window.alert('Anda Salah Mengisi Alamat Email');
            window.location=('hubungi-kami.html')</script>";
            $hasError = true;
    } else {
        $email = trim($_POST['email']);
    }
       // we need at least some content
    if(trim($_POST['pesan']) === '') {
         echo "<script>window.alert('Anda Belum Mengisi Pesan');
        window.location=('hubungi-kami.html')</script>";
        $hasError = true;
    } else {
        if(function_exists('stripslashes')) {
            $pesan = stripslashes(trim($_POST['pesan']));
        } else {
            $pesan = trim($_POST['pesan']);
        }
    }
        
    // upon no failure errors let's email now!
    if(!isset($hasError)) {
        /*---------------------------------------------------------*/
        /* SET EMAIL YOUR EMAIL ADDRESS HERE                       */
        /*---------------------------------------------------------*/
        $emailTo = 'andhika.tri@gmail.com';
        $emailToAdmin = 'produkbangsa@gmail.com';
        $subject = 'Submitted message from '.$name;
        $sendCopy = trim($_POST['sendCopy']);
        $body = "Name: $name \n\nEmail: $email \n\nComments: $pesan";
        $headers = 'From: ' .' <'.$emailToAdmin.'>' . "\r\n" . 'Reply-To: ' . $email;

        // mail($emailTo, $subject, $body, $headers);
        
        // set our boolean completion value to TRUE
        // $emailSent = true;
        
        //insert
      mysql_query("INSERT INTO hubungi(nama,
                                       email,
                                       subjek,
                                       pesan,
                                       tanggal,jam) 
                            VALUES('$_POST[nama]',
                                   '$_POST[email]',
                                   '$_POST[subjek]',
                                   '$_POST[pesan]',
                                   '$tgl_sekarang','$jam_sekarang')");

      echo "<script>window.alert('Terimakasih telah menghubungi kami.');
        window.location=('./')</script>";
    }
}
?>
<div id="main-content">
                
                <div class="row-fluid">
                    <div class="span12">
                        <div class="breadcrumb clearfix">
                            <a href="./">Home</a>
                            <span>/</span>
                            <span class="current-page">Contact Us</span>
                        </div>
                    </div><!--span12-->
                </div><!--row-fluid-->
                
                <div id="main-col">
                    
                    <div class="kp-map">
                        <iframe width="100%" scrolling="no" height="400" frameborder="0" src="https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d3966.592300608585!2d106.83063980000001!3d-6.185280099999995!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1sOffice+HR+Building+Jl.+KH.+Wahid+Hasyim+No.+5%2C+Kebon+Sirih+-+Jakarta+10340+!5e0!3m2!1sid!2sid!4v1440203225634" marginwidth="0" marginheight="0" class="google-map"></iframe>
                      
                    </div><!--kp-map-->
                    
                    <div id="contact-box">
                        <h3><span class="title-line"></span><span class="title-text">Contact us</span></h3>               
                        <form id="contact-form" class="clearfix" action="hubungi-kami.html" method="post" onSubmit='return validasi(this)'>
                            <p class="input-block clearfix">
                                <label class="required" for="contact_name">Name (required):</label>
                                <input class="valid ukur" type="text" name="nama" id="author" value="">
                            </p>
                            <p class="input-block">
                                <label class="required" for="contact_email">Email (required):</label>
                                <input type="email" class="valid ukur" name="email" id="email" value="">
                            </p>
                            <p class="input-block clearfix">
                                <label class="required" for="contact_subject">Subjek (required):</label>
                                <input class="valid ukur" type="text" name="subjek" id="subjek" value="">
                            </p>
                            <p class="textarea-block">                        
                                <label class="required" for="contact_message">Pesan (required):</label>
                                <textarea rows='6' cols='80' id="comment" name="pesan" class="ukur"></textarea>
                            </p>                            
                            <p class="contact-button clearfix">                    
                                <input type="submit" id="submit" name="submit" value="Submit" style="display: inline-block; padding: 8px 15px 10px; color: #FFF; background-color: #E03D3D; border: medium none; font-size: 13px; font-style: italic;">
                                <input type="hidden" name="submitted" id="submitted" value="true" />
                            </p>
                            <div class="clear"></div>                        
                        </form>
                        <div id="response"></div>
                    </div><!--contact-box-->
                    
                </div><!--main-col-->
                
                
                <?php include"kanan.php"; ?>
                
            </div><!--main-content-->