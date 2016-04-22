<?php
session_start();
 if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
	echo '
		<div>
			<ul class="breadcrumb">
				<li>
					<a href="?module=home">Home</a> <span class="divider">/</span>
				</li>
				<li>
					<a href="#">Ganti Password</a>
				</li>
			</ul>
		</div>
		<div class="row-fluid sortable">
			<div class="box span12">
				<div class="box-header well" data-original-title>
					<h2><i class="icon-edit"></i> Ganti Password</h2>
					<div class="box-icon">
						<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
						<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
					</div>
				</div>
				<div class="box-content">
					<form class="form-horizontal" method=POST action=modul/mod_password/aksi_password.php>
						<fieldset>
							<div class="control-group">
								<label class="control-label">Password Lama</label>
								<div class="controls">
								  <input type=text name="pass_lama" />
								</div>
							</div>	
							<div class="control-group">
								<label class="control-label">Password Baru</label>
								<div class="controls">
								  <input type=text name="pass_baru" />
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Ulangi Password Baru</label>
								<div class="controls">
								  <input type=text name="pass_ulangi" />
								</div>
							</div>
							<div class="form-actions">
								<input type=submit value=Proses class="btn btn-primary">
								<input type=button value=Batal onclick=self.history.back() class="btn">
							</div>
						</fieldset>
					</form>
				</div>
			</div>
		</div>
	';
}
?>
