<?php

if (empty($_SESSION['namalengkap'])){
	echo "<script>window.location=('login')</script>";
} else {
		$data = mysql_query("SELECT * from kustomer WHERE id_kustomer = '$_SESSION[id]'");	 
		$rdata = mysql_fetch_array($data);
	echo '
	<div class="container">
		<div class="row">
			<div class="block block-breadcrumbs">
				<ul>
					<li class="home">
						<a href="./"><i class="fa fa-home"></i></a>
						<span></span>
					</li>
					<li><a href="account">Account</a><span></span></li>
					<li>History</li>
				</ul>
			</div>
			<div class="row">';
					include 'kanan.php';
					echo '
				<div class="col-xs-6 col-sm-8 col-md-9">
					<h1 class="page-title">History</h1>
					<div class="page-content">
					</div>
					
					<table class="table table-bordered table-wishlist">
	                    <thead>
	                        <tr>
								<th>Tanggal </span></th>
								<th>Kode Order </span></th>
								<th>Pemesan </span></th>
								<th>Total</span></th>
								<th>Keterangan</span></th>
								<!--
								<th>Konfirmasi</span></th>	
								-->								
	                        </tr>
	                    </thead>
	                    <tbody>
							';
				
		  $p      = new PagingAccount;
		  $batas  = 15;
		  $posisi = $p->cariPosisi($batas);
// $sql = mysql_query("SELECT * FROM orders o, produk p, orders_detail od WHERE p.id_produk = od.id_produk AND o.id_kustomer='$_SESSION[id]'");
$sql = mysql_query("SELECT o.id_orders, o.kode_orders, o.status_order, o.jumlah_dibayar, o.tgl_order, o.nama_pemesan, od.jumlah
					FROM orders o LEFT JOIN orders_detail od 
					ON o.id_orders=od.id_orders WHERE o.id_kustomer='$_SESSION[id]' ORDER BY o.id_orders DESC LIMIT $posisi,$batas");
	$no=1;
	while($r=mysql_fetch_array($sql)){
		$rid = $r['id_produk'];
		$gbrproduk  = mysql_query("SELECT NamaGambar FROM imagesproduk WHERE idProduk = '$rid'");
		$gbr = 	mysql_fetch_array($gbrproduk);
		$disc        = ($r['diskon']/100)*$r['harga'];
		$hargadisc   = number_format(($r[harga]-$disc),0,",",".");

		$subtotal    = ($r['harga']-$disc) * $r['jumlah'];
		$total[$n]   = $total[$n] + $subtotal[$n];    
		$subtotal_rp = format_rupiah($subtotal);
		$total_rp    = format_rupiah($total);
		$harga       = format_rupiah($r[harga]);
		
		$jumlah_dibayar    = format_rupiah($r[jumlah_dibayar]);
		$tgl_order   = tgl_indo($r[tgl_order]);
		
		if ($r[status_order] == 'Baru') {
			$status_order = 'Belum Di bayar';
			$konfirmasi = '';
		} else  if ($r[status_order] == 'Lunas'){
			$status_order = 'Sudah Dibayar';
			$konfirmasi = 'disabled';
		}else {
			$status_order = 'Dibatalkan';
			$konfirmasi = 'disabled';
		}	
			echo '
<tr>
    <td class="a-center qty-td">
        <div class="qty-holder">'.$tgl_order.'
        </div>
    </td>
    <td class="a-center qty-td">
        <div class="qty-holder">'.$r[kode_orders].'
        </div>
    </td>
    <td class="a-center qty-td">
        <div class="qty-holder">'.$r[nama_pemesan].'
        </div>
    </td>
    <td class="a-center sub-total">                  
		<span class="cart-price">
        <span class="price">Rp. '.$jumlah_dibayar.' </span>                            
        </span>
    </td>
	
    <td class="a-center qty-td">
        <div class="qty-holder">'.$status_order.'
        </div>
		  <input type="hidden" name="id_orders" value="'.$r[id_orders].'"/>
		  <input type="hidden" name="id_kustomer" value="'.$_SESSION['id'].'"/>
    </td>
	<!--
    <td class="a-center sub-total"> 
		<div class="form-row" id="form-submit">
		  <a href="konfirmasi" target="_blank" class="comment-submit small button green" '.$konfirmasi.'>Konfirmasi</a> &nbsp;
		  <a href="media.php?module=accountdetail&kode='.$r[kode_orders].'" class="comment-submit small button green" '.$konfirmasi.'>Detail</a> &nbsp;
		</div>
    </td>
	-->
</tr> ';
		$no++;
  }
  echo '
	                    </tbody>
	                </table>
					
					<div class="sortPagiBar-inner">
						<nav>
		                     <ul class="pagination">';
								$jmldata     = mysql_num_rows(mysql_query("SELECT o.id_orders, o.status_order, o.jumlah_dibayar, o.tgl_order, o.nama_pemesan, od.jumlah
								FROM orders o LEFT JOIN orders_detail od 
								ON o.id_orders=od.id_orders WHERE o.id_kustomer='$_SESSION[id]' ORDER BY o.id_orders DESC"));
								$jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
								$linkHalaman = $p->navHalaman($_GET[halhistory], $jmlhalaman);
								if ($batas < $jmldata) {
								echo $linkHalaman;
								}	
								echo '
		                    </ul>
						</nav>
					</div>  
				</div>  
			</div>  
		</div>  
	</div>  
';
}
?>