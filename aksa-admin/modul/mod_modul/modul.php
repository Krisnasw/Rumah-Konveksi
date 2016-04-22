<?php
$aksi="modul/mod_modul/aksi_modul.php";
switch($_GET[act]){
  // Tampil Modul
  default:
	echo '
		<div>
			<ul class="breadcrumb">
				<li>
					<a href="?module=home">Home</a> <span class="divider">/</span>
				</li>
				<li>
					<a href="#">Modul</a>
				</li>
			</ul>
		</div>
		<div class="row-fluid sortable">
			<div class="box span12">
				<div class="box-header well" data-original-title>
					<h2><i class="icon-cog"></i> Modul</h2>
					<div class="box-icon">
						<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
						<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
					</div>
				</div>
				<div class="box-content">
					<input type=button value=\'Tambah Modul\' class="btn btn-primary" 
					onclick="window.location.href=\'?module=modul&act=tambahmodul\';">
					<br /><br />
					<table class="table table-striped table-bordered bootstrap-datatable datatable">
						<thead>
							<tr>
								<th>No</th>
								<th>Nama Modul</th>
								<th>Link</th>
								<th>Aktif</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
	';
						$tampil=mysql_query("SELECT * FROM modul ORDER BY urutan");
						while ($r=mysql_fetch_array($tampil)){
							echo "
							<tr>
								<td>$r[urutan]</td>
								<td>$r[nama_modul]</td>
								<td><a href=$r[link]>$r[link]</a></td>
								<td align=center>$r[aktif]</td>
								<td>
									<a class=\"btn btn-info\" href=?module=modul&act=editmodul&id=$r[id_modul]><i class=\"icon-edit icon-white\"></i> Edit</a>
									<a class=\"btn btn-danger\" href=$aksi?module=modul&act=hapus&id=$r[id_modul]><i class=\"icon-trash icon-white\"></i> Hapus</a>
								</td>
							</tr>
							";
						}
	echo '
						</tbody>
					</table>
				</div>
			</div>
		</div>
	';
	
    break;

  case "tambahmodul":
	echo '
		<div>
			<ul class="breadcrumb">
				<li>
					<a href="?module=home">Home</a> <span class="divider">/</span>
				</li>
				<li>
					<a href="?module=modul">Modul <span class="divider">/</a>
				</li>
				<li>
					<a href="#">Tambah Modul</a>
				</li>
			</ul>
		</div>
		<div class="row-fluid sortable">
			<div class="box span12">
				<div class="box-header well" data-original-title>
					<h2><i class="icon-plus-sign"></i> Tambah Modul</h2>
					<div class="box-icon">
						<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
						<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
					</div>
				</div>
				<div class="box-content">
					<form class="form-horizontal" method=POST action='.$aksi.'?module=modul&act=input>
						<fieldset>
							<div class="control-group">
								<label class="control-label">Nama Modul</label>
								<div class="controls">
									<input type=text name="nama_modul" />
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
									<label class="radio">
										<input type=radio name="aktif" value="Y">Y
									</label>
									<div style="clear:both"></div>
									<label class="radio">
										<input type=radio name="aktif" value="N"> N
									</label>
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
 
  case "editmodul":
    $edit = mysql_query("SELECT * FROM modul WHERE id_modul='$_GET[id]'");
    $r    = mysql_fetch_array($edit);

    echo '
		<div>
			<ul class="breadcrumb">
				<li>
					<a href="?module=home">Home</a> <span class="divider">/</span>
				</li>
				<li>
					<a href="?module=modul">Modul <span class="divider">/</a>
				</li>
				<li>
					<a href="#">Edit Modul</a>
				</li>
			</ul>
		</div>
		<div class="row-fluid sortable">
			<div class="box span12">
				<div class="box-header well" data-original-title>
					<h2><i class="icon-edit"></i> Edit Modul</h2>
					<div class="box-icon">
						<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
						<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
					</div>
				</div>
				<div class="box-content">
					<form class="form-horizontal" method=POST action='.$aksi.'?module=modul&act=update>
						<fieldset>
							<input type=hidden name=id value='.$r[id_modul].'>
							<div class="control-group">
								<label class="control-label">Nama Modul</label>
								<div class="controls">
									<input type=text name="nama_modul" value="'.$r[nama_modul].'" />
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Link</label>
								<div class="controls">
									<input type=text name="link" value="'.$r[link].'" />
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Aktif</label>
								<div class="controls">
	';
							if ($r[aktif]=='Y'){
								echo '
									<label class="radio">
										<input type=radio name="aktif" value="Y" checked>Y
									</label>
									<div style="clear:both"></div>
									<label class="radio">
										<input type=radio name="aktif" value="N"> N
									</label>
								';
							}
							else{
								echo '
									<label class="radio">
										<input type=radio name="aktif" value="Y" >Y  
									</label>
									<div style="clear:both"></div>
									<label class="radio">
										<input type=radio name="aktif" value="N" checked> N
									</label>
								';
							}
	echo '
								
									
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Urutan</label>
								<div class="controls">
									<input type=text name="urutan" value="'.$r[urutan].'" />
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
