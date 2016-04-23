<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
$aksi="modul/mod_album/aksi_album.php";
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
					<a href="#">Album</a>
				</li>
			</ul>
		</div>
		<div class="row-fluid sortable">
			<div class="box span12">
				<div class="box-header well" data-original-title>
					<h2><i class="icon-picture"></i> Album</h2>
					<div class="box-icon">
						<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
						<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
					</div>
				</div>
				<div class="box-content">
					<input type=button value=\'Tambah Album\' class="btn btn-primary" 
					onclick="window.location.href=\'?module=album&act=tambahalbum\';"><br /><br />
					<table class="table table-striped table-bordered bootstrap-datatable datatable">
						<thead>
							<tr>
								<th>No</th>
								<th>Judul Album</th>
								<th>Cover</th>
								<th>Status</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
	';
							$tampil = mysql_query("SELECT * FROM album ORDER BY id_album DESC");
							$no = 1;
							while($r=mysql_fetch_array($tampil)){
								
								echo "
								<tr>
									<td>$no</td>
									<td>$r[jdl_album]</td>
									<td>
										<img src='../img_album/small_$r[gbr_album]' style='width:70px;'>
									</td>
									<td align=center>
								";
								if($r[aktif] == 'Y'){
									echo "<span class='label label-success'>Aktif</span>";
								}
								else{
									echo "<span class='label'>Tidak Aktif</span>";
								}
								echo "
									</td>
									<td>
										<a class=\"btn btn-success\" href=?module=album&act=view&id=$r[id_album]><i class=\"icon-zoom-in icon-white\"></i> View</a>
										<a class=\"btn btn-info\" href=?module=album&act=editalbum&id=$r[id_album]><i class=\"icon-edit icon-white\"></i> Edit</a> 
										<a class=\"btn btn-danger\" href='$aksi?module=album&act=hapus&id=$r[id_album]&namafile=$r[gbr_album]'><i class=\"icon-trash icon-white\"></i> Hapus</a>
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
  
  case "tambahalbum":
    echo '
		<div>
			<ul class="breadcrumb">
				<li>
					<a href="?module=home">Home</a> <span class="divider">/</span>
				</li>
				<li>
					<a href="?module=album">Album</a> <span class="divider">/</span>
				</li>
				<li>
					<a href="#">Tambah Album</a>
				</li>
			</ul>
		</div>
		<div class="row-fluid sortable">
			<div class="box span12">
				<div class="box-header well" data-original-title>
					<h2><i class="icon-picture"></i> Tambah Album</h2>
					<div class="box-icon">
						<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
						<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
					</div>
				</div>
				<div class="box-content">
					<form class="form-horizontal" method=POST action='.$aksi.'?module=album&act=input enctype=\'multipart/form-data\'>
						<fieldset>
							<div class="control-group">
								<label class="control-label">Judul Album</label>
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
    
  case "editalbum":
    $edit=mysql_query("SELECT * FROM album WHERE id_album='$_GET[id]'");
    $r=mysql_fetch_array($edit);

    echo '
		<div>
			<ul class="breadcrumb">
				<li>
					<a href="?module=home">Home</a> <span class="divider">/</span>
				</li>
				<li>
					<a href="?module=album">Album</a> <span class="divider">/</span>
				</li>
				<li>
					<a href="#">Edit album</a>
				</li>
			</ul>
		</div>
		<div class="row-fluid sortable">
			<div class="box span12">
				<div class="box-header well" data-original-title>
					<h2><i class="icon-edit"></i> Edit Album</h2>
					<div class="box-icon">
						<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
						<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
					</div>
				</div>
				<div class="box-content">
					<form class="form-horizontal" method=POST enctype=\'multipart/form-data\' action='.$aksi.'?module=album&act=update>
						<fieldset>
							<input type=hidden name=id value='.$r[id_album].'>
							<div class="control-group">
								<label class="control-label">Judul Album</label>
								<div class="controls">
									<input type=text name="jdl_album" value="'.$r[jdl_album].'" />
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Gambar</label>
								<div class="controls">
									<img src="../img_album/small_'.$r[gbr_album].'">
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Ganti Gbr</label>
								<div class="controls">
									<input type=file name="fupload" size=30>
									<br> ukuran min: 490px X 366px
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Aktif</label>
								<div class="controls">
	';
							if ($r[aktif]=='Y'){
								echo "
									<label class=\"radio\">
										<input type=radio name='aktif' value='Y' checked>Y
									</label>
									<div style=\"clear:both\"></div>
									<label class=\"radio\">
										<input type=radio name='aktif' value='N'>N
									</label>
								";
							}
							else{
								echo "
									<label class=\"radio\">
										<input type=radio name='aktif' value='Y'>Y
									</label>
									<div style=\"clear:both\"></div>
									<label class=\"radio\">
										<input type=radio name='aktif' value='N' checked>N
									</label>	
								";
							}
	echo '
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
	
	case "view":
	
	$edit=mysql_query("SELECT * FROM album WHERE id_album='$_GET[id]'");
    $r=mysql_fetch_array($edit);
	
    echo '
		<div>
			<ul class="breadcrumb">
				<li>
					<a href="?module=home">Home</a> <span class="divider">/</span>
				</li>
				<li>
					<a href="?module=album">Album</a><span class="divider">/</span>
				</li>
				<li>
					<a href="#">'.$r[jdl_album].'</a>
				</li>
			</ul>
		</div>
		<div class="row-fluid sortable">
			<div class="box span12">
				<div class="box-header well" data-original-title>
					<h2><i class="icon-picture"></i> Album '.$r[jdl_album].'</h2>
					<div class="box-icon">
						<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
						<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
					</div>
				</div>
				<div class="box-content">
					<input type=button value=\'Tambah Gambar\' class="btn btn-primary" 
					onclick="window.location.href=\'?module=album&act=tambahgambar&id='.$r[id_album].'\';"><br /><br />
					<table class="table table-striped table-bordered bootstrap-datatable datatable">
						<thead>
							<tr>
								<th>No</th>
								<th>Judul Album</th>
								<th>Gambar</th>
								<th>Album</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
	';
							$tampil = mysql_query("SELECT * FROM gallery WHERE id_album='$_GET[id]' ORDER BY id_gallery DESC");
							$no = 1;
							while($r_tampil=mysql_fetch_array($tampil)){
								
								echo "
								<tr>
									<td>$no</td>
									<td>$r_tampil[jdl_gallery]</td>
									<td>
										<img src='../img_galeri/kecil_$r_tampil[gbr_gallery]' style='width:70px;'>
									</td>
									<td align=center>
										$r[jdl_album]
									</td>
									<td>	
										<a class=\"btn btn-info\" href=?module=album&act=editgaleri&id=$r_tampil[id_gallery]&idalbum=$_GET[id]><i class=\"icon-edit icon-white\"></i> Edit</a> 
										<a class=\"btn btn-danger\" href='$aksi?module=album&act=hapusgaleri&id=$r_tampil[id_gallery]&namafile=$r_tampil[gbr_gallery]'><i class=\"icon-trash icon-white\"></i> Hapus</a>
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
	
	case "tambahgambar":
		
		$q_data_album = mysql_fetch_array(mysql_query("select * from album where id_album='$_GET[id]'"));
		
		echo '
		<div>
			<ul class="breadcrumb">
				<li>
					<a href="?module=home">Home</a> <span class="divider">/</span>
				</li>
				<li>
					<a href="?module=album">Album</a> <span class="divider">/</span>
				</li>
				<li>
					<a href="#">'.$q_data_album[jdl_album].'</a>
				</li>
			</ul>
		</div>
		<div class="row-fluid sortable">
			<div class="box span12">
				<div class="box-header well" data-original-title>
					<h2><i class="icon-picture"></i> Tambah Gambar</h2>
					<div class="box-icon">
						<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
						<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
					</div>
				</div>
				<div class="box-content">
					<form class="form-horizontal" method=POST action='.$aksi.'?module=album&act=inputgaleri enctype=\'multipart/form-data\'>
						<fieldset>
							<div class="control-group">
								<label class="control-label">Judul Foto</label>
								<div class="controls">
									<input type=text name="jdl_gallery" />
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Album</label>
								<div class="controls">
									<select name="album" id="selectError" data-rel="chosen">
	';
								$q_album = mysql_query("select * from album order by id_album asc");
								while($r_album = mysql_fetch_array($q_album)){
									echo "<option value='$r_album[id_album]'>$r_album[jdl_album]</option>";
								}
	echo '
									</select>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Gambar</label>
								<div class="controls">
									<input type=file name="fupload" size=40>
									<br>Tipe gambar harus JPG/JPEG dan min: 490px X 366px
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
	
	case "editgaleri":
		
		$q_data_album = mysql_fetch_array(mysql_query("select * from album where id_album='$_GET[idalbum]'"));
		$q_data_galeri = mysql_fetch_array(mysql_query("select * from gallery where id_gallery='$_GET[id]'"));
		echo '
		<div>
			<ul class="breadcrumb">
				<li>
					<a href="?module=home">Home</a> <span class="divider">/</span>
				</li>
				<li>
					<a href="?module=album">Album</a> <span class="divider">/</span>
				</li>
				<li>
					<a href="?module=album&act=view&id='.$q_data_album[id_album].'">'.$q_data_album[jdl_album].'</a><span class="divider">/</span>
				</li>
				<li>
					<a href="#">'.$q_data_galeri[jdl_gallery].'</a>
				</li>
			</ul>
		</div>
		<div class="row-fluid sortable">
			<div class="box span12">
				<div class="box-header well" data-original-title>
					<h2><i class="icon-picture"></i> Edit Gambar</h2>
					<div class="box-icon">
						<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
						<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
					</div>
				</div>
				<div class="box-content">
					<form class="form-horizontal" method=POST action='.$aksi.'?module=album&act=updategaleri enctype=\'multipart/form-data\'>
						<fieldset>
							<div class="control-group">
								<label class="control-label">Judul Foto</label>
								<div class="controls">
									<input type="hidden" name="id" value="'.$q_data_galeri[id_gallery].'" />
									<input type=text name="jdl_gallery" value="'.$q_data_galeri[jdl_gallery].'" />
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Album</label>
								<div class="controls">
									<select name="album" id="selectError" data-rel="chosen">
	';
								$q_album = mysql_query("select * from album order by id_album asc");
								while($r_album = mysql_fetch_array($q_album)){
									if($r_album[id_album] == $q_data_album[id_album]){
										echo "<option value='$r_album[id_album]' selected>$r_album[jdl_album]</option>";
									}
									else{
										echo "<option value='$r_album[id_album]'>$r_album[jdl_album]</option>";
									}
								}
	echo '
									</select>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Gambar</label>
								<div class="controls">
									<img src="../img_galeri/kecil_'.$q_data_galeri[gbr_gallery].'" />
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Ganti Gambar</label>
								<div class="controls">
									<input type=file name="fupload" size=40>
									<br>Tipe gambar harus JPG/JPEG dan min: 490px X 366px
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
	';
		
	break;
	
}
}
?>
