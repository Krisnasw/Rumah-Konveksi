<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
$aksi="modul/mod_stok/aksi_stok.php";
switch($_GET[act]){
  // Tampil Stok
  default:
    echo '
		<div>
			<ul class="breadcrumb">
				<li>
					<a href="?module=home">Home</a> <span class="divider">/</span>
				</li>
				<li>
					<a href="#">Stok</a>
				</li>
			</ul>
		</div>
		<div class="row-fluid sortable">
			<div class="box span12">
				<div class="box-header well" data-original-title>
					<h2><i class="icon-picture"></i> Stok</h2>
					<div class="box-icon">
						<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
						<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
					</div>
				</div>
				<div class="box-content">
				<!--
					<input type=button value=\'Tambah Stok\' class="btn btn-primary" 
					onclick="window.location.href=\'?module=stok&act=tambahstok\';"><br /><br />
				-->
					<table class="table table-striped table-bordered bootstrap-datatable datatable">
						<thead>
							<tr>
								<th>No</th>
								<th>Nama Produk </th>
								<th>Stok</th>
								<th>Dibeli</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
	';
							$tampil = mysql_query("SELECT * FROM produk ORDER BY id_produk DESC");
							$no = 1;
							while($r=mysql_fetch_array($tampil)){
								
								echo "
								<tr>
									<td>$no</td>
									<td>$r[nama_produk]</td>
									<td>$r[stok]</td>
									<td>$r[dibeli]</td>
									<td>
										<a class=\"btn btn-success\" href=?module=stok&act=view&id=$r[id_produk]><i class=\"icon-zoom-in icon-white\"></i> View</a>
										<a class=\"btn btn-info\" href=?module=stok&act=tambahstok&stok=$r[stok]&id=$r[id_produk]><i class=\"icon-edit icon-white\"></i> Tambah Stok</a> 
										<!--
										<a class=\"btn btn-danger\" href='$aksi?module=stok&act=hapus&id=$r[id_produk]&namafile=$r[gbr_stok]'><i class=\"icon-trash icon-white\"></i> Hapus</a>
										-->
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
  
  case "tambahstok":  
  
    echo '
		<div>
			<ul class="breadcrumb">
				<li>
					<a href="?module=home">Home</a> <span class="divider">/</span>
				</li>
				<li>
					<a href="?module=stok">Stok</a> <span class="divider">/</span>
				</li>
				<li>
					<a href="#">Tambah Stok</a>
				</li>
			</ul>
		</div>
		<div class="row-fluid sortable">
			<div class="box span12">
				<div class="box-header well" data-original-title>
					<h2><i class="icon-picture"></i> Tambah Stok</h2>
					<div class="box-icon">
						<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
						<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
					</div>
				</div>
				<div class="box-content">
					<form class="form-horizontal" method=POST action='.$aksi.'?module=stok&act=input enctype=\'multipart/form-data\'>
						<fieldset>
							<div class="control-group">
								<label class="control-label">Penambahan Stok</label>
								<div class="controls">
									<input type=hidden name=id_produk value='.$_GET[id].'>
									<input type=hidden name=stok_awal value='.$_GET[stok].'>
									<input type=text name="penambahan_stok" />
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
  
	case "view":
	
	$edit=mysql_query("SELECT nama_produk FROM produk WHERE id_produk='$_GET[id]'");
    $r=mysql_fetch_array($edit);
	
    echo '
		<div>
			<ul class="breadcrumb">
				<li>
					<a href="?module=home">Home</a> <span class="divider">/</span>
				</li>
				<li>
					<a href="?module=stok">Stok</a><span class="divider">/</span>
				</li>
				<li>
					<a href="#">'.$r[nama_produk].'</a>
				</li>
			</ul>
		</div>
		<div class="row-fluid sortable">
			<div class="box span12">
				<div class="box-header well" data-original-title>
					<h2><i class="icon-picture"></i> Stok '.$r[nama_produk].'</h2>
					<div class="box-icon">
						<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
						<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
					</div>
				</div>
				<div class="box-content">
					<input type=button value=\'Kembali\' class="btn btn-primary" 
					onclick="window.location.href=\'?module=stok\';"><br /><br />
					<table class="table table-striped table-bordered bootstrap-datatable datatable">
						<thead>
							<tr>
								<th>No</th>
								<th>Tanggal</th>
								<th>Penambahan Stok</th>
							</tr>
						</thead>
						<tbody>
	';
							$tampil = mysql_query("SELECT * FROM stok WHERE id_produk='$_GET[id]'");
							$no = 1;
							while($r_tampil=mysql_fetch_array($tampil)){
								$tgl = tgl_indo($r_tampil[tgl]);
								echo "
								<tr>
									<td>$no</td>								
									<td align=center>$tgl</td>			
									<td>$r_tampil[penambahan_stok]</td>							
									<!--
									<td>	
										<a class=\"btn btn-info\" href=?module=stok&act=editgaleri&id=$r_tampil[id_gallery]&idstok=$_GET[id]><i class=\"icon-edit icon-white\"></i> Edit</a> 
										<a class=\"btn btn-danger\" href='$aksi?module=stok&act=hapusgaleri&id=$r_tampil[id_gallery]&namafile=$r_tampil[gbr_gallery]'><i class=\"icon-trash icon-white\"></i> Hapus</a>
									</td>
									-->
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
	
}
}
?>
