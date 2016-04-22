<?php
session_start();
if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
echo "<link href='style.css' rel='stylesheet' type='text/css'>
<center>Untuk mengakses modul, Anda harus login <br>";
echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
$aksi="modul/mod_produk/aksi_produk.php";
switch($_GET[act]){
// Tampil Produk
default:
echo '
	<div>
		<ul class="breadcrumb">
			<li>
				<a href="?module=home">Home</a> <span class="divider">/</span>
			</li>
			<li>
				<a href="#">Produk</a>
			</li>
		</ul>
	</div>
';
		if($_GET[notifdel] == 'sukses'){
			echo '
				<br>
				<div class="alert alert-success">
					<button type="button" class="close" data-dismiss="alert">&times;</button>
					<strong>Warning!</strong> Delete Produk Berhasil
				</div>
			';
		}
echo '
	<div class="row-fluid sortable">
		<div class="box span12">
			<div class="box-header well" data-original-title>
				<h2><i class="icon-th-large"></i> Produk</h2>
				<div class="box-icon">
					<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
					<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
				</div>
			</div>
			<div class="box-content">
				<input type=button value=\'Tambah Produk\' class="btn btn-primary" 
				onclick="window.location.href=\'?module=produk&act=tambahproduk\';"><br /><br />
				<table class="table table-striped table-bordered bootstrap-datatable datatable">
					<thead>
						<tr>
							<th>No</th>
							<th>Nama Produk</th>
							<th>Harga</th>
							<th>Tgl. Masuk</th>
							<th>Status</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
';
						$tampil = mysql_query("SELECT * FROM produk ORDER BY id_produk DESC");
						$no = 1;
						while($r=mysql_fetch_array($tampil)){
							$tanggal=tgl_indo($r[tgl_masuk]);
							$harga=format_rupiah($r[harga]);
							
							echo "
							<tr>
								<td>$no</td>
								<td>$r[nama_produk]</td>
								<td>$harga</td>
								<td>$tanggal</td>
								<td align=center>$r[status]</td>
								<td>
									<a class=\"btn btn-info\" href=?module=produk&act=editproduk&id=$r[id_produk]><i class=\"icon-edit icon-white\"></i> Edit</a> 
									<a class=\"btn btn-danger\" href='$aksi?module=produk&act=hapus&id=$r[id_produk]&namafile=$r[gambar]' onClick=\"return confirm('Apakah Anda benar-benar mau menghapusnya?')\"><i class=\"icon-trash icon-white\"></i> Hapus</a>
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

case "tambahproduk":
echo '
	<div>
		<ul class="breadcrumb">
			<li>
				<a href="?module=home">Home</a> <span class="divider">/</span>
			</li>
			<li>
				<a href="?module=produk">Produk</a> <span class="divider">/</span>
			</li>
			<li>
				<a href="#">Tambah Produk</a>
			</li>
		</ul>
	</div>
	<div class="row-fluid sortable">
		<div class="box span12">
			<div class="box-header well" data-original-title>
				<h2><i class="icon-plus-sign"></i> Tambah Produk</h2>
				<div class="box-icon">
					<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
					<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
				</div>
			</div>
			<div class="box-content">
				<form class="form-horizontal" method=POST action='.$aksi.'?module=produk&act=input enctype=\'multipart/form-data\'>
					<fieldset>
						<div class="control-group">
							<label class="control-label">Nama Produk</label>
							<div class="controls">
								<input type=text name="nama_produk" />
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">Kategori</label>
							<div class="controls">
							<form method=post action='.$aksi.'?module=produk&act=subkategori>
								<select id="kategoriproduk" name="kategori">
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
							<label class="control-label">Berat</label>
							<div class="controls">
								<input type=text name="berat" /> Kg
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">Diskon</label>
							<div class="controls">
								<input type=text name="diskon" />%
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">Stok</label>
							<div class="controls">
								<input type=text name="stok" />
							</div>
						</div>
						
						<div class="control-group">
							<label class="control-label">Harga</label>
							<div class="controls">
								<input type=text name="harga" />
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">Status</label>
							<div class="controls">
								<select name="status">
								<option value="baru" selected>Baru</option>
								<option value="promo">Promo</option>
								<option value="1">Spesial</option>
								</select>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">Deskripsi</label>
							<div class="controls">
								<textarea id="loko" name=\'deskripsi\' style=\'width: 580px; height: 350px;\'></textarea>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">Gambar</label>
							<div class="controls">
								<div class="alert alert-info">
											<button type="button" class="close" data-dismiss="alert">&times;</button>
											<strong>Warning!</strong> Tipe gambar harus JPG/JPEG,png,gif usahakan lebar 540px untuk mendapatkan tampilan yang proporsional
										</div>
										<table id="upl">
											<tbody>
											   <tr>
												   <td><input name="fupload[]" type="file" size="60"></td>
											   </tr>
											</tbody>		   
									   </table>
									   <br>
										<input type="button" class="btn" value="Tambah File" id="tambah">
										<input type="button" class="btn" value="Hapus File" id="hapus">
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

case "editproduk":
$edit = mysql_query("SELECT * FROM produk WHERE id_produk='$_GET[id]'");
$r    = mysql_fetch_array($edit);

echo '
	<div>
		<ul class="breadcrumb">
			<li>
				<a href="?module=home">Home</a> <span class="divider">/</span>
			</li>
			<li>
				<a href="?module=produk">Produk</a> <span class="divider">/</span>
			</li>
			<li>
				<a href="#">Edit Produk</a>
			</li>
		</ul>
	</div>
	<div class="row-fluid sortable">
		<div class="box span12">
			<div class="box-header well" data-original-title>
				<h2><i class="icon-edit"></i> Edit Produk</h2>
				<div class="box-icon">
					<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
					<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
				</div>
			</div>
			<div class="box-content">
				<form class="form-horizontal" method=POST enctype=\'multipart/form-data\' action='.$aksi.'?module=produk&act=update>
					<fieldset>
						<input type=hidden name=id value='.$r[id_produk].'>
						<div class="control-group">
							<label class="control-label">Nama Produk</label>
							<div class="controls">
								<input type=text name="nama_produk" value="'.$r[nama_produk].'" />
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">Kategori</label>
							<div class="controls">
								<select id="kategoriproduk" name="kategori">
								<form method=post>
';
									$tampil=mysql_query("SELECT * FROM kategoriproduk ORDER BY nama_kategori");
									if ($r[id_kategori]==0){
										echo "<option value=0 selected>- Pilih Kategori -</option>";
									}
									
									while($w=mysql_fetch_array($tampil)){
										if ($r[id_kategori]==$w[id_kategori]){
											echo "<option value=$w[id_kategori] selected>$w[nama_kategori]</option>";
										}
										else{
											echo "<option value=$w[id_kategori]>$w[nama_kategori]</option>";
										}
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
';
									$tampil=mysql_query("SELECT * FROM subkategori WHERE id_main=$r[id_kategori] ORDER BY nama_sub ");
									if ($r[id_subkategori]==0){
										echo "<option value=0 selected>- Pilih Sub Kategori -</option>";
									}
									
									while($w=mysql_fetch_array($tampil)){
										if ($r[id_subkategori]==$w[id_subkategori]){
											echo "<option value=$w[id_subkategori] selected>$w[nama_sub]</option>";
										}
										else{
											echo "<option value=$w[id_subkategori]>$w[nama_sub]</option>";
										}
									}
echo '
								</select>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">Berat</label>
							<div class="controls">
								<input type=text name="berat" value="'.$r[berat].'" /> Kg
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">Diskon</label>
							<div class="controls">
								<input type=text name="diskon" value="'.$r[diskon].'" />
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">Stok</label>
							<div class="controls">
								<input type=text name="stok" value="'.$r[stok].'" />
							</div>
						</div>							
						
						<div class="control-group">
							<label class="control-label">Harga</label>
							<div class="controls">
								<input type=text name="harga" value="'.$r[harga].'" />
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">Status</label>
							<div class="controls">
							<select name="status">								
';
						if ($r[status]=='baru'){
							echo '
								<option value="baru" selected>Baru</option>
								<option value="promo">Promo</option>
								<option value="spesial">Spesial</option>
							';
						}
						elseif ($r[status]=='promo'){
							echo '
								<option value="baru">Baru</option>
								<option value="promo" selected>Promo</option>
								<option value="spesial">Spesial</option>
							';
						}elseif ($r[status]=='spesial'){
							echo '
								<option value="baru">Baru</option>
								<option value="promo">Promo</option>
								<option value="spesial" selected>Spesial</option>
							';
						}elseif ($r[status]=='Diskon'){
							echo '
								<option value="baru">Baru</option>
								<option value="promo">Promo</option>
								<option value="spesial">Spesial</option>
							';
						}else{
							echo '
								<option value="baru">Baru</option>
								<option value="promo">Promo</option>
								<option value="spesial">Spesial</option>
							';
						}
echo '														
							</select>
							
							</div>
						</div>
							
						<div class="control-group">
							<label class="control-label">Deskripsi</label>
							<div class="controls">
								<textarea id="loko" name=\'deskripsi\' style=\'width: 600px; height: 350px;\'>'.$r[deskripsi].'</textarea>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">Gambar</label>
							<div class="controls">
								<div class="alert alert-info">
									<button type="button" class="close" data-dismiss="alert">&times;</button>
									<strong>Warning !</strong> Apabila gambar tidak diubah, dikosongkan saja.
								</div>
								<div class="row-fluid">
';
	$qG = mysql_query("SELECT NamaGambar FROM imagesproduk WHERE idProduk='$r[id_produk]' ORDER BY idImages ASC");
	while($rG = mysql_fetch_array($qG)){
					echo '
						<div class="span3">
							<div class="fileupload fileupload-new" data-provides="fileupload">
								<div class="fileupload-new thumbnail" style="max-width: 180px;"><img src="../foto_produk/'.$rG[NamaGambar].'" style="height:auto;" /></div>
								<div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
								<div>
									<span class="btn btn-file"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span><input type="file" name=\'fupload[]\' /></span>
									<a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
								</div>
							</div>
						</div>
					';
	}
echo '
									<table id="upl">
											<tbody>
											   <tr>
												   <td><input name="fupload[]" type="file" size="60"></td>
											   </tr>
											</tbody>		   
									   </table>
									   <br>
										<input type="button" class="btn" value="Tambah File" id="tambah">
										<input type="button" class="btn" value="Hapus File" id="hapus">
								</div>
							</div>
						</div>
';
echo '	
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
