<?php
$aksi="modul/mod_subkategori/aksi_subkategori.php";
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
					<a href="#">Sub Kategori</a>
				</li>
			</ul>
		</div>
		<div class="row-fluid sortable">
			<div class="box span12">
				<div class="box-header well" data-original-title>
					<h2><i class="icon-tags"></i> Sub Kategori</h2>
					<div class="box-icon">
						<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
						<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
					</div>
				</div>
				<div class="box-content">
					<input type=button value="Tambah Sub Kategori" class="btn btn-primary"
					onclick="window.location.href=\'?module=subkategori&act=tambahsubkategori\';"><br /><br />
					<table class="table table-striped table-bordered bootstrap-datatable datatable">
						<thead>
							<tr>
								<th>No</th>
								<th>Nama Sub kategori</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
	';
						$tampil=mysql_query("SELECT * FROM subkategori ORDER BY id_subkategori DESC");
						$no=1;
						while ($r=mysql_fetch_array($tampil)){
							echo "
							<tr>
								<td>$no</td>
								<td>$r[nama_sub]</td>
								<td>
									<a class=\"btn btn-info\" href=?module=subkategori&act=editsubkategori&id=$r[id_subkategori]><i class=\"icon-edit icon-white\"></i> Edit</a>
									<a class=\"btn btn-danger\" href=$aksi?module=subkategori&act=hapus&id=$r[id_subkategori]><i class=\"icon-trash icon-white\"></i> Hapus</a>
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
  case "tambahsubkategori":
    echo '
		<div>
			<ul class="breadcrumb">
				<li>
					<a href="?module=home">Home</a> <span class="divider">/</span>
				</li>
				<li>
					<a href="?module=subkategori">Sub Kategori</a> <span class="divider">/</span>
				</li>
				<li>
					<a href="#">Tambah Sub Kategori</a>
				</li>
			</ul>
		</div>
		<div class="row-fluid sortable">
			<div class="box span12">
				<div class="box-header well" data-original-title>
					<h2><i class="icon-plus-sign"></i> Tambah Sub Kategori</h2>
					<div class="box-icon">
						<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
						<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
					</div>
				</div>
				<div class="box-content">
					<form class="form-horizontal" method=POST action='.$aksi.'?module=subkategori&act=input>
						<fieldset>
							<div class="control-group">
								<label class="control-label">Nama Kategori</label>
								<div class="controls">
									<select id="selectError" name="id_kategori" data-rel="chosen">
										<option value=0 selected>- Pilih Kategori -</option>
	';
										$tampil=mysql_query("SELECT * FROM kategoriproduk ORDER BY nama_kategori");
										while($r=mysql_fetch_array($tampil)){
											echo "<option value=$r[id_kategori]>$r[nama_kategori]</option>";
										}
	echo '
									</select>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Nama Sub Kategori</label>
								<div class="controls">
									<input type=text name="nama_sub" />
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
  
  // Form Edit Kategori  
  case "editsubkategori":
    $edit=mysql_query("SELECT * FROM kategoriproduk k LEFT JOIN subkategori s ON k.id_kategori=s.id_main WHERE s.id_subkategori='$_GET[id]'");
    $r=mysql_fetch_array($edit);

    echo '
		<div>
			<ul class="breadcrumb">
				<li>
					<a href="?module=home">Home</a> <span class="divider">/</span>
				</li>
				<li>
					<a href="?module=subkategori">Sub Kategori</a> <span class="divider">/</span>
				</li>
				<li>
					<a href="#">Edit Sub Kategori</a>
				</li>
			</ul>
		</div>
		<div class="row-fluid sortable">
			<div class="box span12">
				<div class="box-header well" data-original-title>
					<h2><i class="icon-edit"></i> Edit Sub Kategori</h2>
					<div class="box-icon">
						<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
						<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
					</div>
				</div>
				<div class="box-content">
					<form class="form-horizontal" method=POST action='.$aksi.'?module=subkategori&act=update>
						<fieldset>
							<input type=hidden name=id value="'.$r[id_subkategori].'">
							<div class="control-group">
								<label class="control-label">Nama Sub Kategori</label>
								<div class="controls">
									<input type=text name="nama_sub" value="'.$r[nama_sub].'" />
								</div>
							</div>
							
							<div class="control-group">
								<label class="control-label">Nama Kategori</label>
								<div class="controls">
									<select id="selectError" name="id_kategori" data-rel="chosen">
										
	';
										$tampil=mysql_query("SELECT * FROM kategoriproduk ORDER BY nama_kategori");
										while($w=mysql_fetch_array($tampil)){
											if ($r[id_kategori] === $w[id_kategori]) {
												echo '<option value='.$r[id_kategori].' selected>'.$r[nama_kategori].'</option>';
											}else {
												echo '<option value='.$w[id_kategori].'>'.$w[nama_kategori].'</option>';
											}
										
										}
	echo '
									</select>
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
