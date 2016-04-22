<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
$aksi="modul/mod_event/aksi_event.php";
switch($_GET[act]){
  // Tampil artikel
  default:
    echo '
		<div>
			<ul class="breadcrumb">
				<li>
					<a href="?module=home">Home</a> <span class="divider">/</span>
				</li>
				<li>
					<a href="#">Event</a>
				</li>
			</ul>
		</div>
		<div class="row-fluid sortable">
			<div class="box span12">
				<div class="box-header well" data-original-title>
					<h2><i class="icon-file"></i> Event</h2>
					<div class="box-icon">
						<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
						<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
					</div>
				</div>
				<div class="box-content">
					<input type=button value=\'Tambah Event\' class="btn btn-primary" 
					onclick="window.location.href=\'?module=event&act=tambahevent\';"><br /><br />
					<table class="table table-striped table-bordered bootstrap-datatable datatable">
						<thead>
							<tr>
								<th>No</th>
								<th>Judul</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
	';
							$tampil = mysql_query("SELECT * FROM event ORDER BY id_news DESC");
							$no = 1;
							while($r=mysql_fetch_array($tampil)){
								$tanggal=tgl_indo($r[tgl_posting]);
								
								echo "
								<tr>
									<td>$no</td>
									<td>$r[judul]</td>
									<td>
										<a class=\"btn btn-info\" href=?module=event&act=editevent&id=$r[id_news]><i class=\"icon-edit icon-white\"></i> Edit</a> 
										<a class=\"btn btn-danger\" href='$aksi?module=event&act=hapus&id=$r[id_news]&namafile=$r[gambar]'><i class=\"icon-trash icon-white\"></i> Hapus</a>
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
  
  case "tambahevent":
    echo '
		<div>
			<ul class="breadcrumb">
				<li>
					<a href="?module=home">Home</a> <span class="divider">/</span>
				</li>
				<li>
					<a href="?module=event">Event</a> <span class="divider">/</span>
				</li>
				<li>
					<a href="#">Tambah Event</a>
				</li>
			</ul>
		</div>
		<div class="row-fluid sortable">
			<div class="box span12">
				<div class="box-header well" data-original-title>
					<h2><i class="icon-plus-sign"></i> Tambah Event</h2>
					<div class="box-icon">
						<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
						<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
					</div>
				</div>
				<div class="box-content">
					<form class="form-horizontal" method=POST action='.$aksi.'?module=event&act=input enctype=\'multipart/form-data\'>
						<fieldset>
							<div class="control-group">
								<label class="control-label">Judul</label>
								<div class="controls">
									<input type=text name="judul" />
								</div>
							</div>
						
							<div class="control-group">
								<label class="control-label">Deskripsi</label>
								<div class="controls">
									<textarea name=\'deskripsi\' id="loko" style=\'width: 580px; height: 350px;\'></textarea>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Gambar</label>
								<div class="controls">
									<input type=file name="fupload" size=60> 
									<br>Tipe gambar harus JPG/JPEG ukuran lebar min 480px
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
    
  case "editevent":
    $edit = mysql_query("SELECT * FROM event WHERE id_news='$_GET[id]'");
    $r    = mysql_fetch_array($edit);

    echo '
		<div>
			<ul class="breadcrumb">
				<li>
					<a href="?module=home">Home</a> <span class="divider">/</span>
				</li>
				<li>
					<a href="?module=event">Event</a> <span class="divider">/</span>
				</li>
				<li>
					<a href="#">Edit Event</a>
				</li>
			</ul>
		</div>
		<div class="row-fluid sortable">
			<div class="box span12">
				<div class="box-header well" data-original-title>
					<h2><i class="icon-edit"></i> Edit Event</h2>
					<div class="box-icon">
						<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
						<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
					</div>
				</div>
				<div class="box-content">
					<form class="form-horizontal" method=POST enctype=\'multipart/form-data\' action='.$aksi.'?module=event&act=update>
						<fieldset>
							<input type=hidden name=id value='.$r[id_news].'>
							<div class="control-group">
								<label class="control-label">Judul</label>
								<div class="controls">
									<input type=text name="judul" value="'.$r[judul].'" />
								</div>
							</div>	
							
							<div class="control-group">
								<label class="control-label">Deskripsi</label>
								<div class="controls">
									<textarea name=\'deskripsi\' id="loko" style=\'width: 600px; height: 350px;\'>'.$r[deskripsi].'</textarea>
								</div>
							</div>
							
							<div class="control-group">
								<label class="control-label">Gambar</label>
								<div class="controls">
									';
								if ($r[gambar]!=''){
									echo "<img src='../foto_berita/small_$r[gambar]' width='200px'>";  
								}
echo '<br><br>
									<input type=file name="fupload" size=40> <br>
									*) Apabila gambar tidak diubah, dikosongkan saja. Ukuran lebar min 480px
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
