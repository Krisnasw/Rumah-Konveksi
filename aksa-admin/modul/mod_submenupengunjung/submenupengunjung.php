<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
$aksi="modul/mod_submenupengunjung/aksi_submenupengunjung.php";
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
					<a href='#'>Sub Menu Pengunjung</a>
				</li>
			</ul>
		</div>
			
			<div class=\"row-fluid sortable\">
				<div class=\"box span12\">
					<div class=\"box-header well\" data-original-title>
					<h2><i class=\"icon-list-alt\"></i> Sub Menu Pengunjung</h2>
					<div class=\"box-icon\">
						<a href='#' class='btn btn-minimize btn-round'><i class='icon-chevron-up'></i></a>
						<a href='#' class='btn btn-close btn-round'><i class='icon-remove'></i></a>
					</div>
				</div>
			<br>
			<div class='box-content'>
					<input type=button value='Tambah Menu ' class='btn btn-primary' 
					onclick=\"window.location.href='?module=submenupengunjung&act=tambahsubmenupengunjung';\"><br><br>
					<table class='table table-striped table-bordered bootstrap-datatable datatable'>	<thead>
							<tr><th>No</th>
								<th>sub menu</th>
								<th>menu utama</th>
								<th>link submenu</th>
								<th>aksi</th>
							</tr>
						</thead>
						<tbody>
	";
          
    $tampil = mysql_query("SELECT s.*,m.nama_menu FROM submenu s,mainmenu m WHERE s.id_main=m.id_main AND adminsubmenu='N'");
  
    $no = 1;
    while($r=mysql_fetch_array($tampil)){
	if($r[id_submain]!=0){
		$sub = mysql_fetch_array(mysql_query("SELECT * FROM submenu WHERE id_sub=$r[id_submain]"));
		$mainmenu = $r[nama_menu]." &gt; ".$sub[nama_sub];
	} else {
		$mainmenu = $r[nama_menu];
	}
    
	echo "							<tr>
										<td>$no</td>
										<td>$r[nama_sub]</td>
										<td>$mainmenu</td>
										<td>$r[link_sub]</td>
										<td>
							<a class=\"btn btn-info\" href=?module=submenupengunjung&act=editsubmenupengunjung&id=$r[id_sub]>
								<i class=\"icon-edit icon-white\"></i> Edit</a> 
							<a class=\"btn btn-danger\" href='$aksi?module=submenupengunjung&act=hapus&id=$r[id_sub]&namafile=$r[gambar]'>
								<i class=\"icon-trash icon-white\"></i> Hapus</a>
							</a>
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
  
  case "tambahsubmenupengunjung":
    echo "
		<div>
			<ul class='breadcrumb'>
				<li>
					<a href='?module=home'>Home</a> <span class='divider'>/</span>
				</li>
				<li>
					<a href='?module=submenupengunjung'>Sub Menu Pengunjung</a> <span class='divider'>/</span>
				</li>
				<li>
					<a href='#'>Tambah Sub Menu Pengunjung</a>
				</li>
			</ul>
		</div>
			
		<div class='row-fluid sortable'>
			<div class='box span12'>
				<div class='box-header well' data-original-title>
					<h2><i class='icon-plus-sign'></i> Tambah Sub Menu Pengunjung</h2>
					<div class='box-icon'>
						<a href='#' class='btn btn-minimize btn-round'><i class='icon-chevron-up'></i></a>
						<a href='#' class='btn btn-close btn-round'><i class='icon-remove'></i></a>
					</div>
				</div>
				
					<div class=\"box-content\">
							<form action=\"$aksi?module=submenupengunjung&act=input\" method=\"POST\" enctype='multipart/form-data' class='form-horizontal form-striped'>
								<div class=\"control-group\">
									<label class=\"control-label\">Nama Sub Menu</label>
									<div class=\"controls\">
										<input type=\"text\" name=\"nama_sub\" class=\"input-xlarge\">
									</div>
								</div>
								<div class=\"control-group\">
									<label class=\"control-label\">Menu Utama</label>
									<div class=\"controls\">
										<select name='menu_utama' class='input-large'>
												<option value=\"0\">- Pilih Menu Utama -</option>
	";
			$tampil=mysql_query("SELECT * FROM mainmenu WHERE adminmenu='N' AND aktif='Y' ORDER BY id_main");
            while($r=mysql_fetch_array($tampil)){
				echo "							<option value=$r[id_main]>$r[nama_menu]</option>
				";
            }
	echo "
											</select>
									</div>
								</div>
								<div class=\"control-group\">
									<label class=\"control-label\">Link</label>
									<div class=\"controls\">
										<input type=\"text\" name=\"link\" class=\"input-xlarge\">
										<input type='hidden' name='aktif' value='Y'>
										<input type='hidden' name='adminsubmenu' value='N'>
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
  
  // Form Edit Menu 
  case "editsubmenupengunjung":
    $edit=mysql_query("SELECT * FROM submenu WHERE id_sub='$_GET[id]'");
    $r=mysql_fetch_array($edit);

    echo "
			<div>
			<ul class='breadcrumb'>
				<li>
					<a href='?module=home'>Home</a> <span class='divider'>/</span>
				</li>
				<li>
					<a href='?module=submenupengunjung'>Sub Menu Pengunjung</a> <span class='divider'>/</span>
				</li>
				<li>
					<a href='#'>Edit Sub Menu Pengunjung</a>
				</li>
			</ul>
		</div>			
		<div class=\"row-fluid sortable\">
			<div class='box span12'>
				<div class='box-header well' data-original-title>
					<h2><i class='icon-edit'></i> Edit Sub Menu Pengunjung</h2>
					<div class='box-icon'>
						<a href='#' class='btn btn-minimize btn-round'><i class='icon-chevron-up'></i></a>
						<a href='#' class='btn btn-close btn-round'><i class='icon-remove'></i></a>
					</div>
				</div>
				
					<div class=\"box-content\">
						<form action=\"$aksi?module=submenupengunjung&act=update\" method=\"POST\" enctype='multipart/form-data' class='form-horizontal form-striped'>
							<div class=\"control-group\">
								<input type=hidden name=id value=$r[id_sub]>
								<label class=\"control-label\">Nama Sub Menu</label>
								<div class=\"controls\">
									<input type=\"text\" name=\"nama_sub\" value='$r[nama_sub]' class=\"input-xlarge\">
								</div>
							</div>
							<div class=\"control-group\">
								<label class=\"control-label\">Menu Utama</label>
								<div class=\"controls\">
									<select name='menu_utama' class='input-large'>
";
		$tampil=mysql_query("SELECT * FROM mainmenu WHERE adminmenu='N' AND aktif='Y' ORDER BY id_main");
		if ($r[id_main]==0){
			echo "					<option value=0 selected>- Pilih Menu Utama -</option>";
		}   
		while($w=mysql_fetch_array($tampil)){
			if ($r[id_main]==$w[id_main]){
			  echo "				<option value=$w[id_main] selected>$w[nama_menu]</option>";
			}
			else{
			  echo "				<option value=$w[id_main]>$w[nama_menu]</option>";
			}
		}
echo "
									</select>
								</div>
							</div>
							<div class=\"control-group\">
								<label class=\"control-label\">Link</label>
								<div class=\"controls\">
									<input type=\"text\" name=\"link\" value='$r[link_sub]' class=\"input-xlarge\">
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
										<input type=radio name='aktif' value=Y checked>Y
									</label>
									<div style='clear:both'></div>
									<label class='radio'>
										<input type=radio name='aktif' value=N> N
									</label>
			";
		}
		else{
			echo "
									<label class='radio'>
										<input type=radio name='aktif' value=Y >Y  
									</label>
									<div style='clear:both'></div>
									<label class='radio'>
										<input type=radio name='aktif' value=N checked> N
									</label>
			";
		}
echo "
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
