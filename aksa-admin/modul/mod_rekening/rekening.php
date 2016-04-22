<?php
session_start();
if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
  $aksi="modul/mod_rekening/aksi_rekening.php";
  switch($_GET[act]){
  // Tampil Rekening
  default:
    echo "
		<div>
			<ul class='breadcrumb'>
				<li>
					<a href='?module=home'>Home</a> <span class='divider'>/</span>
				</li>
				<li>
					<a href='#'>Rekening</a>
				</li>
			</ul>
		</div>
			
			<div class=\"row-fluid sortable\">
				<div class=\"box span12\">
					<div class=\"box-header well\" data-original-title>
					<h2><i class=\"icon-book\"></i> Rekening</h2>
					<div class=\"box-icon\">
						<a href='#' class='btn btn-minimize btn-round'><i class='icon-chevron-up'></i></a>
						<a href='#' class='btn btn-close btn-round'><i class='icon-remove'></i></a>
					</div>
				</div>
				<div class='box-content'>
					<input type=button value='Tambah Rekening' class='btn btn-primary' 
					onclick=\"window.location.href='?module=rekening&act=tambahrekening';\"><br><br>
					<table class='table table-striped table-bordered bootstrap-datatable datatable'>	<thead>
							<tr>
								<th>No</th>
								<th>Bank </th>
								<th>No Rekening </th>
								<th>Nama Pemilik</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
	";
				$tampil = mysql_query("SELECT * FROM rekening ORDER BY id_rekening DESC ");  
				$no = 1;
				while($r=mysql_fetch_array($tampil)){
					echo "<tr>
						<td>$no</td>
						<td>
							$r[bank]
						</td><td>
							$r[no_rekening]
						</td>
						<td>$r[nama_pemilik]</td>
						<td>
							<a class=\"btn btn-info\" href=?module=rekening&act=editrekening&id=$r[id_rekening]>
								<i class=\"icon-edit icon-white\"></i> Edit</a> 
							<a class=\"btn btn-danger\" href='$aksi?module=rekening&act=hapus&id=$r[id_rekening]&namafile=$r[gambar]'>
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
  
  case "tambahrekening":
    echo "<div>
			<ul class='breadcrumb'>
				<li>
					<a href='?module=home'>Home</a> <span class='divider'>/</span>
				</li>
				<li>
					<a href='?module=rekening'>Rekening</a> <span class='divider'>/</span>
				</li>
				<li>
					<a href='#'>Tambah Rekening</a>
				</li>
			</ul>
		</div>
			
		<div class='row-fluid sortable'>
			<div class='box span12'>
				<div class='box-header well' data-original-title>
					<h2><i class='icon-plus-sign'></i> Tambah Rekening</h2>
					<div class='box-icon'>
						<a href='#' class='btn btn-minimize btn-round'><i class='icon-chevron-up'></i></a>
						<a href='#' class='btn btn-close btn-round'><i class='icon-remove'></i></a>
					</div>
				</div>
						<div class=\"box-content\">
							<form action=\"$aksi?module=rekening&act=input\" method=\"POST\" enctype='multipart/form-data' class='form-horizontal form-striped'>
								<div class=\"control-group\">
									<label class=\"control-label\">Bank</label>
									<div class=\"controls\">
										<input type=\"text\" name=\"bank\" class=\"input-xlarge\">
									</div>
								</div>
								<div class=\"control-group\">
									<label class=\"control-label\">No Rekening</label>
									<div class=\"controls\">
										<input type=\"text\" name=\"norek\" class=\"input-xlarge\">
									</div>
								</div>
								<div class=\"control-group\">
									<label class=\"control-label\">Nama Pemilik</label>
									<div class=\"controls\">
										<input type=\"text\" name=\"nama\" class=\"input-xlarge\">
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
    
  case "editrekening":
    $edit = mysql_query("SELECT * FROM rekening WHERE id_rekening='$_GET[id]'");
    $r    = mysql_fetch_array($edit);

    echo "
		<div>
			<ul class='breadcrumb'>
				<li>
					<a href='?module=home'>Home</a> <span class='divider'>/</span>
				</li>
				<li>
					<a href='?module=rekening'>Rekening</a> <span class='divider'>/</span>
				</li>
				<li>
					<a href='#'>Edit Rekening</a>
				</li>
			</ul>
		</div>			
		<div class=\"row-fluid sortable\">
			<div class='box span12'>
				<div class='box-header well' data-original-title>
					<h2><i class='icon-edit'></i> Edit Rekening</h2>
					<div class='box-icon'>
						<a href='#' class='btn btn-minimize btn-round'><i class='icon-chevron-up'></i></a>
						<a href='#' class='btn btn-close btn-round'><i class='icon-remove'></i></a>
					</div>
				</div>
					<div class=\"box-content\">
						<form action=\"$aksi?module=rekening&act=update\" method=\"POST\" enctype='multipart/form-data' class='form-horizontal form-striped'>
							<div class=\"control-group\">
								<input type=hidden name=id value=$r[id_rekening]>
								<label class=\"control-label\">Bank </label>
								<div class=\"controls\">
									<input type=\"text\" name=\"bank\" value='$r[bank]' class=\"input-xlarge\">
								</div>
							</div>
							<div class=\"control-group\">
								<label class=\"control-label\">No Rekening</label>
								<div class=\"controls\">
									<input type=\"text\" name=\"norek\" value='$r[no_rekening]' class=\"input-xlarge\">
								</div>
							</div>
							<div class=\"control-group\">
								<label class=\"control-label\">Nama Pemilik</label>
								<div class=\"controls\">
									<input type=\"text\" name=\"nama\" value='$r[nama_pemilik]' class=\"input-xlarge\">
								</div>
							</div>
							<div class=\"control-group\">
								<label class=\"control-label\">Keterangan</label>
								<div class=\"controls\">
";
								if ($r[keterangan]=='Y'){
									echo "
									<label class='radio'>
										<input type=radio name='keterangan' value='Y' checked>Y
									</label>
									<div style='clear:both'></div>
									<label class='radio'>
										<input type=radio name='keterangan' value='N'>N
									</label>
									";
								}
								else{
									echo "
									<label class='radio'>
										<input type=radio name='keterangan' value='Y'>Y  
									</label>
									<div style='clear:both'></div>
									<label class='radio'>
										<input type=radio name='keterangan' value='N' checked>N
									</label>
									";
								}
echo "
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
