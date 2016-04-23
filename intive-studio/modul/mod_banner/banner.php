<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
$aksi="modul/mod_banner/aksi_banner.php";
switch($_GET[act]){
  // Tampil Banner
  default:
    echo '
		<div>
			<ul class="breadcrumb">
				<li>
					<a href="?module=home">Home</a> <span class="divider">/</span>
				</li>
				<li>
					<a href="#">Banner</a>
				</li>
			</ul>
		</div>
		<div class="row-fluid sortable">
			<div class="box span12">
				<div class="box-header well" data-original-title>
					<h2><i class="icon-flag"></i> Banner</h2>
					<div class="box-icon">
						<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
						<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
					</div>
				</div>
				<div class="box-content">
					<input type=button value=\'Tambah Banner\' class="btn btn-primary" onclick=location.href=\'?module=banner&act=tambahbanner\'><br><br>
					<table class="table table-striped table-bordered bootstrap-datatable datatable">
						<thead>
							<tr>
								<th>No</th>
								<th>Judul</th>
								<th>url</th>
								<th>Tgl. Posting</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
	';
							$tampil=mysql_query("SELECT * FROM banner ORDER BY id_banner DESC");
							$no=1;
							while ($r=mysql_fetch_array($tampil)){
								$tgl=tgl_indo($r[tgl_posting]);
								echo "
								<tr>
									<td>$no</td>
									<td>$r[judul]</td>
									<td><a href=$r[url] target=_blank>$r[url]</a></td>
									<td>$tgl</td>
									<td>
										<a class=\"btn btn-info\" href=?module=banner&act=editbanner&id=$r[id_banner]><i class=\"icon-edit icon-white\"></i> Edit</a> 
										<a class=\"btn btn-danger\" href='$aksi?module=banner&act=hapus&id=$r[id_banner]&namafile=$r[gambar]'><i class=\"icon-trash icon-white\"></i> Hapus</a>
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
  
  case "tambahbanner":
	echo '
		<div>
			<ul class="breadcrumb">
				<li>
					<a href="?module=home">Home</a> <span class="divider">/</span>
				</li>
				<li>
					<a href="?module=banner">Banner</a> <span class="divider">/</span>
				</li>
				<li>
					<a href="#">Tambah Banner</a>
				</li>
			</ul>
		</div>
		<div class="row-fluid sortable">
			<div class="box span12">
				<div class="box-header well" data-original-title>
					<h2><i class="icon-plus-sign"></i> Tambah Banner</h2>
					<div class="box-icon">
						<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
						<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
					</div>
				</div>
				<div class="box-content">
					<form class="form-horizontal" method=POST action='.$aksi.'?module=banner&act=input enctype=\'multipart/form-data\'>
						<fieldset>
							<div class="control-group">
								<label class="control-label">Judul</label>
								<div class="controls">
									<input type=text name="judul" />
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Url</label>
								<div class="controls">
									<input type=text name="url" value=\'http://\' />
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Gambar</label>
								<div class="controls">
									<input type=file name="fupload" />
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
		</div>
	';
    
     break;
    
  case "editbanner":
    $edit = mysql_query("SELECT * FROM banner WHERE id_banner='$_GET[id]'");
    $r    = mysql_fetch_array($edit);

    echo '
		<div>
			<ul class="breadcrumb">
				<li>
					<a href="?module=home">Home</a> <span class="divider">/</span>
				</li>
				<li>
					<a href="?module=banner">Banner</a> <span class="divider">/</span>
				</li>
				<li>
					<a href="#">Edit Banner</a>
				</li>
			</ul>
		</div>
		<div class="row-fluid sortable">
			<div class="box span12">
				<div class="box-header well" data-original-title>
					<h2><i class="icon-edit"></i> Edit Banner</h2>
					<div class="box-icon">
						<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
						<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
					</div>
				</div>
				<div class="box-content">
					<form class="form-horizontal" method=POST enctype=\'multipart/form-data\' action='.$aksi.'?module=banner&act=update>
						<fieldset>
							<input type=hidden name=id value='.$r[id_banner].'>
							<div class="control-group">
								<label class="control-label">Judul</label>
								<div class="controls">
									<input type=text name="judul" value="'.$r[judul].'" />
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Url</label>
								<div class="controls">
									<input type=text name="url" value="'.$r[url].'" />
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Gambar</label>
								<div class="controls">
									<img src=\'../foto_banner/'.$r[gambar].'\' style="width:200px">
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Ganti Gbr</label>
								<div class="controls">
									<input type=file name=\'fupload\'>
									<br>Apabila gambar tidak diubah, dikosongkan saja.
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
