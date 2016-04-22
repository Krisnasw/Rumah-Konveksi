<script language="javascript">
function validasi(form){
 if (form.email.value == ""){
    alert("Anda belum mengisikan Email");
    form.email.focus();
    return (false);
  }
  else if (form.password.value == ""){
    alert("Anda belum mengisikan password");
    form.password.focus();
    return (false);
  }
  else {
	return (true);
  }
}
</script>
<script language="javascript">
function validasiregister(form){
if (form.nama.value == ""){
    alert("Anda belum mengisikan Nama");
    form.nama.focus();
    return (false);
  }else if (form.email.value == ""){
    alert("Anda belum mengisikan Email");
    form.email.focus();
    return (false);
  }
  else if (form.password.value == ""){
    alert("Anda belum mengisikan password");
    form.password.focus();
    return (false);
  }
  else {
	return (true);
  }
}
</script>
<script language="javascript">
function validasiident(form){
 if (form.nama.value == ""){
    alert("Anda belum mengisikan Nama");
    form.nama.focus();
    return (false);
  }
  else if (form.email.value == ""){
    alert("Anda belum mengisikan email");
    form.email.focus();
    return (false);
  }
  else if (form.telp.value == ""){
    alert("Anda belum mengisikan nomor telephone");
    form.telp.focus();
    return (false);
  }
  else if (form.alamat.value == ""){
    alert("Anda belum mengisikan alamat");
    form.alamat.focus();
    return (false);
  }
  else {
	return (true);
  }
}
</script>

<?php
error_reporting(0);
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
				<li>Checkout</li>
			</ul>
		</div>
		<div class="main-page">
			<h1 class="page-title">Check out</h1>
			<div class="page-content checkout-page">
				<h3 class="checkout-sep"></h3>
		            <div class="box-border">';
						if (!empty($_SESSION['namalengkap'])) {
							//echo 'sudah login';
							$id_kustomer = $_SESSION['id'];
						} else {
							//echo 'belum login';
							$id_kustomer = 1;
							echo '
							<div class="col-sm-6">
								<div class="box-border">
									<h4> Login </h4>
									<small> &nbsp; </small>
									<form action="cek_login.php" method="post" onSubmit=\'return validasi(this)\'>
									<p>
										<label>Email</label>
										<input type="text" name="email">
									</p>
									<p>
										<label>Password</label>
										<input type="password" name="password">
									</p>
									<p>
										<a href="forget-password">Forgot your password?</a>
									</p>
									<p>
										<button class="button"><i class="fa fa-lock"></i> Login </button>
									</p>
									</form>
								</div>
							</div>
							
						<div class="col-sm-6">
							<div class="box-border">
								<h4>Daftar </h4>
								<small> &nbsp; </small>
								<form action="login" method="post" onSubmit=\'return validasiregister(this)\'>
								<p>
									<label>Nama </label>
									<input type="text" name="nama">
								</p><p>
									<label>Email </label>
									<input type="text" name="email">
								</p>
								<p>
									<label>Password</label>
									<input type="password" name="password">
								</p>
								<p>
									<button class="button"><i class="fa fa-user"></i> Create </button>
									<input type="hidden" name="submitted" id="submitted" value="true" />
								</p>
								</form>
							</div>
						</div>';
							
						}
						
	$orders = mysql_query("SELECT kode_orders FROM orders ORDER BY id_orders DESC LIMIT 1");
	$rorder = mysql_fetch_array($orders);
	$kode_o = $rorder[kode_orders] + 1;

		echo ' 
		            <h3 class="checkout-sep">Informasi Pemesan</h3>
		            <div class="box-border">  
						<div class="col-sm-6">         			
						
						<form action="mail/mail.php?module=checkout" method="post" onSubmit=\'return validasiident(this)\'>
							<p>
								<label>Nama*</label>
								<input type="text" name="nama" >
								<input type="hidden" name="id_session" value="'.$sid.'">
								<input type="hidden" name="id_kustomer" value="'.$id_kustomer.'">
								<input type="hidden" name="kode_orders" value="'.$kode_o.'">
								<input type="hidden" name="total" value="'.$total.'">
							</p>
							<p>
								<label>E-mail*</label>
								<input type="text" name="email">
							</p>
							<p>
								<label>Telepon*</label>
								<input type="text" name="telp">
							</p>
		            	</div>
						<div class="col-sm-6">
							<p>
								<label>Alamat*</label>
								<textarea type="text" name="alamat" rows="4"></textarea>
							</p>
								
						</div>
		           </div>
				        <div>
							<p>
							<button class="button pull-right" type="submit"> Continue </button>
							</p>
						</form>
		            	</div>
		        </div>
			</div>	
			
			<div class="main-page">
			<h1 class="page-title">Detail Keranjang</h1>
			<div class="page-content page-order">
				
				<div class="warning"> &nbsp;
				</div>
			<div class="order-detail-content">
					<table class="cart_summary">
						<thead>
							<tr>
								<th class="cart_product">Product</th>
								<th>Deskripsi Produk</th>
								<th>Berat</th>
								<th>Harga</th>
								<th>Qty</th>
								<th>sub Total</th>
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
								<td class="cart_product">
									<a href="#"><img class="img-responsive" src="foto_produk/small_'.$gbr[NamaGambar].'" alt="Product"></a>
									<input type=hidden name=id['.$no.'] value='.$r[id_orders_temp].'>
									<input type=hidden name=id_produk value='.$r[id_produk].'>
								</td>
								<td class="cart_description">
									<p class="product-name"><a href="#"> '.$r[nama_produk].' </a></p>
								</td>
								<td class="price">'.$r[berat].' Kg</td>
								<td class="price"><span>Rp. '.$harga.'</span></td>
								<td class="qty"><span>'.$r[jumlah].'</span></td>
								<td class="price">
									<span>Rp. '.$subtotal_rp.'</span>
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
				</div>
			</div>
			
			</div>
		</div>
	</div>
</div>
';
}
?>