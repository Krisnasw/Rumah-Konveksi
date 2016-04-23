<?php
session_start();
 if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
$aksi="modul/mod_profilmu/aksi_profilmu.php";
switch($_GET[act]){
  // Tampil Profil
  default:
    $sql  = mysql_query("SELECT * FROM users WHERE username='$_SESSION[namauser]'");
    $r    = mysql_fetch_array($sql);

    echo '
		<div>
			<ul class="breadcrumb">
				<li>
					<a href="?module=home">Home</a> <span class="divider">/</span>
				</li>
				<li>
					<a href="#">Edit Profil</a>
				</li>
			</ul>
		</div>
		<div class="row-fluid sortable">
			<div class="box span12">
				<div class="box-header well" data-original-title>
					<h2><i class="icon-edit"></i>Edit Profil</h2>
					<div class="box-icon">
						<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
						<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
					</div>
				</div>
				<div class="box-content">
					<form class="form-horizontal" method="POST" enctype="multipart/form-data" action="'.$aksi.'?module=profilmu&act=update">
						<fieldset>
							<input type=hidden name=id value="'.$r[id_users].'">
							<div class="control-group">
								<label class="control-label">Gambar</label>
								<div class="controls">
									<img src="../foto_banner/'.$r[gambar].'" style="width:150px;">
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Ganti Foto</label>
								<div class="controls">
									<input type="file" name="fupload">
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Nama Lengkap</label>
								<div class="controls">
								  <input type=text name="nama" value="'.$r[nama_lengkap].'" />
								</div>
							
							</div>
							
							<div class="control-group">
								<label class="control-label">Email</label>
								<div class="controls">
								  <input type=email name="email" value="'.$r[email].'" />
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Kontak</label>
								<div class="controls">
								  <input type=text name="no_telp" value="'.$r[no_telp].'" />
								</div>
							</div>
							<div class="form-actions">
								<input type=submit value=Update class="btn btn-primary">
								<input type=button value=Batal onclick=self.history.back() class="btn">
							</div>
						</fieldset>
					</form>
				</div>
			</div>
		</div>
	';
	
    break;  
}
}
?>
