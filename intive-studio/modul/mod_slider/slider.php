<?php
session_start();
if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
  $aksi="modul/mod_slider/aksi_slider.php";
  switch($_GET[act]){
  // Tampil Slider
  default:
    echo "
		<div>
			<ul class='breadcrumb'>
				<li>
					<a href='?module=home'>Home</a> <span class='divider'>/</span>
				</li>
				<li>
					<a href='#'>Slider</a>
				</li>
			</ul>
		</div>
			
			<div class=\"row-fluid sortable\">
				<div class=\"box span12\">
					<div class=\"box-header well\" data-original-title>
					<h2><i class=\"icon-book\"></i> Slider</h2>
					<div class=\"box-icon\">
						<a href='#' class='btn btn-minimize btn-round'><i class='icon-chevron-up'></i></a>
						<a href='#' class='btn btn-close btn-round'><i class='icon-remove'></i></a>
					</div>
				</div>
				<div class='box-content'>
					<input type=button value='Tambah Slider' class='btn btn-primary' 
					onclick=\"window.location.href='?module=slider&act=tambahslider';\"><br><br>
					<table class='table table-striped table-bordered bootstrap-datatable datatable'>	<thead>
							<tr>
								<th>No</th>
								<th>Judul </th>
								<th>Teks </th>
								<th style='width:52px;'>Gambar</th>
								<th>Status</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
	";
				$tampil = mysql_query("SELECT * FROM slider ORDER BY id_slider DESC ");  
				$no = 1;
				while($r=mysql_fetch_array($tampil)){
					echo "<tr>
						<td>$no</td>
						<td>
							$r[judul]
						</td><td>
							$r[teks]
						</td>
						<td><img src='../foto_slider/$r[gambar]' width='80'></td>
						<td>$r[status]</td>
						<td>
							<a class=\"btn btn-info\" href=?module=slider&act=editslider&id=$r[id_slider]>
								<i class=\"icon-edit icon-white\"></i> Edit</a> 
							<a class=\"btn btn-danger\" href='$aksi?module=slider&act=hapus&id=$r[id_slider]&namafile=$r[gambar]'>
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
  
  case "tambahslider":
    echo "<div>
			<ul class='breadcrumb'>
				<li>
					<a href='?module=home'>Home</a> <span class='divider'>/</span>
				</li>
				<li>
					<a href='?module=slider'>Slider</a> <span class='divider'>/</span>
				</li>
				<li>
					<a href='#'>Tambah Slider</a>
				</li>
			</ul>
		</div>
			
		<div class='row-fluid sortable'>
			<div class='box span12'>
				<div class='box-header well' data-original-title>
					<h2><i class='icon-plus-sign'></i> Tambah Slider</h2>
					<div class='box-icon'>
						<a href='#' class='btn btn-minimize btn-round'><i class='icon-chevron-up'></i></a>
						<a href='#' class='btn btn-close btn-round'><i class='icon-remove'></i></a>
					</div>
				</div>
						<div class=\"box-content\">
							<form action=\"$aksi?module=slider&act=input\" method=\"POST\" enctype='multipart/form-data' class='form-horizontal form-striped'>
								<div class=\"control-group\">
									<label class=\"control-label\">Judul Slider</label>
									<div class=\"controls\">
										<input type=\"text\" name=\"judul\" class=\"input-xlarge\">
									</div>
								</div><div class=\"control-group\">
									<label class=\"control-label\">Text Slider</label>
									<div class=\"controls\">
										<input type=\"text\" name=\"text\" class=\"input-xlarge\">
									</div>
								</div>
								<div class=\"control-group\">
									<label class=\"control-label\">Gambar</label>
									<div class=\"controls\">
										<input type=file name='fupload' size=40> 
                                        <br>Ukuran terbaik 1080px X 378px
                                        <br>Tipe gambar harus JPG/JPEG
									</div>
								</div>
								<div class=\"control-group\">
									<label class=\"control-label\">Jenis Slide</label>
									<div class=\"controls\">
										<select name='jenis_slide'>
											<option value=1>Slide 1</option>
											<option value=2>Slide 2</option>
											<option value=3>Slide 3</option>
											<option value=4>Slide 4</option>
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
    
  case "editslider":
    $edit = mysql_query("SELECT * FROM slider WHERE id_slider='$_GET[id]'");
    $r    = mysql_fetch_array($edit);

    echo "
		<div>
			<ul class='breadcrumb'>
				<li>
					<a href='?module=home'>Home</a> <span class='divider'>/</span>
				</li>
				<li>
					<a href='?module=slider'>Slider</a> <span class='divider'>/</span>
				</li>
				<li>
					<a href='#'>Edit Slider</a>
				</li>
			</ul>
		</div>			
		<div class=\"row-fluid sortable\">
			<div class='box span12'>
				<div class='box-header well' data-original-title>
					<h2><i class='icon-edit'></i> Edit Slider</h2>
					<div class='box-icon'>
						<a href='#' class='btn btn-minimize btn-round'><i class='icon-chevron-up'></i></a>
						<a href='#' class='btn btn-close btn-round'><i class='icon-remove'></i></a>
					</div>
				</div>
					<div class=\"box-content\">
						<form action=\"$aksi?module=slider&act=update\" method=\"POST\" enctype='multipart/form-data' class='form-horizontal form-striped'>
							<div class=\"control-group\">
								<input type=hidden name=id value=$r[id_slider]>
								<label class=\"control-label\">Judul Slider</label>
								<div class=\"controls\">
									<input type=\"text\" name=\"judul\" value='$r[judul]' class=\"input-xlarge\">
								</div>
							</div><div class=\"control-group\">
								<input type=hidden name=id value=$r[id_slider]>
								<label class=\"control-label\">Text Slider</label>
								<div class=\"controls\">
									<input type=\"text\" name=\"text\" value='$r[teks]' class=\"input-xlarge\">
								</div>
							</div>
							<div class=\"control-group\">
								<label class=\"control-label\">Gambar</label>
								<div class=\"controls\">
";
								if ($r[gambar]!=''){
									echo "<img src='../foto_slider/$r[gambar]' width='80'>";  
								}
echo "
									<br>
									<input type=file name='fupload' size=30> <br>
									*) Apabila gambar tidak diubah, dikosongkan saja.
									 <br>Ukuran terbaik 1080px X 378px
								</div>
							</div>
							<div class=\"control-group\">
								<label class=\"control-label\">Jenis Slide</label>
								<div class=\"controls\">
									<select name='jenis_slide'>
";
										for($js=1;$js<=4;$js++){
											if($js == $r[jenis_slider]){
												echo "<option value=$js selected>Slide $js</option>";
											}
											else{
												echo "<option value=$js>Slide $js</option>";
											}
										}
echo "
									</select>
								</div>
							</div>
							<div class=\"control-group\">
								<label class=\"control-label\">Aktif</label>
								<div class=\"controls\">
";
								if ($r[status]=='Y'){
									echo "
									<label class='radio'>
										<input type=radio name='status' value='Y' checked>Y
									</label>
									<div style='clear:both'></div>
									<label class='radio'>
										<input type=radio name='status' value='N'>N
									</label>
									";
								}
								else{
									echo "
									<label class='radio'>
										<input type=radio name='status' value='Y'>Y  
									</label>
									<div style='clear:both'></div>
									<label class='radio'>
										<input type=radio name='status' value='N' checked>N
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
