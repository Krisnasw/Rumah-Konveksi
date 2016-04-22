<script type="text/javascript">
	$(function() {
		$( "#from" ).datepicker({
		altFormat: 'd',
		showOn: 'button',
					buttonImage: 'date/images/calendar.gif',
					buttonImageOnly: true,
		defaultDate: "+1d",
		changeMonth: true,
		numberOfMonths: 1,
		dateFormat: "dd-mm-yy",
		onClose: function( selectedDate ) {
		$( "#to" ).datepicker( "option", "minDate", selectedDate );
		}
		});
		$( "#to" ).datepicker({ 
		altFormat: 'd',
		showOn: 'button',
					buttonImage: 'date/images/calendar.gif',
					buttonImageOnly: true,
		changeMonth: true,
		numberOfMonths: 1,
		dateFormat: "dd-mm-yy",
		onClose: function( selectedDate ) {
		$( "#from" ).datepicker( "option", "maxDate", selectedDate );
		}
		});
		});
	</script>
<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
	echo '
		<div>
			<ul class="breadcrumb">
				<li>
					<a href="?module=home">Home</a> <span class="divider">/</span>
				</li>
				<li>
					<a href="#">Laporan</a>
				</li>
			</ul>
		</div>
		<div class="row-fluid sortable">
			<div class="box span12">
				<div class="box-header well" data-original-title>
					<h2><i class="icon-list-alt"></i> Laporan</h2>
					<div class="box-icon">
						<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
						<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
					</div>
				</div>
				<div class="box-content">
					<input type=button value=\'Laporan Hari Ini\' class="btn btn-primary"
					onclick="window.location.href=\'modul/mod_laporan/pdf_toko_sekarang.php\';">
					<form class="form-horizontal" method=POST action="modul/mod_laporan/pdf_toko.php">
						<fieldset>
							<table>
								<tr>
									<td colspan=2><b>Laporan Per Periode</b></td>
								</tr>
								<!--
								<tr>
									<td>Dari Tanggal</td>
									<td>
	';
									combotgl(1,31,'tgl_mulai',$tgl_skrg);
									combonamabln(1,12,'bln_mulai',$bln_sekarang);
									combothn(2000,$thn_sekarang,'thn_mulai',$thn_sekarang);
	echo '
									</td>
								</tr>
								<tr>
									<td>s/d Tanggal</td>
									<td>
	';
									combotgl(1,31,'tgl_selesai',$tgl_skrg);
									combonamabln(1,12,'bln_selesai',$bln_sekarang);
									combothn(2000,$thn_sekarang,'thn_selesai',$thn_sekarang);
	echo '
									</td>
								</tr>
								-->
								<tr>
									<td>Dari Tanggal</td>
									<td><input type="text" id="from" name="from"/>
									</td>
								</tr>
								<tr>
									<td>s/d Tanggal</td>
									<td><input type="text" id="to" name="to"/>
									</td>
								</tr>
								<tr>
									<td colspan=2>
										<input class="btn btn-primary" type=submit value=Proses>
									</td>
								</tr>
							</table>
						</fieldset>
					</form>
				</div>
			</div>
		</div>
	';
}
?>
