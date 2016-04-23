<?php
session_start();
 if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
$aksi="modul/mod_gallery/aksi_gallery.php";
switch($_GET[act]){
  // Tampil Album
  default:
    echo '
		<div>
			<ul class="breadcrumb">
				<li>
					<a href="?module=home">Home</a> <span class="divider">/</span>
				</li>
				<li>
					<a href="#">Gallery</a>
				</li>
			</ul>
		</div>
		<div class="row-fluid sortable">
			<div class="box span12">
				<div class="box-header well" data-original-title>
					<h2><i class="icon-picture"></i> Gallery</h2>
					<div class="box-icon">
						<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
						<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
					</div>
				</div>
				<div class="box-content">
					<input type=button value=\'Tambah Gallery\' class="btn btn-primary" 
					onclick="window.location.href=\'?module=gallery&act=tambahgallery\';"><br /><br />
					<table class="table table-striped table-bordered bootstrap-datatable datatable">
						<thead>
							<tr>
								<th>No</th>
								<th>Judul </th>
								<th>Gambar</th>
								
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
	';
							if($_SESSION[leveluser]=='admin'){
								$tampil = mysql_query("SELECT * FROM gallery ORDER BY id_gallery DESC");

							}else{
								$tampil = mysql_query("SELECT * FROM gallery WHERE id_user='$_SESSION[id_user]' ORDER BY id_gallery DESC");

							}
							
							$no = 1;
							while($r=mysql_fetch_array($tampil)){
								
								echo "
								<tr>
									<td>$no</td>
									<td>$r[jdl_gallery]</td>
									<td>
										<img src='../img_album/small_$r[gbr_gallery]' style='width:70px;'>
									</td>
									<td>
										<a class=\"btn btn-info\" href=?module=gallery&act=editgallery&id=$r[id_gallery]><i class=\"icon-edit icon-white\"></i> Edit</a> 
										<a class=\"btn btn-danger\" href='$aksi?module=gallery&act=hapus&id=$r[id_gallery]&namafile=$r[gbr_gallery]' onClick=\"return confirm('are you sure for delete this post ?')\"><i class=\"icon-trash icon-white\"></i> Hapus</a>
									</td>
								</tr>
								";
								$no++;
							}
	echo '
						</tbody>
					</table>
				</div>
			</div>
		</div>
	';
 
    break;
  
  case "tambahgallery":
    echo '
		<div>
			<ul class="breadcrumb">
				<li>
					<a href="?module=home">Home</a> <span class="divider">/</span>
				</li>
				<li>
					<a href="?module=gallery">Gallery</a> <span class="divider">/</span>
				</li>
				<li>
					<a href="#">Tambah Gallery</a>
				</li>
			</ul>
		</div>
		<div class="row-fluid sortable">
			<div class="box span12">
				<div class="box-header well" data-original-title>
					<h2><i class="icon-picture"></i> Tambah Gallery</h2>
					<div class="box-icon">
						<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
						<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
					</div>
				</div>
				<div class="box-content">
					<form class="form-horizontal" method=POST action='.$aksi.'?module=gallery&act=input enctype=\'multipart/form-data\'>
						<fieldset>
							<div class="control-group">
								<label class="control-label">Judul</label>
								<div class="controls">
									<input type=text name="jdl_album" />
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Gambar</label>
								<div class="controls">
									<input type=file name="fupload" size=40>
									<br>Tipe gambar harus JPG/JPEG dan ukuran min: 490px X 366px
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Deskripsi</label>
								<div class="controls">
									<textarea name=\'deskripsi\' id="loko" style=\'width: 580px; height: 350px;\'></textarea>
								</div>
							</div>
							<div class="form-actions">
								<input type=submit value=Simpan class="btn btn-primary">
								<input type=button value=Batal onclick=self.history.back() class="btn">
							</div>
						</fieldset>
					</form>	
			</div>
		</div>
	';
	
     break;
    
  case "editgallery":
    $edit=mysql_query("SELECT * FROM gallery WHERE id_gallery='$_GET[id]'");
    $r=mysql_fetch_array($edit);

    echo '
		<div>
			<ul class="breadcrumb">
				<li>
					<a href="?module=home">Home</a> <span class="divider">/</span>
				</li>
				<li>
					<a href="?module=gallery">Gallery</a> <span class="divider">/</span>
				</li>
				<li>
					<a href="#">Edit Gallery</a>
				</li>
			</ul>
		</div>
		<div class="row-fluid sortable">
			<div class="box span12">
				<div class="box-header well" data-original-title>
					<h2><i class="icon-edit"></i> Edit Gallery</h2>
					<div class="box-icon">
						<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
						<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
					</div>
				</div>
				<div class="box-content">
					<form class="form-horizontal" method=POST enctype=\'multipart/form-data\' action='.$aksi.'?module=gallery&act=update>
						<fieldset>
							<input type=hidden name=id value='.$r[id_gallery].'>
							<div class="control-group">
								<label class="control-label">Judul</label>
								<div class="controls">
									<input type=text name="jdl_album" value="'.$r[jdl_gallery].'" />
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Gambar</label>
								<div class="controls">
									<img src="../img_album/small_'.$r[gbr_gallery].'">
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Ganti Gambar</label>
								<div class="controls">
									<input type=file name="fupload" size=30>
									<br> ukuran min: 490px X 366px
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Deskripsi</label>
								<div class="controls">
									<textarea name=\'deskripsi\' id="loko" style=\'width: 580px; height: 350px;\'>'.$r[keterangan].'</textarea>
								</div>
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
