<?php
$sid = session_id();
$sql = mysql_query("SELECT * FROM orders_temp ot LEFT JOIN produk p 
								ON ot.id_produk=p.id_produk WHERE ot.id_session='$sid'");
$ketemu=mysql_num_rows($sql);	
if($ketemu < 1){
echo "<script>window.alert('Keranjang Belanjanya Kosong');
window.location=('./')</script>";
}
else { 
echo '
	
<div class="container">
	<div class="row">
		<div class="block block-breadcrumbs">
			<ul>
				<li class="home">
					<a href="./"><i class="fa fa-home"></i></a>
					<span></span>
				</li>
				<li>Summary</li>
			</ul>
		</div>
		<div class="main-page">
			<h1 class="page-title">Order details</h1>
			<br>Id Order:
			<br>Nama:
			<br>E-mail:
			<br>Telepon:
			<br>Alamat:
			<br>
			Rincian Pesanan:
			<div class="page-content page-order">
				
				<div class="warning"> &nbsp;
				</div>
				<div class="order-detail-content">
					<table class="cart_summary">
						<thead>
							<tr>
								
								<th>Deskripsi Produk</th>
								<th>Berat</th>
								<th>Harga</th>
								<th>Qty</th>
								<th>sub Total</th>
								<th class="action"><i class="fa fa-trash-o"></i></th>
							</tr>
						</thead>
						<tbody>
						';
						
						$no=1;
						
						while($r=mysql_fetch_array($sql)){
							$rid = $r[id_produk];
							$gbrproduk  = mysql_query("SELECT NamaGambar FROM imagesproduk WHERE idProduk = '$rid'");
							$gbr = 	mysql_fetch_array($gbrproduk);
							$disc        = ($r[diskon]/100)*$r[harga];
							$hargadisc   = number_format(($r[harga]-$disc),0,",",".");

							$subtotal    = ($r[harga]-$disc) * $r[jumlah];
							$total[$n]   = $total[$n] + $subtotal;  
							$subtotal_rp = format_rupiah($subtotal);
							$total_rp    = format_rupiah($total);
							$harga       = format_rupiah($r[harga]);
							
							echo '
							<tr>
								<td class="cart_description">
									<p class="product-name"><a href="#"> '.$r[nama_produk].' </a></p>
								</td>
								<td class="price">'.$r[berat].' Kg</td>
								<td class="price"><span>Rp. '.$harga.'</span></td>
								<td class="qty">
								<select class="form-control input-sm" name=jml['.$no.'] value='.$r[jumlah].' onChange=\'this.form.submit()\'>';
								 for ($j=1;$j <= $r[stok];$j++){
									  if($j == $r[jumlah]){
									   echo "<option value=$j selected>$j</option>";
									  }else{
									   echo "<option value=$j >$j</option>";
									  }
								  }			
								echo'</select>
								
								</td>
								<td class="price">
									<span>Rp. '.$subtotal_rp.'</span>
								</td>
								<td class="action">
									<a href="aksi.php?module=keranjang&act=hapus&id='.$r[id_orders_temp].'" title="Hapus" >Delete item</a>
								</td>
							</tr>
						';
						$no++;
						}

						echo '
						</tbody>
						<tfoot>
							<tr><td colspan="2" rowspan="2"></td>
								<td colspan="3"><strong>Total</strong></td>
								<td colspan="2"><strong>Rp. '.$total_rp.' ,-</strong></td>
							</tr>
						</tfoot>    
					</table>
					<div class="cart_navigation">
						
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
		
';
}
?>