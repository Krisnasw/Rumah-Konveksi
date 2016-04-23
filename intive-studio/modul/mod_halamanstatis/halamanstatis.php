<?php
session_start();
if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
echo "<link href='style.css' rel='stylesheet' type='text/css'>
<center>Untuk mengakses modul, Anda harus login <br>";
echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
$aksi="modul/mod_halamanstatis/aksi_halamanstatis.php";
switch($_GET[act]){
// Tampil Halaman Statis
default:
echo '
	<div>
		<ul class="breadcrumb">
			<li>
				<a href="?module=home">Home</a> <span class="divider">/</span>
			</li>
			<li>
				<a href="#">Halaman Statis</a>
			</li>
		</ul>
	</div>
	<div class="row-fluid sortable">
		<div class="box span12">
			<div class="box-header well" data-original-title>
				<h2><i class="icon-th-large"></i> Halaman Statis</h2>
				<div class="box-icon">
					<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
					<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
				</div>
			</div>
			<div class="box-content">
				<input type=button value=\'Tambah Halaman Statis\' class="btn btn-primary" 
				onclick="window.location.href=\'?module=halamanstatis&act=tambahhalamanstatis\';"><br /><br />
				<table class="table table-striped table-bordered bootstrap-datatable datatable">
					<thead>
						<tr>
							<th>No</th>
							<th>Judul</th>
							<th>link statis</th>
							<th>Tgl. Posting</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
';
						$tampil = mysql_query("SELECT * FROM halamanstatis ORDER BY id_halaman DESC");
						$no = 1;
						while($r=mysql_fetch_array($tampil)){
							$tanggal=tgl_indo($r[tgl_posting]);
					// membuat info link statis untuk halaman statis
					$huruf_kecil  = strtolower($r[judul]);
					$pisah_huruf  = explode(" ",$huruf_kecil);
					$gabung_huruf = implode("-",$pisah_huruf);
							echo "
							<tr>
								<td>$no</td>
								<td>$r[judul]</td>
								<td>statis-$r[id_halaman]-$gabung_huruf.html</td>
								<td>$tanggal</td>
								<td>
									<a class=\"btn btn-info\" href=?module=halamanstatis&act=edithalamanstatis&id=$r[id_halaman]><i class=\"icon-edit icon-white\"></i> Edit</a> 
									<a class=\"btn btn-danger\" href='$aksi?module=halamanstatis&act=hapus&id=$r[id_halaman]&namafile=$r[gambar]'><i class=\"icon-trash icon-white\"></i> Hapus</a>
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

case "tambahhalamanstatis":
echo '
	<div>
		<ul class="breadcrumb">
			<li>
				<a href="?module=home">Home</a> <span class="divider">/</span>
			</li>
			<li>
				<a href="?module=halamanstatis">Halaman Statis</a> <span class="divider">/</span>
			</li>
			<li>
				<a href="#">Tambah Halaman Statis</a>
			</li>
		</ul>
	</div>
	<div class="row-fluid sortable">
		<div class="box span12">
			<div class="box-header well" data-original-title>
				<h2><i class="icon-plus-sign"></i> Tambah Halaman Statis</h2>
				<div class="box-icon">
					<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
					<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
				</div>
			</div>
			<div class="box-content">
				<form class="form-horizontal" method=POST action='.$aksi.'?module=halamanstatis&act=input enctype=\'multipart/form-data\'>
					<fieldset>
						<div class="control-group">
							<label class="control-label">Judul</label>
							<div class="controls">
								<input type=text name="judul" />
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">Isi Halaman</label>
							<div class="controls">
								<textarea name=\'isi_halaman\' id=\'loko\' style=\'width: 580px; height: 350px;\'></textarea>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">Gambar</label>
							<div class="controls">
								<input type="file" name="fupload">
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

case "edithalamanstatis":
$edit = mysql_query("SELECT * FROM halamanstatis WHERE id_halaman='$_GET[id]'");
$r    = mysql_fetch_array($edit);

echo '
	<div>
		<ul class="breadcrumb">
			<li>
				<a href="?module=home">Home</a> <span class="divider">/</span>
			</li>
			<li>
				<a href="?module=halamanstatis">Halaman Statis</a> <span class="divider">/</span>
			</li>
			<li>
				<a href="#">Edit Halaman Statis</a>
			</li>
		</ul>
	</div>
	<div class="row-fluid sortable">
		<div class="box span12">
			<div class="box-header well" data-original-title>
				<h2><i class="icon-edit"></i> Edit Halaman Statis</h2>
				<div class="box-icon">
					<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
					<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
				</div>
			</div>
			<div class="box-content">
				<form class="form-horizontal" method=POST enctype=\'multipart/form-data\' action='.$aksi.'?module=halamanstatis&act=update>
					<fieldset>
						<input type=hidden name=id value='.$r[id_halaman].'>
						<div class="control-group">
							<label class="control-label">Judul</label>
							<div class="controls">
								<input type=text name="judul" value="'.$r[judul].'" />
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">Isi Halaman</label>
							<div class="controls">
								<textarea name=\'isi_halaman\' id=\'loko\' style=\'width: 580px; height: 350px;\'>'.$r[isi_halaman].'</textarea>
							</div>
						</div>
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
