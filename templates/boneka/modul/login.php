<script language="javascript">
function validasi(form){
 if (form.email.value == ""){
    alert("Anda belum mengisikan Email");
    form.email.focus();
    return (false);
  }
  else if (form.password.value == ""){
    alert("Anda belum mengisikan password");
    form.password.focus();
    return (false);
  }
  else {
	return (true);
  }
}
</script>
<script language="javascript">
function validasiregister(form){
if (form.nama.value == ""){
    alert("Anda belum mengisikan Nama");
    form.nama.focus();
    return (false);
  }else if (form.email.value == ""){
    alert("Anda belum mengisikan Email");
    form.email.focus();
    return (false);
  }
  else if (form.password.value == ""){
    alert("Anda belum mengisikan password");
    form.password.focus();
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
			window.location=('login')</script>";
        $hasError = true;
    } else if (!preg_match("/^[[:alnum:]][a-z0-9_.-]*@[a-z0-9.-]+\.[a-z]{2,4}$/i", trim($_POST['email']))) {
	  echo "<script>window.alert('Anda Salah Mengisi Alamat Email');
			window.location=('login')</script>";
			$hasError = true;
    } else {
        $email = trim($_POST['email']);
    }
	   // we need at least some content
    if(trim($_POST['password']) === '') {
         echo "<script>window.alert('Anda Belum Mengisi password');
        window.location=('login')</script>";
        $hasError = true;
    } else {
        if(function_exists('stripslashes')) {
            $password = stripslashes(trim($_POST['password']));
        } else {
            $password = trim($_POST['password']);
            $password = md5($password);
        }
    }
        
    // upon no failure errors let's email now!
    if(!isset($hasError)) {
        /*---------------------------------------------------------*/
        /* SET EMAIL YOUR EMAIL ADDRESS HERE                       */
        /*---------------------------------------------------------*/
     /*    $emailTo = 'andhika.tri@gmail.com';
        $emailToAdmin = 'produkbangsa@gmail.com';
        $subject = 'Submitted message from '.$name;
        $sendCopy = trim($_POST['sendCopy']);
        $body = "Name: $name \n\nEmail: $email \n\nComments: $pesan";
        $headers = 'From: ' .' <'.$emailToAdmin.'>' . "\r\n" . 'Reply-To: ' . $email;
	*/
        // mail($emailTo, $subject, $body, $headers);
        
        // set our boolean completion value to TRUE
        // $emailSent = true;
		
		//insert
	  mysql_query("INSERT INTO kustomer(nama,
									   email,
									   password,
									   tgl_daftar) 
							VALUES('$nama',
								   '$email',
								   '$password',
								   '$tgl_sekarang')");

	  echo "<script>window.alert('Terimakasih telah Mendaftar.');
        window.location=('./')</script>";
    }
}

if (empty($_SESSION['namalengkap'])){
?>
<!-- ./header -->
	<div class="container">
		<div class="row">
			<div class="block block-breadcrumbs">
				<ul>
					<li class="home">
						<a href="./"><i class="fa fa-home"></i></a>
						<span></span>
					</li>
					<li> Login </li>
				</ul>
			</div>
			<div class="main-page">
				<h1 class="page-title">Authentication</h1>
				<div class="page-content">
		            <div class="row">
		            	<div class="col-sm-6">
		            		<div class="box-border">
		            			<h4> Login </h4>
								<small> &nbsp; </small>
								<form action="cek_login.php" method="post" onSubmit='return validasi(this)'>
		            			<p>
		            				<label>Email</label>
		            				<input type="text" name="email">
		            			</p>
		            			<p>
		            				<label>Password</label>
		            				<input type="password" name="password">
		            			</p>
		            			<p>
		            				<a href="forget-password">Forgot your password?</a>
		            			</p>
		            			<p>
		            				<button class="button"><i class="fa fa-lock"></i> Login </button>
		            			</p>
								</form>
		            		</div>
		            	</div>
		            	<div class="col-sm-6">
		            	<div class="box-border">
		            		<h4>Daftar </h4>
							<small> &nbsp; </small>
							<form action="login" method="post" onSubmit='return validasiregister(this)'>
	            			<p>
	            				<label>Nama </label>
	            				<input type="text" name="nama">
	            			</p><p>
	            				<label>Email </label>
	            				<input type="text" name="email">
	            			</p>
							<p>
								<label>Password</label>
								<input type="password" name="password">
							</p>
	            			<p>
	            				<button class="button"><i class="fa fa-user"></i> Create </button>
								<input type="hidden" name="submitted" id="submitted" value="true" />
	            			</p>
							</form>
		            	</div>
		            	</div>
		            </div>
		        </div>
			</div>
		</div>
	</div>
<?php
} else {
	echo "<script>window.location=('account')</script>";
}
?>