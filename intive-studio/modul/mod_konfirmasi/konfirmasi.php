<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
$aksi="modul/mod_konfirmasi/aksi_konfirmasi.php";
switch($_GET[act]){
  // Tampil Konfirmasi
  default:
    echo '
		<div>
			<ul class="breadcrumb">
				<li>
					<a href="?module=home">Home</a> <span class="divider">/</span>
				</li>
				<li>
					<a href="#">Konfirmasi</a>
				</li>
			</ul>
		</div>
		<div class="row-fluid sortable">
			<div class="box span12">
				<div class="box-header well" data-original-title>
					<h2><i class="icon-picture"></i> Konfirmasi</h2>
					<div class="box-icon">
						<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
						<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
					</div>
				</div>
				<div class="box-content">
				<!--
					<input type=button value=\'Tambah Konfirmasi\' class="btn btn-primary" 
					onclick="window.location.href=\'?module=konfirmasi&act=tambahkonfirmasi\';"><br /><br />
				-->
					<table class="table table-striped table-bordered bootstrap-datatable datatable">
						<thead>
							<tr>
								<th>No</th>
								<th>Tanggal </th>
								<th>Kode Order</th>
								<th>Nama</th>
								<th>Total </th>
								<th>Keterangan </th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
	';
							$tampil = mysql_query("SELECT o.tgl_order, o.kode_orders, o.id_orders, o.status_order, o.jumlah_dibayar, o.id_kustomer, k.nama FROM orders o LEFT JOIN kustomer k ON o.id_kustomer = k.id_kustomer WHERE o.status_order != 'Baru' && o.status_order != 'Baru Dibayar'  ORDER BY id_orders DESC");
							$no = 1;
							while($r=mysql_fetch_array($tampil)){
								$tgl = tgl_indo($r[tgl_order]);
								if ($r[oid] == $r[kid]) {
									$namakustomer = $r[nama];
								} else{
									$namakustomer = 'Guest';
								}
								
								$dibayar = format_rupiah($r[jumlah_dibayar]);
								echo "
								<tr>
									<td>$no</td>
									<td>$tgl</td>
									<td>$r[kode_orders]</td>
									<td>$r[nama]</td>
									<td>Rp. $dibayar</td>
									<td>$r[status_order]</td>
									<td>
										<a class=\"btn btn-success\" href=?module=konfirmasi&act=detailkonfirmasi&id=$r[id_orders]&kode=$r[kode_orders]><i class=\"icon-zoom-in icon-white\"></i> Detail</a>
									<!--
										<a class=\"btn btn-info\" href=?module=konfirmasi&act=editkonfirmasi&konfirmasi=$r[konfirmasi]&id=$r[id_orders]><i class=\"icon-edit icon-white\"></i> Edit</a>	<a class=\"btn btn-danger\" href='$aksi?module=konfirmasi&act=hapus&id=$r[id_orders]&namafile=$r[gbr_konfirmasi]'><i class=\"icon-trash icon-white\"></i> Hapus</a>
										-->
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
 
  case "detailkonfirmasi":
    $edit = mysql_query("SELECT * FROM orders,kustomer WHERE orders.id_kustomer=kustomer.id_kustomer AND id_orders='$_GET[id]'");
    $jumlah   = mysql_num_rows($edit);
	
	// if ($jumlah < 1) {
		// $edit = mysql_query("SELECT * FROM orders WHERE id_orders='$_GET[id]'");
		// $r    = mysql_fetch_array($edit);		
	// }else {
		$r    = mysql_fetch_array($edit);
	// }
    $tanggal=tgl_indo($r[tgl_order]);
    
	// $qDataKonf = mysql_query("select * from konfirmasi where id_order='$r[id_orders]'");
	$qDataKonf = mysql_query("SELECT * FROM konfirmasi WHERE kode_konfirmasi = '$r[kode_orders]'");
	$rDataKonf = mysql_fetch_array($qDataKonf);
		
    if ($r[status_order]=='Baru'){
        $pilihan_status = array('Baru', 'Lunas');
    }
    elseif ($r[status_order]=='Konfirmasi'){
        $pilihan_status = array('Konfirmasi', 'Batal');    
    }
    else{
        $pilihan_status = array('Baru', 'Lunas', 'Batal');    
    }

    $pilihan_order = '';
    foreach ($pilihan_status as $status) {
	   $pilihan_order .= "<option value=$status";
	   if ($status == $r[status_order]) {
		    $pilihan_order .= " selected";
	   }
	   $pilihan_order .= ">$status</option>\r\n";
    }

    echo '
		<div>
			<ul class="breadcrumb">
				<li>
					<a href="?module=home">Home</a> <span class="divider">/</span>
				</li>
				<li>
					<a href="?module=konfirmasi">Konfirmasi</a> <span class="divider">/</span>
				</li>
				<li>
					<a href="#">Detail Order</a>
				</li>
			</ul>
		</div>
		<div class="row-fluid sortable">
			<div class="box span12">
				<div class="box-header well" data-original-title>
					<h2><i class="icon-shopping-cart"></i> Detail Order</h2>
					<div class="box-icon">
						<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
						<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
					</div>
				</div>
				<div class="box-content">
					<form class="form-horizontal" method=POST action='.$aksi.'?module=konfirmasi&act=update>
						<fieldset>
							<table class="table">
								<tr>
									<td>No. Order</td>        
									<td>'.$r[id_orders].'</td>
								</tr>
								<tr>
									<td>Kode Order</td>        
									<td>'.$r[kode_orders].'</td>
								</tr>
								<tr>
									<td>Tgl. & Jam Order</td> 
									<td> '.$tanggal.' & '.$r[jam_order].'</td>
								</tr>
								<tr>
									<td>Status Order</td> 
									<td> '.$r[status_order].'</td>
								</tr>
							</table>
						</fieldset>
					</form>
	';
					// tampilkan rincian produk yang di order
					// $sql2=mysql_query("SELECT * FROM orders_detail, produk 
                     // WHERE orders_detail.id_produk=produk.id_produk 
                     // AND orders_detail.id_orders='$_GET[id]'");
					 $sql2=mysql_query("SELECT * FROM orders_detail, produk 
                     WHERE orders_detail.id_produk=produk.id_produk 
                     AND orders_detail.kode_orders='$_GET[kode]'");
					 
	echo "			<table class=\"table table-striped\">
						<thead>
							<tr>
								<th>Nama Produk</th>
								<th>Jumlah</th>
								<th>Harga Satuan</th>
								<th>Sub Total</th>
							</tr>
						</thead>
						<tbody>
	";
						while($s=mysql_fetch_array($sql2)){
							// rumus untuk menghitung subtotal dan total		
							//$disc        = ($s[diskon]/100)*$s[harga];
							//$hargadisc   = number_format(($s[harga]-$disc),0,",","."); 
							if($s[promo] == 'Y'){
							 $harga       = $s[harga_promo];
							}
							else{
							 $harga       = $s[harga];
							}
							$subtotal    = $harga * $s[jumlah];
							 $harga_rp = format_rupiah($harga);
							$total       = $total + $subtotal;
							$subtotal_rp = format_rupiah($subtotal);    
							$total_rp    = format_rupiah($total);

							//$subtotalberat = $s[berat] * $s[jumlah]; // total berat per item produk 
							//$totalberat  = $totalberat + $subtotalberat; // grand total berat all produk yang dibeli
							
							echo "
								<tr>
									<td>$s[nama_produk]</td>
									<td align=center>$s[jumlah]</td>
									<td align=right>Rp. $harga_rp</td>
									<td align=right>Rp. $subtotal_rp</td>
								</tr>
							";  
						}
						
						$ongkos=mysql_fetch_array(mysql_query("SELECT * FROM kustomer,orders 
						WHERE orders.id_kustomer=kustomer.id_kustomer AND id_orders='$_GET[id]'"));
  
						//$ongkoskirim1=$ongkos[ongkos_kirim];
						// $ongkoskirim1= 15000;
						//$ongkoskirim=$ongkoskirim1 * $totalberat;
						// $ongkoskirim=$ongkoskirim1;
						$ongkoskirim = $r[biaya_ongkir];
						$grandtotal    = $total + $ongkoskirim; 
						
						$ongkoskirim_rp = format_rupiah($ongkoskirim);
						$ongkoskirim1_rp = format_rupiah($ongkoskirim1); 
						$grandtotal_rp  = format_rupiah($grandtotal);
						
	echo "				<tr>
							<td colspan=3 align=right>Total : </td>
							<td align=right><b>Rp. $total_rp</b></td>
						</tr> 
						<tr>
							<td colspan=3 align=right>Ongkos Kirim : </td>
							<td align=right><b>Rp. $ongkoskirim_rp</b></td>
						</tr>
						<tr>
							<td colspan=3 align=right>Grand Total : </td>
							<td align=right><b>Rp. $grandtotal_rp</b></td>
						</tr>					
	";
	echo '
						</tbody>
					</table>
	';
	// tampilkan data kustomer
	if ($r[id_kustomer] != 1) {	
	
	echo "			<table class=\"table table-striped\">
						<tr>
							<th colspan=2>Data Kustomer</th>
						</tr>
						<tr>
							<td>Nama Kustomer</td>
							<td> : $r[id_kustomer] $r[nama]</td>
						</tr>
						<tr>
							<td>Alamat Pengiriman</td>
							<td> : $r[alamat]</td>
						</tr>
						<tr>
							<td>No. Telpon/HP</td>
							<td> : $r[telp]</td>
						</tr>
						<tr>
							<td>Email</td>
							<td> : $r[email]</td>
						</tr>
					</table>
	";
	
	} else {
		
	echo "			<table class=\"table table-striped\">
						<tr>
							<th colspan=2>Data Pemesan</th>
						</tr>
						<tr>
							<td>Nama Pemesan</td>
							<td> : $r[nama_pemesan]</td>
						</tr>
						<tr>
							<td>Alamat Pengiriman</td>
							<td> : $r[alamat]</td>
						</tr>
						<tr>
							<td>No. Telpon/HP</td>
							<td> : $r[telp]</td>
						</tr>
						<tr>
							<td>Email</td>
							<td> : $r[email]</td>
						</tr>
					</table>
	";
	
	}
	
	// tampilkan data kustomer
	echo "			<table class=\"table table-striped\">
						<tr>
							<th colspan=2>Data Konfirmasi</th>
						</tr>
						<tr>
							<td>Nama Pemilik Rekening</td>
							<td> : $rDataKonf[pengirim]</td>
						</tr>
						<tr>
							<td>Transfer Ke Bank</td>
							<td> : $rDataKonf[ke_bank]</td>
						</tr>
						<tr>
							<td>Nominal</td>
							<td> : $rDataKonf[jumlah]</td>
						</tr>
						<tr>
							<td>Tanggal Transfer</td>
							<td> : $rDataKonf[tgl]</td>
						</tr>
					</table>
	";
		
	echo '
				</div>
			</div>
		</div>
	';

    break;  
}
}
?>
