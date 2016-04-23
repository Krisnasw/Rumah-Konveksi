<?php
$aksi="modul/mod_subsubkategori/aksi_subsubkategori.php";
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
					<h2><i class="icon-tags"></i> Sub Kategori 2</h2>
					<div class="box-icon">
						<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
						<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
					</div>
				</div>
				<div class="box-content">
					<input type=button value="Tambah Sub Kategori 2" class="btn btn-primary"
					onclick="window.location.href=\'?module=subsubkategori&act=tambahsubsubkategori\';"><br /><br />
					<table class="table table-striped table-bordered bootstrap-datatable datatable">
						<thead>
							<tr>
								<th>No</th>
								<th>Nama Sub kategori 2</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
	';
						$tampil=mysql_query("SELECT * FROM subsubkategori ORDER BY id_subkategori DESC");
						$no=1;
						while ($r=mysql_fetch_array($tampil)){
							echo "
							<tr>
								<td>$no</td>
								<td>$r[nama_sub]</td>
								<td><!--
									<a class=\"btn btn-info\" href=?module=subsubkategori&act=editsubsubkategori&id=$r[id_subkategori]><i class=\"icon-edit icon-white\"></i> Edit</a>
									-->
									<a class=\"btn btn-danger\" href=$aksi?module=subsubkategori&act=hapus&id=$r[id_subkategori]><i class=\"icon-trash icon-white\"></i> Hapus</a>
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
  case "tambahsubsubkategori":
    echo '
		<div>
			<ul class="breadcrumb">
				<li>
					<a href="?module=home">Home</a> <span class="divider">/</span>
				</li>
				<li>
					<a href="?module=subsubkategori">Sub Kategori</a> <span class="divider">/</span>
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
					<form class="form-horizontal" method=POST action='.$aksi.'?module=subsubkategori&act=input>
						<fieldset>
						<div class="control-group">
							<label class="control-label">Kategori</label>
							<div class="controls">
							<form method=post action='.$aksi.'?module=produk&act=subkategori>
								<select id="kategori" name="kategori">
									<option value=0 selected>- Pilih Kategori -</option>';
									$tampil=mysql_query("SELECT * FROM kategoriproduk ORDER BY nama_kategori");
									while($r=mysql_fetch_array($tampil)){
										echo "<option value=$r[id_kategori]>$r[nama_kategori]</option>";
									}
echo '
								</select>
							</form>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">Sub Kategori</label>
							<div class="controls">
								<select id="subkategori" name="subkategori">
									<option value=0 selected>- Pilih Sub Kategori -</option>
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
  case "editsubsubkategori":
    $edit=mysql_query("SELECT * FROM kategoriproduk k LEFT JOIN subsubkategori s ON k.id_kategori=s.id_main WHERE s.id_subkategori='$_GET[id]'");
    $r=mysql_fetch_array($edit);

    echo '
		<div>
			<ul class="breadcrumb">
				<li>
					<a href="?module=home">Home</a> <span class="divider">/</span>
				</li>
				<li>
					<a href="?module=subsubkategori">Sub Kategori</a> <span class="divider">/</span>
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
					<form class="form-horizontal" method=POST action='.$aksi.'?module=subsubkategori&act=update>
						<fieldset>
							<input type=hidden name=id value="'.$r[id_subkategori].'">
							<div class="control-group">
								<label class="control-label">Nama Sub Kategori</label>
								<div class="controls">
									<input type=text name="nama_sub" value="'.$r[nama_sub].'" />
								</div>
							</div>
							
							<div class="control-group">
								<label class="control-label">Nama Sub Kategori 2</label>
								<div class="controls">
									<select id="selectError" name="id_subkategori" data-rel="chosen">	
	';
										$tampil=mysql_query("SELECT * FROM subkategori ORDER BY nama_sub");
										while($w=mysql_fetch_array($tampil)){
											if ($r[id_submain] === $w[id_subkategori]) {
												echo '<option value='.$w[id_subkategori].' selected>'.$w[nama_sub].'</option>';
											}else {
												echo '<option value='.$w[id_subkategori].'>'.$w[nama_sub].'</option>';
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
