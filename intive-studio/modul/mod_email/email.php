<?php
$aksi="modul/mod_email/aksi_email.php";
switch($_GET[act]){
  // Tampil email
  default:
    $sql  = mysql_query("SELECT * FROM email WHERE id_email = '1'");
    $r    = mysql_fetch_array($sql);

    echo '
		<div>
			<ul class="breadcrumb">
				<li>
					<a href="?module=home">Home</a> <span class="divider">/</span>
				</li>
				<li>
					<a href="#">Email</a>
				</li>
			</ul>
		</div>
		<div class="row-fluid sortable">
			<div class="box span12">
				<div class="box-header well" data-original-title>
					<h2><i class="icon-edit"></i> Edit Email</h2>
					<div class="box-icon">
						<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
						<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
					</div>
				</div>
				<div class="box-content">
					<form class="form-horizontal" method=POST enctype="multipart/form-data" action='.$aksi.'?module=email&act=update>
						<fieldset>
							<div class="control-group">
								<label class="control-label">Alamat Email</label>
								<div class="controls">
									<input type=hidden name="id" value="'.$r[id_email].'">
									<input type="text" class="input-xlarge" name="email" value="'.$r[email].'" class="span6">
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Isi Header Email</label>
								<div class="controls">
									<textarea name="header" id="loko" style="width: 560px; height: 150px;">'.$r[header].' </textarea>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Isi Footer Email</label>
								<div class="controls">
									<textarea name="footer" id="loko2" style="width: 560px; height: 150px;">'.$r[footer].' </textarea>
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