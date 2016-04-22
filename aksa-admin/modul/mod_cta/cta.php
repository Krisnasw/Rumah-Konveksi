<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
$aksi="modul/mod_cta/aksi_cta.php";
switch($_GET[act]){
  // Tampil CTA
  default:
    $sql  = mysql_query("SELECT * FROM cta WHERE id_cta='1'");
    $r    = mysql_fetch_array($sql);

    echo '
		<div>
			<ul class="breadcrumb">
				<li>
					<a href="?module=home">Home</a> <span class="divider">/</span>
				</li>
				<li>
					<a href="#">CTA</a>
				</li>
			</ul>
		</div>
		<div class="row-fluid sortable">
			<div class="box span12">
				<div class="box-header well" data-original-title>
					<h2><i class="icon-edit"></i> CTA</h2>
					<div class="box-icon">
						<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
						<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
					</div>
				</div>
				<div class="box-content">
					<form class="form-horizontal" method="POST" enctype="multipart/form-data" action="'.$aksi.'?module=cta&act=update">
						<fieldset>
							<input type=hidden name=id value="1">
							
							<div class="control-group">
								<label class="control-label">Pin BB</label>
								<div class="controls">
									<input type="text" name=pin value="'.$r[pin].'"/>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Telp.</label>
								<div class="controls">
								<input type="text" name=telp_indosat value="'.$r[telp_indosat].'"/>
								</div>
							</div>
							<!--
							<div class="control-group">
								<label class="control-label">Telp. Telkomsel</label>
								<div class="controls">
								<input type="text" name=telp_telkomsel value="'.$r[telp_telkomsel].'"/>
								</div>
							</div>
							-->
							<div class="control-group">
								<label class="control-label">Email</label>
								<div class="controls">
									<input type="text" name=email value="'.$r[email].'" />
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
