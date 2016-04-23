<?php
session_start();
 if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
$aksi="modul/mod_users/aksi_users.php";
switch($_GET[act]){
  // Tampil Users
  default:
    echo '
		<div>
			<ul class="breadcrumb">
				<li>
					<a href="?module=home">Home</a> <span class="divider">/</span>
				</li>
				<li>
					<a href="#">Admin</a>
				</li>
			</ul>
		</div>
		<div class="row-fluid sortable">
			<div class="box span12">
				<div class="box-header well" data-original-title>
					<h2><i class="icon-flag"></i> Admin</h2>
					<div class="box-icon">
						<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
						<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
					</div>
				</div>
				<div class="box-content">
					<table class="table table-striped table-bordered bootstrap-datatable datatable">
						<thead>
							<tr>
								<th>No</th>
								<th>Username</th>
								<th>Nama</th>
								<th>Email</th>
								<th>Telp</th>
								<th>Level</th>
								<th>Blokir</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
	';    
	
	if ($_SESSION[leveluser]=='admin'){
      $tampil = mysql_query("SELECT * FROM users  WHERE level='user' ORDER BY id_users");
   //    echo "
			// <input type=button value='Tambah User' class='btn btn-primary' onclick=\"window.location.href='?module=users&act=tambahusers';\"><br><br>
   //    ";
    }
    else{
      $tampil=mysql_query("SELECT * FROM users WHERE level='admin'");
      echo "
			<input type=button value='Tambah Admin' class='btn btn-primary' onclick=\"window.location.href='?module=users&act=tambahusers';\"><br><br>
      ";
      
    }
							$no=1;
							while ($r=mysql_fetch_array($tampil)){
								$tgl=tgl_indo($r[tgl_posting]);
								echo "
								<tr>
									<td>$no</td>
									<td>$r[username]</td>
									<td>$r[nama_lengkap]</td>
									<td>$r[email]</td>
									<td>$r[no_telp]</td>
									<td>$r[level]</td>
									<td><center>$r[blokir]</center></td>
									<td>
										<a class=\"btn btn-info\" href=?module=users&act=editusers&id=$r[id_users]><i class=\"icon-edit icon-white\"></i> Edit</a> 
										<a class=\"btn btn-danger\" href='$aksi?module=users&act=hapus&id=$r[id_users]&namafile=$r[gambar]'><i class=\"icon-trash icon-white\"></i> Hapus</a>
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
  
  case "tambahusers":
	echo '
		<div>
			<ul class="breadcrumb">
				<li>
					<a href="?module=home">Home</a> <span class="divider">/</span>
				</li>
				<li>
					<a href="?module=users">Admin</a> <span class="divider">/</span>
				</li>
				<li>
					<a href="#">Tambah Admin</a>
				</li>
			</ul>
		</div>
		<div class="row-fluid sortable">
			<div class="box span12">
				<div class="box-header well" data-original-title>
					<h2><i class="icon-plus-sign"></i> Tambah Admin</h2>
					<div class="box-icon">
						<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
						<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
					</div>
				</div>
				<div class="box-content">
					<form class="form-horizontal" method=POST action="'.$aksi.'?module=users&act=input" enctype=\'multipart/form-data\'>
						<fieldset>
							<div class="control-group">
								<label class="control-label">Username</label>
								<div class="controls">
									<input type=text name="username" />
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Password</label>
								<div class="controls">
									<input type=password name="password" />
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Nama Lengkap</label>
								<div class="controls">
									<input type=text name="nama" />
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Email</label>
								<div class="controls">
									<input type=text name="email" />
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Telephone</label>
								<div class="controls">
									<input type=text name="telp" />
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Level</label>
								<div class="controls">
									<select name="level">
									<option value="admin"> Admin </option>
									<!--<option value="moderator" selected> Moderator </option>-->
								</select>
								</div>
							</div>

							<div class="control-group">
								<label class="control-label">Gambar</label>
								<div class="controls">
									<input type=file name="fupload" />
								</div>
							</div>
							
							<div class="control-group">
								<label class="control-label">Blokir</label>
								<div class="controls">
									<label class="radio">
										<input type=radio name="blokir" value="Y">Y
									</label>
									<div style="clear:both"></div>
									<label class="radio">
										<input type=radio name="blokir" value="N"> N
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
    
  case "editusers":
    $edit = mysql_query("SELECT * FROM users WHERE id_users='$_GET[id]'");
    $r    = mysql_fetch_array($edit);

    echo '
		<div>
			<ul class="breadcrumb">
				<li>
					<a href="?module=home">Home</a> <span class="divider">/</span>
				</li>
				<li>
					<a href="?module=users">Admin</a> <span class="divider">/</span>
				</li>
				<li>
					<a href="#">Edit Admin</a>
				</li>
			</ul>
		</div>
		<div class="row-fluid sortable">
			<div class="box span12">
				<div class="box-header well" data-original-title>
					<h2><i class="icon-edit"></i> Edit Admin</h2>
					<div class="box-icon">
						<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
						<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
					</div>
				</div>
				<div class="box-content">
					<form class="form-horizontal" method=POST enctype=\'multipart/form-data\' action='.$aksi.'?module=users&act=update>
						<fieldset>
							<input type=hidden name=id value='.$r[id_users].'>
							<div class="control-group">
								<label class="control-label">Username</label>
								<div class="controls">
									<input type=text name="username" value="'.$r[username].'" readonly/>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Password</label>
								<div class="controls">
									<input type=text name="password" />
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Nama Lengkap</label>
								<div class="controls">
									<input type=text name="nama" value="'.$r[nama_lengkap].'"/>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Email</label>
								<div class="controls">
									<input type=text name="email" value="'.$r[email].'"/>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Telephone</label>
								<div class="controls">
									<input type=text name="telp" value="'.$r[no_telp].'"/>
								</div>
							</div>	';
							if ($_SESSION[leveluser] == 'moderator' || $_SESSION[leveluser] == 'admin' ) {
echo'							
						<div class="control-group">
							<label class="control-label">Level</label>
							<div class="controls">
								<select name="level">
';
										if ($r[level]=='user'){
											echo "<option value=$r[level] selected>$r[level]</option>";
											
										}
										else{
											
											echo "<option value=admin selected>Admin</option>";
										}
echo '
								</select>
							</div>
						</div>
						<div class="control-group">
								<label class="control-label">Gambar</label>
								<div class="controls">
									<img src=\'../foto_banner/'.$r[gambar].'\' style="width:200px">
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Ganti Gbr</label>
								<div class="controls">
									<input type=file name=\'fupload\'>
									<br>Apabila gambar tidak diubah, dikosongkan saja.
								</div>
							</div>
						<div class="control-group">
							<label class="control-label">Blokir</label>
							<div class="controls">
';
						if ($r[blokir]=='Y'){
							echo '
								<label class="radio">
									<input type=radio name="blokir" value="Y" checked>Y
								</label>
								<div style="clear:both"></div>
								<label class="radio">
									<input type=radio name="blokir" value="N"> N
								</label>
							';
						}
						else{
							echo '
								<label class="radio">
									<input type=radio name="blokir" value="Y" >Y  
								</label>
								<div style="clear:both"></div>
								<label class="radio">
									<input type=radio name="blokir" value="N" checked> N
								</label>
							';
						}
echo '									
							</div>
						</div>';
							}
echo '										
							</label>* Apabila password tidak di ganti, dikosongkan saja. </label>
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
