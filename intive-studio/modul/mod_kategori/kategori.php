<?php
$aksi="modul/mod_kategori/aksi_kategori.php";
switch($_GET[act]){
  // Tampil Kategori
  default:
    echo '
		<div>
			<ul class="breadcrumb">
				<li>
					<a href="?module=home">Home</a> <span class="divider">/</span>
				</li>
				<li>
					<a href="#">Kategori</a>
				</li>
			</ul>
		</div>
		<div class="row-fluid sortable">
			<div class="box span12">
				<div class="box-header well" data-original-title>
					<h2><i class="icon-tags"></i> Kategori</h2>
					<div class="box-icon">
						<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
						<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
					</div>
				</div>
				<div class="box-content">
					<input type=button value="Tambah Kategori" class="btn btn-primary"
					onclick="window.location.href=\'?module=kategori&act=tambahkategori\';"><br /><br />
					<table class="table table-striped table-bordered bootstrap-datatable datatable">
						<thead>
							<tr>
								<th>No</th>
								<th>Nama Kategori</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
	';
						$tampil=mysql_query("SELECT * FROM kategori ORDER BY id_kategori DESC");
						$no=1;
						while ($r=mysql_fetch_array($tampil)){
							echo "
							<tr>
								<td>$no</td>
								<td>$r[nama_kategori]</td>
								<td>
									<a class=\"btn btn-info\" href=?module=kategori&act=editkategori&id=$r[id_kategori]><i class=\"icon-edit icon-white\"></i> Edit</a>
									<a class=\"btn btn-danger\" href=$aksi?module=kategori&act=hapus&id=$r[id_kategori]><i class=\"icon-trash icon-white\"></i> Hapus</a>
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
  
  // Form Tambah Kategori
  case "tambahkategori":
    echo '
		<div>
			<ul class="breadcrumb">
				<li>
					<a href="?module=home">Home</a> <span class="divider">/</span>
				</li>
				<li>
					<a href="?module=kategori">Kategori</a> <span class="divider">/</span>
				</li>
				<li>
					<a href="#">Tambah Kategori</a>
				</li>
			</ul>
		</div>
		<div class="row-fluid sortable">
			<div class="box span12">
				<div class="box-header well" data-original-title>
					<h2><i class="icon-plus-sign"></i> Tambah Kategori</h2>
					<div class="box-icon">
						<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
						<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
					</div>
				</div>
				<div class="box-content">
					<form class="form-horizontal" method=POST action='.$aksi.'?module=kategori&act=input enctype=\'multipart/form-data\'>
						<fieldset>
							<div class="control-group">
								<label class="control-label">Nama Kategori</label>
								<div class="controls">
									<input type=text name="nama_kategori" />
								</div>
							</div>
							<!--
							<div class="control-group">
								<label class="control-label">Gambar</label>
								<div class="controls">
									<input type=file name="fupload" />
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Icon</label>
								<div class="controls">
									<input type=file name="fupload1" />
								</div>
							</div>
							-->
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
  
  // Form Edit Kategori  
  case "editkategori":
    $edit=mysql_query("SELECT * FROM kategori WHERE id_kategori='$_GET[id]'");
    $r=mysql_fetch_array($edit);

    echo '
		<div>
			<ul class="breadcrumb">
				<li>
					<a href="?module=home">Home</a> <span class="divider">/</span>
				</li>
				<li>
					<a href="?module=kategori">Kategori</a> <span class="divider">/</span>
				</li>
				<li>
					<a href="#">Edit Kategori</a>
				</li>
			</ul>
		</div>
		<div class="row-fluid sortable">
			<div class="box span12">
				<div class="box-header well" data-original-title>
					<h2><i class="icon-edit"></i> Edit Kategori</h2>
					<div class="box-icon">
						<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
						<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
					</div>
				</div>
				<div class="box-content">
					<form class="form-horizontal" method=POST action='.$aksi.'?module=kategori&act=update enctype=\'multipart/form-data\'>
						<fieldset>
							<input type=hidden name=id value="'.$r[id_kategori].'">
							<div class="control-group">
								<label class="control-label">Nama Kategori</label>
								<div class="controls">
									<input type=text name="nama_kategori" value="'.$r[nama_kategori].'" />
								</div>
							</div>
							<!--
							<div class="control-group">
								<label class="control-label">Icon</label>
								<div class="controls">
									<div class="fileupload-new thumbnail" style="max-width: 100px;">
										<img src="../files/'.$r['icon'].'" style="width: 100px;height:auto;" />
									</div>
									<input type=file name="fupload1" />
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Gambar</label>
								<div class="controls">
									<div class="fileupload-new thumbnail" style="max-width: 180px;">
										<img src="../foto_produk/'.$r['gambar'].'" style="width: 180px;height:auto;" />
									</div>
									<input type=file name="fupload" />
								</div>
							</div>
							-->
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
