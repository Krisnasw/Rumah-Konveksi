<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
$aksi="modul/mod_menupengunjung/aksi_menupengunjung.php";
switch($_GET[act]){
  // Tampil Menu Utama
  default:
    echo "
		<div>
			<ul class='breadcrumb'>
				<li>
					<a href='?module=home'>Home</a> <span class='divider'>/</span>
				</li>
				<li>
					<a href='#'>Menu Pengunjung</a>
				</li>
			</ul>
		</div>
			
			<div class=\"row-fluid sortable\">
				<div class=\"box span12\">
					<div class=\"box-header well\" data-original-title>
					<h2><i class=\"icon-list-alt\"></i> Menu Pengunjung</h2>
					<div class=\"box-icon\">
						<a href='#' class='btn btn-minimize btn-round'><i class='icon-chevron-up'></i></a>
						<a href='#' class='btn btn-close btn-round'><i class='icon-remove'></i></a>
					</div>
				</div>
			<br>
			<div class=\"alert alert-info\">
				<h4>Information!</h4>
				<p>
					*) Data pada Menu tidak bisa dihapus, tapi bisa di non-aktifkan melalui Edit Menu.<br>
					**) Untuk link menu Beranda (Home) harus diubah ketika online menjadi http://NamaDomainAnda.com
				</p>
			</div>
			
			<div class='box-content'>
					<input type=button value='Tambah Menu ' class='btn btn-primary' 
					onclick=\"window.location.href='?module=menupengunjung&act=tambahmenupengunjung';\"><br><br>
					<table class='table table-striped table-bordered bootstrap-datatable datatable'>	<thead>
							<tr>
								<th>No</th>
								<th>Menu</th>
								<th>Link</th>
								<th>Aktif</th>
								<th>Urutan</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
	";
          
    $tampil=mysql_query("SELECT * FROM mainmenu WHERE adminmenu='N'");
    $no=1;
    while ($r=mysql_fetch_array($tampil)){
echo "						<tr>
								<td>$no</td>
								<td>$r[nama_menu]</td>
								<td>$r[link]</td>
								<td>$r[aktif]</td>
								<td>$r[no_urut]</td>
								<td>
									<a class=\"btn btn-info\" href=?module=menupengunjung&act=editmenupengunjung&id=$r[id_main]>
									<i class=\"icon-edit icon-white\"></i> Edit</a>
								</td>
							</tr>";
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
  
  case "tambahmenupengunjung":
    echo "
		<div>
			<ul class='breadcrumb'>
				<li>
					<a href='?module=home'>Home</a> <span class='divider'>/</span>
				</li>
				<li>
					<a href='?module=menupengunjung'>Menu Pengunjung</a> <span class='divider'>/</span>
				</li>
				<li>
					<a href='#'>Tambah Menu Pengunjung</a>
				</li>
			</ul>
		</div>
			
		<div class='row-fluid sortable'>
			<div class='box span12'>
				<div class='box-header well' data-original-title>
					<h2><i class='icon-plus-sign'></i> Tambah Menu Pengunjung</h2>
					<div class='box-icon'>
						<a href='#' class='btn btn-minimize btn-round'><i class='icon-chevron-up'></i></a>
						<a href='#' class='btn btn-close btn-round'><i class='icon-remove'></i></a>
					</div>
				</div>
				
					<div class=\"box-content\">
							<form action=\"$aksi?module=menupengunjung&act=input\" method=\"POST\" enctype='multipart/form-data' class='form-horizontal form-striped'>
								<div class=\"control-group\">
									<label class=\"control-label\">Nama Menu</label>
									<div class=\"controls\">
										<input type=\"text\" name=\"nama_menu\" class=\"input-xlarge\">
									</div>
								</div><div class=\"control-group\">
									<label class=\"control-label\">Link</label>
									<div class=\"controls\">
										<input type=\"text\" name=\"link\" class=\"input-xlarge\">
										<input type='hidden' name='aktif' value='Y'>
										<input type='hidden' name='adminmenu' value='N'>
									</div>
								</div>
								<div class=\"control-group\">
									<label class=\"control-label\">No Urut</label>
									<div class=\"controls\">";
									
									$qMaxUrut = mysql_query("SELECT MAX(no_urut) as urutanterbesar FROM mainmenu WHERE adminmenu='N' AND aktif='Y'");
									$rMaxUrut = mysql_fetch_array($qMaxUrut);
									$NU = $rMaxUrut[urutanterbesar] + 1;
									echo "
										<input type='text' name='no_urut' value='$NU'>
									</div>
								</div>								
								<div class=\"form-actions\">
									<input type=submit value=Simpan name=submit class=\"btn btn-primary\">
									<button type=\"button\" class=\"btn\" onclick=self.history.back()>Batal</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
	";
     break;
  
  // Form Edit Menu Utama
  case "editmenupengunjung":
    $edit=mysql_query("SELECT * FROM mainmenu WHERE id_main='$_GET[id]'");
    $r=mysql_fetch_array($edit);

    echo "
			<div>
			<ul class='breadcrumb'>
				<li>
					<a href='?module=home'>Home</a> <span class='divider'>/</span>
				</li>
				<li>
					<a href='?module=menupengunjung'>Menu Pengunjung</a> <span class='divider'>/</span>
				</li>
				<li>
					<a href='#'>Edit Menu Pengunjung</a>
				</li>
			</ul>
		</div>			
		<div class=\"row-fluid sortable\">
			<div class='box span12'>
				<div class='box-header well' data-original-title>
					<h2><i class='icon-edit'></i> Edit Menu Pengunjung</h2>
					<div class='box-icon'>
						<a href='#' class='btn btn-minimize btn-round'><i class='icon-chevron-up'></i></a>
						<a href='#' class='btn btn-close btn-round'><i class='icon-remove'></i></a>
					</div>
				</div>
				
					<div class=\"box-content\">
						<form action=\"$aksi?module=menupengunjung&act=update\" method=\"POST\" enctype='multipart/form-data' class='form-horizontal form-striped'>
							<div class=\"control-group\">
								<input type=hidden name=id value=$r[id_main]>
								<label class=\"control-label\">Nama Menu</label>
								<div class=\"controls\">
									<input type=\"text\" name=\"nama_menu\" value='$r[nama_menu]' class=\"input-xlarge\">
								</div>
							</div><div class=\"control-group\">
								<label class=\"control-label\">Link</label>
								<div class=\"controls\">
									<input type=\"text\" name=\"link\" value='$r[link]' class=\"input-xlarge\">
									<input type=hidden name='adminmenu' value='N'>
								</div>
							</div>
							
							<div class=\"control-group\">
								<label class=\"control-label\">Aktif</label>
								<div class=\"controls\">
	";
								if ($r[aktif]=='Y'){
									echo "
									<label class='radio'>
										<input type=radio name='aktif' value='Y' checked>Y
									</label>
									<div style='clear:both'></div>
									<label class='radio'>
										<input type=radio name='aktif' value='N'> N
									</label>
									";
								}
								else{
									echo "
									<label class='radio'>
										<input type=radio name='aktif' value='Y' >Y  
									</label>
									<div style='clear:both'></div>
									<label class='radio'>
										<input type=radio name='aktif' value='N' checked> N
									</label>
									";
								}
	echo "						</div>
							</div>	  
							<div class=\"control-group\">
								<label class=\"control-label\">No Urut</label>
								<div class=\"controls\">
									<select name='nu'>
										<option value='$r[no_urut]'>$r[no_urut]</option>
";
								$qNU = mysql_query("SELECT MAX(no_urut) as nour FROM mainmenu WHERE adminmenu='N' AND aktif='Y'");
								$rNU = mysql_fetch_array($qNU);
								$nb = $rNU[nour] + 1;
								for($n=1;$n<=$nb;$n++){
									$NUav = mysql_num_rows(mysql_query("SELECT no_urut FROM mainmenu WHERE adminmenu='N' AND aktif='Y' AND no_urut='$n'"));
									if($NUav > 0){
										
									}
									else{
										echo '<option value="'.$n.'">'.$n.'</option>';
									}
								}
echo "	
									</select>
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
}
}
?>
