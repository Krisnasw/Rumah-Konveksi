<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
$aksi="modul/mod_profil/aksi_profil.php";
switch($_GET[act]){
  // Tampil Profil
  default:
    $sql  = mysql_query("SELECT * FROM modul WHERE id_modul='43'");
    $r    = mysql_fetch_array($sql);

    echo '
		<div>
			<ul class="breadcrumb">
				<li>
					<a href="?module=home">Home</a> <span class="divider">/</span>
				</li>
				<li>
					<a href="#">Profil</a>
				</li>
			</ul>
		</div>
		<div class="row-fluid sortable">
			<div class="box span12">
				<div class="box-header well" data-original-title>
					<h2><i class="icon-edit"></i> Profil</h2>
					<div class="box-icon">
						<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
						<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
					</div>
				</div>
				<div class="box-content">
					<form class="form-horizontal" method="POST" enctype="multipart/form-data" action="'.$aksi.'?module=profil&act=update">
						<fieldset>
							<input type=hidden name=id value="43">
							<div class="control-group">
								<label class="control-label">Gambar</label>
								<div class="controls">
									<img src="../files/'.$r[gambar].'" style="width:150px;">
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Ganti Foto</label>
								<div class="controls">
									<input type="file" name="fupload">
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Profil</label>
								<div class="controls">
									<textarea name=isi style="width: 560px; height: 250px;">'.$r[static_content].'</textarea>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Alamat</label>
								<div class="controls">
									<textarea name=alamat style="width: 560px; height: 200px;">'.$r[alamat].'</textarea>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Kontak</label>
								<div class="controls">
									<textarea name=kontak style="width: 560px; height: 150px;">'.$r[kontak].'</textarea>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Jam Operasional</label>
								<div class="controls">
									<textarea name=jam style="width: 560px; height: 150px;">'.$r[jam].'</textarea>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Keterangan</label>
								<div class="controls">
									<textarea name=keterangan style="width: 560px; height: 100px;">'.$r[meta_keyword].'</textarea>
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
