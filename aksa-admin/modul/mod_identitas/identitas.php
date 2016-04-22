<?php
$aksi="modul/mod_identitas/aksi_identitas.php";
switch($_GET[act]){
  // Tampil identitas
  default:
    $sql  = mysql_query("SELECT * FROM identitas WHERE id_identitas = 1");
    $r    = mysql_fetch_array($sql);

    echo '
		<div>
			<ul class="breadcrumb">
				<li>
					<a href="?module=home">Home</a> <span class="divider">/</span>
				</li>
				<li>
					<a href="#">Identitas Web</a>
				</li>
			</ul>
		</div>
		<div class="row-fluid sortable">
			<div class="box span12">
				<div class="box-header well" data-original-title>
					<h2><i class="icon-edit"></i> Edit Identitas Website</h2>
					<div class="box-icon">
						<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
						<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
					</div>
				</div>
				<div class="box-content">
					<form class="form-horizontal" method=POST enctype="multipart/form-data" action='.$aksi.'?module=identitas&act=update>
						<fieldset>
							<div class="control-group">
								<label class="control-label">Alamat Website</label>
								<div class="controls">
									<input type=hidden name="id" value="'.$r[id_identitas].'">
									<input type="text" class="input-xlarge" name="alamat_website" value="'.$r[alamat_website].'" class="span6">
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Nama Website</label>
								<div class="controls">
									<input type="text" name="nama_website" class="input-xlarge" value="'.$r[nama_website].'" class="span6">
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Meta Deskripsi</label>
								<div class="controls">
									<textarea name="meta_deskripsi" style="width: 560px; height: 150px;">'.$r[meta_deskripsi].' </textarea>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Meta Keyword</label>
								<div class="controls">
									<textarea name="meta_keyword" style="width: 560px; height: 150px;">'.$r[meta_keyword].'</textarea>
								</div>
							</div>
						
							<div class="control-group">
								<label class="control-label">Logo</label>
								<div class="controls">
									<img src=../files/'.$r[logo].' style="width:60px"></td>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Ganti Logo</label>
								<div class="controls">
									<input type=file name=fupload2>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Gambar Favicon</label>
								<div class="controls">
									<img src=../files/'.$r[favicon].'></td>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Ganti Favicon</label>
								<div class="controls">
									<input type=file name=fupload>
								<br>* gambar favicon harus bernama favicon.ico
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
?>