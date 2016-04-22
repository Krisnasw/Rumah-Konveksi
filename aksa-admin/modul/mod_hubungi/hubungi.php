<?php
$aksi="modul/mod_hubungi/aksi_hubungi.php";
switch($_GET[act]){
  // Tampil Hubungi Kami
  default:
    echo '
		<div>
			<ul class="breadcrumb">
				<li>
					<a href="?module=home">Home</a> <span class="divider">/</span>
				</li>
				<li>
					<a href="#">Hubungi Kami</a>
				</li>
			</ul>
		</div>
		<div class="row-fluid sortable">
			<div class="box span12">
				<div class="box-header well" data-original-title>
					<h2><i class="icon-envelope"></i> Hubungi Kami</h2>
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
								<th>Nama</th>
								<th>Email</th>
								<th>Subjek</th>
								<th>Tanggal</th>
								<th>Jam</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
	';
							$tampil=mysql_query("SELECT * FROM hubungi ORDER BY id_hubungi DESC ");
							$no = 1;
							while ($r=mysql_fetch_array($tampil)){
								$tgl=tgl_indo($r[tanggal]);
								echo "
									<tr>
										<td>$no</td>
										<td>$r[nama]</td>
										<td>
											<a href=?module=hubungi&act=balasemail&id=$r[id_hubungi]>$r[email]</a>
										</td>
										<td>$r[subjek]</td>
										<td>$tgl</a></td>
										<td>$r[jam]</a></td>
										<td>
											<a class=\"btn btn-success\" href=?module=hubungi&act=view&id=$r[id_hubungi]><i class=\"icon-zoom-in icon-white\"></i> View</a>
											<a class=\"btn btn-info\" href=?module=hubungi&act=edithubungi&id=$r[id_hubungi]><i class=\"icon-edit icon-white\"></i> Edit</a> 
											<a class=\"btn btn-danger\" href=$aksi?module=hubungi&act=hapus&id=$r[id_hubungi]><i class=\"icon-trash icon-white\"></i> Hapus</a>
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

  case "balasemail":
    $tampil = mysql_query("SELECT * FROM hubungi WHERE id_hubungi='$_GET[id]'");
    $r      = mysql_fetch_array($tampil);

    echo '
		<div>
			<ul class="breadcrumb">
				<li>
					<a href="?module=home">Home</a> <span class="divider">/</span>
				</li>
				<li>
					<a href="?module=hubungi">Hubungi Kami</a> <span class="divider">/</span>
				</li>
				<li>
					<a href="#">Reply Email</a>
				</li>
			</ul>
		</div>
		<div class="row-fluid sortable">
			<div class="box span12">
				<div class="box-header well" data-original-title>
					<h2><i class="icon-envelope"></i> Reply Email</h2>
					<div class="box-icon">
						<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
						<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
					</div>
				</div>
				<div class="box-content">
					<form class="form-horizontal" method=POST action="?module=hubungi&act=kirimemail">
						<fieldset>
							<div class="control-group">
								<label class="control-label">Kepada</label>
								<div class="controls">
									<input type=text name="email" value="'.$r[email].'" />
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Subjek</label>
								<div class="controls">
									<input type=text name="subjek" value="Re: '.$r[subjek].'" />
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Pesan</label>
								<div class="controls">
									<textarea name=\'pesan\' style=\'width: 600px; height: 350px;\'>    
  ----------------------------------------------------------------------------------------------------------------------
  '.$r[pesan].'</textarea>
								</div>
							</div>
							<div class="form-actions">
								<input type=submit value=Kirim class="btn btn-primary">
								<input type=button value=Batal onclick=self.history.back() class="btn">
							</div>
						</fieldset>
					</form>
				</div>
			</div>
		</div>
	';
	
     break;
    
  case "kirimemail":

    $sql2 = mysql_query("select email_pengelola from modul where id_modul='43'");
    $j2   = mysql_fetch_array($sql2);

    $mail_sent = @mail("$_POST[email]", "$_POST[subjek]", "$_POST[pesan]", "From: $j2[email_pengelola]");
	echo $mail_sent ? "<h2>Status Email</h2><p>Email telah sukses terkirim ke tujuan</p><p>[ <a href=javascript:history.go(-2)>Kembali</a> ]</p>" : "<h2>Status Email</h2><p>Email GAGAL terkirim ke tujuan</p><p>[ <a href=javascript:history.go(-2)>Kembali</a> ]</p>";
	
	break; 

	case "edithubungi":
		
		$q_data_hubungi = mysql_fetch_array(mysql_query("select * from hubungi where id_hubungi='$_GET[id]'"));
		echo '
		<div>
			<ul class="breadcrumb">
				<li>
					<a href="?module=home">Home</a> <span class="divider">/</span>
				</li>
				<li>
					<a href="?module=hubungi">Hubungi</a> <span class="divider">/</span>
				</li>
				<li>
					<a href="?module=hubungi&act=view&id='.$q_data_hubungi[id_hubungi].'">'.$q_data_hubungi[nama].'</a><span class="divider"></span>
				</li>
			</ul>
		</div>
		<div class="row-fluid sortable">
			<div class="box span12">
				<div class="box-header well" data-original-title>
					<h2><i class="icon-picture"></i> Edit Hubungi</h2>
					<div class="box-icon">
						<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
						<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
					</div>
				</div>
				<div class="box-content">
					<form class="form-horizontal" method=POST action='.$aksi.'?module=hubungi&act=update>
						<fieldset>
							<div class="control-group">
								<label class="control-label">Nama</label>
								<div class="controls">
									<input type="hidden" name="id" value="'.$q_data_hubungi[id_hubungi].'" />
									<input type=text name="nama" value="'.$q_data_hubungi[nama].'" />
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Email</label>
								<div class="controls">
									<input type=text name="email" value="'.$q_data_hubungi[email].'" />
								</div>
							</div><div class="control-group">
								<label class="control-label">Subjek</label>
								<div class="controls">
									<input type=text name="subjek" value="'.$q_data_hubungi[subjek].'" />
								</div>
							</div>
							
							<div class="control-group">
								<label class="control-label">Pesan</label>
								<div class="controls">
									<textarea style="width:600px;" name="pesan">'.$q_data_hubungi[pesan].'</textarea>
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
	
	case "view":
	
	$edit=mysql_query("SELECT * FROM hubungi WHERE id_hubungi='$_GET[id]'");
    $r=mysql_fetch_array($edit);
	echo '
		<div>
			<ul class="breadcrumb">
				<li>
					<a href="?module=home">Home</a> <span class="divider">/</span>
				</li>
				<li>
					<a href="?module=hubungi">Hubungi</a> <span class="divider">/</span>
				</li>
				<li>
					<a href="#">'.$r[nama].'</a>
				</li>
			</ul>
		</div>
		<div class="row-fluid sortable">
			<div class="box span12">
				<div class="box-header well" data-original-title>
					<h2><i class="icon-picture"></i> Edit Hubungi</h2>
					<div class="box-icon">
						<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
						<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
					</div>
				</div>
				<div class="box-content">
					<form class="form-horizontal" method=POST action='.$aksi.'?module=hubungi&act=update >
						<fieldset>
							<div class="control-group">
								<label class="control-label">Nama</label>
								<div class="controls">
									<input type="hidden" name="id" value="'.$r[id_hubungi].'" />
									<input type=text name="nama" value="'.$r[nama].'" />
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Email</label>
								<div class="controls">
									<input type=text name="email" value="'.$r[email].'" />
								</div>
							</div><div class="control-group">
								<label class="control-label">Subjek</label>
								<div class="controls">
									<input type=text name="subjek" value="'.$r[subjek].'" />
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Jam</label>
								<div class="controls">
									<input type=text name="jam" value="'.$r[jam].'" />
								</div>
							</div>
							
							<div class="control-group">
								<label class="control-label">Pesan</label>
								<div class="controls">
									<textarea style="width:600px;" name="pesan">'.$r[pesan].'</textarea>
								</div>
							</div>
							<div class="form-actions">
								<input type=button value=Kembali onclick=self.history.back() class="btn">
							</div>
						</fieldset>
					</form>	
			</div>
		</div>
	';
    break;  	
}
?>
