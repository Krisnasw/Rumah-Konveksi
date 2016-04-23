<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
$aksi="modul/mod_sosial/aksi_sosial.php";
switch($_GET[act]){
  // Tampil sosial
  default:
    echo '
		<div>
			<ul class="breadcrumb">
				<li>
					<a href="?module=home">Home</a> <span class="divider">/</span>
				</li>
				<li>
					<a href="#">Media Sosial</a>
				</li>
			</ul>
		</div>
		<div class="row-fluid sortable">
			<div class="box span12">
				<div class="box-header well" data-original-title>
					<h2><i class="icon-file"></i> Media Sosial</h2>
					<div class="box-icon">
						<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
						<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
					</div>
				</div>
				<div class="box-content">
				
					<input type=button value=\'Tambah Media Sosial\' class="btn btn-primary" 
					onclick="window.location.href=\'?module=sosial&act=tambahsosial\';"><br /><br />
					<table class="table table-striped table-bordered bootstrap-datatable datatable">
						<thead>
							<tr>
								<th>No</th>
								<th>Nama Media</th>
								<th>Link</th>
								<th>Aktif</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
	';
							$tampil = mysql_query("SELECT * FROM sosial ORDER BY id_sosial DESC");
							$no = 1;
							while($r=mysql_fetch_array($tampil)){
								echo "
								<tr>
									<td>$no</td>
									<td>$r[nama]</td>
									<td>$r[link]</td>
									<td>$r[aktif]</td>
									<td>
										<a class=\"btn btn-info\" href=?module=sosial&act=editsosial&id=$r[id_sosial]><i class=\"icon-edit icon-white\"></i> Edit</a> 
										<a class=\"btn btn-danger\" href='$aksi?module=sosial&act=hapus&id=$r[id_sosial]&namafile=$r[gambar]'><i class=\"icon-trash icon-white\"></i> Hapus</a>
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
  
  case "tambahsosial":
    echo '
		<div>
			<ul class="breadcrumb">
				<li>
					<a href="?module=home">Home</a> <span class="divider">/</span>
				</li>
				<li>
					<a href="?module=sosial">Media Sosial</a> <span class="divider">/</span>
				</li>
				<li>
					<a href="#">Tambah Media Sosial</a>
				</li>
			</ul>
		</div>
		<div class="row-fluid sortable">
			<div class="box span12">
				<div class="box-header well" data-original-title>
					<h2><i class="icon-plus-sign"></i> Tambah Media Sosial</h2>
					<div class="box-icon">
						<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
						<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
					</div>
				</div>
				<div class="box-content">
					<form class="form-horizontal" method=POST action='.$aksi.'?module=sosial&act=input enctype=\'multipart/form-data\'>
						<fieldset>
							<div class="control-group">
								<label class="control-label">Nama Media</label>
								<div class="controls">
									<input type=text name="nama" />
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Link</label>
								<div class="controls">
									<input type=text name="link" />
								</div>
							</div>
							
							<div class="control-group">
								<label class="control-label">Aktif</label>
								<div class="controls">
	
									<label class=\"radio\">
										<input type=radio name=aktif value=Y> Y
									</label>
									<div style=\"clear:both\"></div>
									<label class=\"radio\">
										<input type=radio name=aktif value=N> N
									</label>
						
								</div>
							</div>
						
							<div class="control-group">
								<label class="control-label">Gambar</label>
								<div class="controls">
									<input type=file name="fupload" size=60> 
								
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
    
  case "editsosial":
    $edit = mysql_query("SELECT * FROM sosial WHERE id_sosial='$_GET[id]'");
    $r    = mysql_fetch_array($edit);

    echo '
		<div>
			<ul class="breadcrumb">
				<li>
					<a href="?module=home">Home</a> <span class="divider">/</span>
				</li>
				<li>
					<a href="?module=sosial">Media Sosial</a> <span class="divider">/</span>
				</li>
				<li>
					<a href="#">Edit Media Sosial</a>
				</li>
			</ul>
		</div>
		<div class="row-fluid sortable">
			<div class="box span12">
				<div class="box-header well" data-original-title>
					<h2><i class="icon-edit"></i> Edit Media Sosial</h2>
					<div class="box-icon">
						<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
						<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
					</div>
				</div>
				<div class="box-content">
					<form class="form-horizontal" method=POST enctype=\'multipart/form-data\' action='.$aksi.'?module=sosial&act=update>
						<fieldset>
							<input type=hidden name=id value='.$r[id_sosial].'>
							<div class="control-group">
								<label class="control-label">Nama Media</label>
								<div class="controls">
									<input type=text name="nama" value="'.$r[nama].'" />
								</div>
							</div>	
							<div class="control-group">
								<label class="control-label">Link</label>
								<div class="controls">
									<input type=text name="link" value="'.$r[link].'" />
								</div>
							</div>	
							<div class="control-group">
								<label class="control-label">Gambar</label>
								<div class="controls">
									';
								if ($r[gambar]!=''){
									echo "<img src='../files/$r[gambar]' width='20px'>";  
								}
echo '<br><br>
									<input type=file name="fupload" size=40> <br>
									*) Apabila gambar tidak diubah, dikosongkan saja. Ukuran lebar min 480px
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
}
}
?>
