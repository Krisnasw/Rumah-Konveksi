<?php
session_start();
 if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
$aksi="modul/mod_footer_promo/aksi_promo.php";
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
					<a href="#">Footer Promo</a>
				</li>
			</ul>
		</div>
		<div class="row-fluid sortable">
			<div class="box span12">
				<div class="box-header well" data-original-title>
					<h2><i class="icon-picture"></i> Footer Promo</h2>
					<div class="box-icon">
						<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
						<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
					</div>
				</div>
				<div class="box-content">
					<input type=button value=\'Tambah Footer Promo\' class="btn btn-primary" 
					onclick="window.location.href=\'?module=footer-promo&act=tambahfooter\';"><br /><br />
					<table class="table table-striped table-bordered bootstrap-datatable datatable">
						<thead>
							<tr>
								<th>No</th>
								<th>Judul </th>
								<th>Deskripsi </th>
								<th>Gambar</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
	';
							$no = 1;
							$tampil = mysql_query("SELECT * FROM footer_promo ORDER BY id DESC");
							while($r=mysql_fetch_array($tampil)){
								
								echo "
								<tr>
									<td>$no</td>
									<td>$r[judul]</td>
									<td>".substr($r[deskripsi],0,50)."</td>
									<td>
										<img src='../foto_footer/$r[gambar]' style='width:70px;'>
									</td>
									<td>
										<a class=\"btn btn-info\" href=?module=footer-promo&act=editpromo&id=$r[id]><i class=\"icon-edit icon-white\"></i> Edit</a> 
										<a class=\"btn btn-danger\" href='$aksi?module=footer-promo&act=hapus&id=$r[id]&namafile=$r[gambarff]' onClick=\"return confirm('are you sure for delete this post ?')\"><i class=\"icon-trash icon-white\"></i> Hapus</a>
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
  
  case "tambahfooter":
    echo '
		<div>
			<ul class="breadcrumb">
				<li>
					<a href="?module=home">Home</a> <span class="divider">/</span>
				</li>
				<li>
					<a href="?module=footer-promo">Footer Promo</a> <span class="divider">/</span>
				</li>
				<li>
					<a href="#">Tambah Footer Promo</a>
				</li>
			</ul>
		</div>
		<div class="row-fluid sortable">
			<div class="box span12">
				<div class="box-header well" data-original-title>
					<h2><i class="icon-picture"></i> Tambah Footer Promo</h2>
					<div class="box-icon">
						<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
						<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
					</div>
				</div>
				<div class="box-content">
					<form class="form-horizontal" method=POST action='.$aksi.'?module=footer-promo&act=input enctype=\'multipart/form-data\'>
						<fieldset>
							<div class="control-group">
								<label class="control-label">Judul</label>
								<div class="controls">
									<input type=text name="jdl_album" />
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Deskripsi</label>
								<div class="controls">
									<textarea name=\'deskripsi\' id="loko" style=\'width: 580px; height: 350px;\'></textarea>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">URL</label>
								<div class="controls">
									<input type=text name="url" />
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Gambar</label>
								<div class="controls">
									<input type=file name="fupload" size=40>
									<br>Tipe gambar harus JPG/JPEG dan ukuran min: 490px X 366px
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
    
  case "editpromo":
    $edit=mysql_query("SELECT * FROM footer_promo WHERE id='$_GET[id]'");
    $r=mysql_fetch_array($edit);

    echo '
		<div>
			<ul class="breadcrumb">
				<li>
					<a href="?module=home">Home</a> <span class="divider">/</span>
				</li>
				<li>
					<a href="?module=footer-promo">Footer Promo</a> <span class="divider">/</span>
				</li>
				<li>
					<a href="#">Edit Footer Promo</a>
				</li>
			</ul>
		</div>
		<div class="row-fluid sortable">
			<div class="box span12">
				<div class="box-header well" data-original-title>
					<h2><i class="icon-edit"></i> Edit Footer Promo</h2>
					<div class="box-icon">
						<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
						<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
					</div>
				</div>
				<div class="box-content">
					<form class="form-horizontal" method=POST enctype=\'multipart/form-data\' action='.$aksi.'?module=footer-promo&act=update>
						<fieldset>
							<input type=hidden name=id value='.$r[id].'>
							<div class="control-group">
								<label class="control-label">Judul</label>
								<div class="controls">
									<input type=text name="jdl_album" value="'.$r[judul].'" />
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Deskripsi</label>
								<div class="controls">
									<textarea name=\'deskripsi\' id="loko" style=\'width: 580px; height: 350px;\'>'.$r[deskripsi].'</textarea>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">URL</label>
								<div class="controls">
									<input type=text name="url" value="'.$r[url].'" />
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Gambar</label>
								<div class="controls">
									<img src="../foto_footer/'.$r[gambar].'">
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Ganti Gambar</label>
								<div class="controls">
									<input type=file name="fupload" size=30>
									<br> ukuran min: 490px X 366px
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
