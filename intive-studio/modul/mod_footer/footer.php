<?php
session_start();
if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
echo "<link href='style.css' rel='stylesheet' type='text/css'>
<center>Untuk mengakses modul, Anda harus login <br>";
echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
$aksi="modul/mod_footer/aksi_footer.php";
switch($_GET[act]){
// Tampil Menu Footer
default:
echo '
	<div>
		<ul class="breadcrumb">
			<li>
				<a href="?module=home">Home</a> <span class="divider">/</span>
			</li>
			<li>
				<a href="#">Menu Footer</a>
			</li>
		</ul>
	</div>
	<div class="row-fluid sortable">
		<div class="box span12">
			<div class="box-header well" data-original-title>
				<h2><i class="icon-th-large"></i> Menu Footer</h2>
				<div class="box-icon">
					<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
					<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
				</div>
			</div>
			<div class="box-content">
				<input type=button value=\'Tambah Menu Footer\' class="btn btn-primary" 
				onclick="window.location.href=\'?module=footer&act=tambahfooter\';"><br /><br />
				<table class="table table-striped table-bordered bootstrap-datatable datatable">
					<thead>
						<tr>
							<th>No</th>
							<th>Nama Menu</th>
							<th>Link</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
';
						$tampil = mysql_query("SELECT * FROM footer ORDER BY id_footer DESC");
						$no = 1;
						while($r=mysql_fetch_array($tampil)){
							$tanggal=tgl_indo($r[tgl_posting]);
							echo "
							<tr>
								<td>$no</td>
								<td>$r[nama_menu]</td>
								<td align=center>$r[link]</td>
								<td>
									<a class=\"btn btn-info\" href=?module=footer&act=editfooter&id=$r[id_footer]><i class=\"icon-edit icon-white\"></i> Edit</a> 
									<a class=\"btn btn-danger\" href='$aksi?module=footer&act=hapus&id=$r[id_footer]&namafile=$r[gambar]'><i class=\"icon-trash icon-white\"></i> Hapus</a>
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
				<a href="?module=footer">Menu Footer</a> <span class="divider">/</span>
			</li>
			<li>
				<a href="#">Tambah Menu Footer</a>
			</li>
		</ul>
	</div>
	<div class="row-fluid sortable">
		<div class="box span12">
			<div class="box-header well" data-original-title>
				<h2><i class="icon-plus-sign"></i> Tambah Menu Footer</h2>
				<div class="box-icon">
					<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
					<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
				</div>
			</div>
			<div class="box-content">
				<form class="form-horizontal" method=POST action='.$aksi.'?module=footer&act=input enctype=\'multipart/form-data\'>
					<fieldset>
						<div class="control-group">
							<label class="control-label">Nama Menu</label>
							<div class="controls">
								<input type=text name="nama_menu" />
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">Link</label>
							<div class="controls">
								<input type=text name="link" />
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

case "editfooter":
$edit = mysql_query("SELECT * FROM footer WHERE id_footer='$_GET[id]'");
$r    = mysql_fetch_array($edit);

echo '
	<div>
		<ul class="breadcrumb">
			<li>
				<a href="?module=home">Home</a> <span class="divider">/</span>
			</li>
			<li>
				<a href="?module=footer">Menu Footer</a> <span class="divider">/</span>
			</li>
			<li>
				<a href="#">Edit Menu Footer</a>
			</li>
		</ul>
	</div>
	<div class="row-fluid sortable">
		<div class="box span12">
			<div class="box-header well" data-original-title>
				<h2><i class="icon-edit"></i> Edit Menu Footer</h2>
				<div class="box-icon">
					<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
					<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
				</div>
			</div>
			<div class="box-content">
				<form class="form-horizontal" method=POST enctype=\'multipart/form-data\' action='.$aksi.'?module=footer&act=update>
					<fieldset>
						<input type=hidden name=id value='.$r[id_footer].'>
						<div class="control-group">
							<label class="control-label">Nama Menu</label>
							<div class="controls">
								<input type=text name="nama_menu" value="'.$r[nama_menu].'" />
							</div>
						</div><div class="control-group">
							<label class="control-label">Link</label>
							<div class="controls">
								<input type=text name="link" value="'.$r[link].'" />
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
