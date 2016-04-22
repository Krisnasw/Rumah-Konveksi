<?php
session_start();
if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
  $aksi="modul/mod_partner/aksi_partner.php";
  switch($_GET[act]){
  // Tampil Partner
  default:
    echo "
		<div>
			<ul class='breadcrumb'>
				<li>
					<a href='?module=home'>Home</a> <span class='divider'>/</span>
				</li>
				<li>
					<a href='#'>Partner</a>
				</li>
			</ul>
		</div>
			
			<div class=\"row-fluid sortable\">
				<div class=\"box span12\">
					<div class=\"box-header well\" data-original-title>
					<h2><i class=\"icon-book\"></i> Partner</h2>
					<div class=\"box-icon\">
						<a href='#' class='btn btn-minimize btn-round'><i class='icon-chevron-up'></i></a>
						<a href='#' class='btn btn-close btn-round'><i class='icon-remove'></i></a>
					</div>
				</div>
				<div class='box-content'>
					<input type=button value='Tambah Partner' class='btn btn-primary' 
					onclick=\"window.location.href='?module=partner&act=tambahpartner';\"><br><br>
					<table class='table table-striped table-bordered bootstrap-datatable datatable'>	<thead>
							<tr>
								<th>No</th>
								<th>Nama Partner </th>
								<th>Gambar</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
	";
				$tampil = mysql_query("SELECT * FROM partner ORDER BY id_partner DESC ");  
				$no = 1;
				while($r=mysql_fetch_array($tampil)){
					echo "<tr>
						<td>$no</td>
						<td>$r[nama_partner]</td>
						<td><img src='../foto_partner/$r[gambar]' width='80'></td>
						<td>
							<a class=\"btn btn-info\" href=?module=partner&act=editpartner&id=$r[id_partner]>
								<i class=\"icon-edit icon-white\"></i> Edit</a> 
							<a class=\"btn btn-danger\" href='$aksi?module=partner&act=hapus&id=$r[id_partner]&namafile=$r[gambar]'>
								<i class=\"icon-trash icon-white\"></i> Hapus</a>
							</a>
						</td>
					</tr>
	";
					$no++;
				}
	echo "
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>				
	";
    break;
  
  case "tambahpartner":
    echo "<div>
			<ul class='breadcrumb'>
				<li>
					<a href='?module=home'>Home</a> <span class='divider'>/</span>
				</li>
				<li>
					<a href='?module=partner'>Partner</a> <span class='divider'>/</span>
				</li>
				<li>
					<a href='#'>Tambah Partner</a>
				</li>
			</ul>
		</div>
			
		<div class='row-fluid sortable'>
			<div class='box span12'>
				<div class='box-header well' data-original-title>
					<h2><i class='icon-plus-sign'></i> Tambah Partner</h2>
					<div class='box-icon'>
						<a href='#' class='btn btn-minimize btn-round'><i class='icon-chevron-up'></i></a>
						<a href='#' class='btn btn-close btn-round'><i class='icon-remove'></i></a>
					</div>
				</div>
						<div class=\"box-content\">
							<form action=\"$aksi?module=partner&act=input\" method=\"POST\" enctype='multipart/form-data' class='form-horizontal form-striped'>
								<div class=\"control-group\">
									<label class=\"control-label\">Nama Partner</label>
									<div class=\"controls\">
										<input type=\"text\" name=\"nama_partner\" class=\"input-xlarge\">
									</div>
								</div>
								<div class=\"control-group\">
									<label class=\"control-label\">Keterangan</label>
									<div class=\"controls\">
										<textarea name=\'deskripsi\' id=\"loko\" style=\'width: 580px; height: 350px;\'></textarea>
									</div>
								</div>
								<div class=\"control-group\">
									<label class=\"control-label\">Gambar</label>
									<div class=\"controls\">
										<input type=file name='fupload' size=40> 
                                        <br>Tipe gambar harus JPG/JPEG dan ukuran lebar max 200px
									</div>
								</div>
								<div class=\"form-actions\">
									<input type=submit class=\"btn btn-primary\" value=Simpan>
									<button type=\"button\" class=\"btn\" onclick=self.history.back()>Batal</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
	";
    break;
    
  case "editpartner":
    $edit = mysql_query("SELECT * FROM partner WHERE id_partner='$_GET[id]'");
    $r    = mysql_fetch_array($edit);

    echo "
		<div>
			<ul class='breadcrumb'>
				<li>
					<a href='?module=home'>Home</a> <span class='divider'>/</span>
				</li>
				<li>
					<a href='?module=partner'>Partner</a> <span class='divider'>/</span>
				</li>
				<li>
					<a href='#'>Edit Partner</a>
				</li>
			</ul>
		</div>			
		<div class=\"row-fluid sortable\">
			<div class='box span12'>
				<div class='box-header well' data-original-title>
					<h2><i class='icon-edit'></i> Edit Partner</h2>
					<div class='box-icon'>
						<a href='#' class='btn btn-minimize btn-round'><i class='icon-chevron-up'></i></a>
						<a href='#' class='btn btn-close btn-round'><i class='icon-remove'></i></a>
					</div>
				</div>
					<div class=\"box-content\">
						<form action=\"$aksi?module=partner&act=update\" method=\"POST\" enctype='multipart/form-data' class='form-horizontal form-striped'>
							<div class=\"control-group\">
								<input type=hidden name=id value=$r[id_partner]>
								<label class=\"control-label\">Judul Partner</label>
								<div class=\"controls\">
									<input type=\"text\" name=\"nama_partner\" value='$r[nama_partner]' class=\"input-xlarge\">
								</div>
							</div>
							<div class=\"control-group\">
								<label class=\"control-label\">Keterangan</label>
								<div class=\"controls\">
									<textarea name=deskripsi id=\"loko\" style=\'width: 580px; height: 350px;\'>$r[deskripsi]</textarea>
								</div>
							</div>
							<div class=\"control-group\">
								<label class=\"control-label\">Gambar</label>
								<div class=\"controls\">
";
								if ($r[gambar]!=''){
									echo "<img src='../foto_partner/$r[gambar]' width='80'>";  
								}
echo "
									<br>
									<input type=file name='fupload' size=30> <br>
									Apabila gambar tidak diubah, dikosongkan saja.
                                     <br>Tipe gambar harus JPG/JPEG dan ukuran lebar max 200px
								</div>
							</div>
							<div class=\"form-actions\">
								<input type=submit class=\"btn btn-primary\" value=Update>
								<button type=\"button\" class=\"btn\" onclick=self.history.back()>Batal</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	";
    break;  
}
}
?>
