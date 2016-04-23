<script language="javascript">
function validasipassword(form){
  if (form.passwordlama.value == ""){
    alert("Anda belum mengisikan password lama");
    form.passwordlama.focus();
    return (false);
  } 
  else if (form.passwordbaru.value == ""){
    alert("Anda belum mengisikan password baru");
    form.passwordbaru.focus();
    return (false);
  }
  else {
	return (true);
  }
}
</script>

<script language="javascript">
function validasidatadiri(form){
  if (form.nama.value == ""){
    alert("Anda belum mengisikan nama");
    form.nama.focus();
    return (false);
  } 
  else if (form.email.value == ""){
    alert("Anda belum mengisikan email");
    form.email.focus();
    return (false);
  }
  else if (form.telp.value == ""){
    alert("Anda belum mengisikan no telepon");
    form.telp.focus();
    return (false);
  }
  else if (form.alamat.value == ""){
    alert("Anda belum mengisikan alamat");
    form.alamat.focus();
    return (false);
  }
  else {
	return (true);
  }
}
</script>

<?php

if (empty($_SESSION['namalengkap'])){
	echo "<script>window.location=('login')</script>";
} else {
			
		//If the form is submitted
		if(isset($_POST['submitpassword'])) {
			
			 $pass = mysql_query("SELECT password from kustomer WHERE id_kustomer = '$_SESSION[id]'");
			 $rpass = mysql_fetch_array($pass);
			 
		   // cek password
			if($_POST['passwordlama'] == $rpass[password]) {
				$passbaru = trim($_POST['passwordbaru']);
			} else {
				 echo "<script>window.alert('Isikan password lama dengan benar');
				window.location=('account')</script>";
				$hasError = true;
			}
				
			// upon no failure errors let's email now!
			if(!isset($hasError)) {
				
			  mysql_query("UPDATE kustomer SET password = '$passbaru'
					WHERE id_kustomer = '$_SESSION[id]'");

			  echo "<script>window.alert('Terimakasih, password anda telah diperbaharui');
				window.location=('account')</script>";
			}
			  
		}
		
		//If the form is submitted
		if(isset($_POST['submitdatadiri'])) {
			
		   // require a name from user
			if(trim($_POST['nama']) == '') {
				 echo "<script>window.alert('Anda Belum Mengisi Nama');
				window.location=('account')</script>";
				$hasError = true;
			} else {
				$nama = trim($_POST['nama']);
			}
			
		  // need valid email
			if(trim($_POST['email']) == '')  {
			  echo "<script>window.alert('Anda Belum Mengisi Email');
					window.location=('hubungi-kami.html')</script>";
				$hasError = true;
			} else if (!preg_match("/^[[:alnum:]][a-z0-9_.-]*@[a-z0-9.-]+\.[a-z]{2,4}$/i", trim($_POST['email']))) {
			  echo "<script>window.alert('Anda Salah Mengisi Alamat Email');
					window.location=('account')</script>";
					$hasError = true;
			} else {
				$email = trim($_POST['email']);
			}
		   // require a name from user
			if(trim($_POST['telp']) == '') {
				 echo "<script>window.alert('Anda Belum Mengisi no telepon');
				window.location=('account')</script>";
				$hasError = true;
			} else {
				$telp = trim($_POST['telp']);
			}
			   // we need at least some content
			if(trim($_POST['alamat']) == '') {
				 echo "<script>window.alert('Anda Belum Mengisi Alamat');
				window.location=('account')</script>";
				$hasError = true;
			} else {
				if(function_exists('stripslashes')) {
					$alamat = stripslashes(trim($_POST['alamat']));
				} else {
					$alamat = trim($_POST['alamat']);
				}
			}
				
			// upon no failure errors let's email now!
			if(!isset($hasError)) {
				
				//insert
			  mysql_query("UPDATE kustomer set nama = '$nama',
											   email= '$email',
											   telp = '$telp',
											   alamat= '$alamat' 
							WHERE id_kustomer ='$_SESSION[id]'");

			  echo "<script>window.alert('Data Anda Telah di update');
				window.location=('account')</script>";
			}
		}
		$data = mysql_query("SELECT * from kustomer WHERE id_kustomer = '$_SESSION[id]'");	 
		$rdata = mysql_fetch_array($data);
	echo '
<div class="container">
		<div class="row">
			<div class="block block-breadcrumbs">
				<ul>
					<li class="home">
						<a href="./"><i class="fa fa-home"></i></a>
						<span></span>
					</li>
					<li>Account</li>
				</ul>
			</div>
			<div class="row">';
					include 'kanan.php';
				echo '	
				<div class="col-xs-6 col-sm-8 col-md-9">
					<h1 class="page-title">My Account</h1>
					<div class="page-content">
						<div class="row">
							<div class="col-sm-6">
								<div class="box-border">
									<h4> Profil </h4>
									<form action="account" method="post"  onSubmit=\'return validasidatadiri(this)\'>
									<p>
									  <label>Nama <span class="required">*</span></label>
									  <input type="text" value="'.$rdata[nama].'" name="nama">
									</p>
									<p>
									  <label for="email">Email <span class="required">*</span></label>
									  <input type="text" value="'.$rdata[email].'" name="email">
									</p>

									<p>
									  <label for="url">Telepon</label>
									  <input type="text" value="'.$rdata[telp].'" name="telp">
									</p>
								  
									<p>
									  <label for="comment">Alamat</label>
									  <textarea name="alamat">'.$rdata[alamat].'</textarea>
									</p>
									<p> 
									  <input type="hidden" name="id" value="'.$_SESSION['id'].'"/>
									  <input type="hidden" name="submitdatadiri" value="true" />
									  <input type="submit" class="button" value="UPDATE" tabindex="5" id="submit" name="submit">
									</p>
									</form>
               						
								</div>
							</div>
						<div class="col-sm-6">
							<div class="box-border">
								<h4>Password </h4>
								<form action="account" method="post" onSubmit=\'return validasipassword(this)\'> 
								<p>
									<label>Password Lama </label>
									<input type="password" name="passwordlama">
								</p>
								<p>
									<label>Password Baru</label>
									<input type="password" name="password">
								</p>
								<p>
									<input type="hidden" name="id" value="'.$_SESSION['id'].'"/>
									<input type="hidden" name="submitpassword" value="true" />
									<input type="submit" class="button" value="UPDATE" id="submit" name="UPDATE">
								</p>
								</form>
							</div>
							</div>
							<div class="col-sm-6">
							<div class="box-border">
							<div class="control-group">
								<form action="aksi.php?module=account&act=input" method="post">
								<label class="control-label">Gambar</label>
								<div class="controls">
									<input type=file name="fupload" size=40>
									<br>(*) Tipe gambar harus JPG/JPEG 
									<br>(*) ukuran min: 490px X 366px
									<p>
									<input type="hidden" name="id" value="'.$_SESSION['id'].'"/>
									<input type="submit" class="button" value="UPDATE" id="submit" name="UPDATE">
									</p>
								</div>
								</form>
							</div>
							</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
';
}
?>