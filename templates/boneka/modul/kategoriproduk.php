<?php
$p      = new PagingKateProduk;
$batas  = 16;
$posisi = $p->cariPosisi($batas);
$produk = mysql_query("SELECT * FROM produk WHERE id_kategori ='$_GET[id]' ORDER BY id_produk DESC LIMIT $posisi,$batas");
$jumlah = mysql_num_rows($produk);

if ($jumlah > 0) {
			  
// Tampilkan nama kategori
  $rq = mysql_query("SELECT * from kategoriproduk where id_kategori='$_GET[id]'");
  $n = mysql_fetch_array($rq);	
  $nmk = strtoupper ($n[nama_kategori]);

echo'
<div class="container">
	<div class="row">
		<div class="block block-breadcrumbs">
			<ul>
				<li class="home">
					<a href="./"><i class="fa fa-home"></i></a>
					<span></span>
				</li>
				<li><a href="semua-produk.html"> Produk</a><span></span></li>
				<li>'.$n[nama_kategori].'</li>
			</ul>
		</div>
		
		<div class="category-products">
			<ul class="products row">
';
			while($r = mysql_fetch_array($produk)){
					
				$gbrproduk  = mysql_query("SELECT * FROM imagesproduk WHERE idProduk = '$r[id_produk]'");
				$gbr = 	mysql_fetch_array($gbrproduk);
					$harga     = format_rupiah($r[harga]);
					$disc      = ($r[diskon]/100)*$r[harga];
					$hargadisc = number_format(($r[harga]-$disc),0,",",".");
				if ($r[diskon] == 0) {
					$rego =  '<span class="product-price">Rp. '.$harga.'</span>';
				} else {
					$rego =  '
					<span class="product-price">Rp. '.$hargadisc.'</span><br>
					<span class="product-price-old">Rp. '.$harga.'</span>
					';
				}
			
				echo '
				<li class="product col-xs-12 col-sm-4 col-md-2">
					<div class="product-container cari2">
						<div class="inner">
							<div class="product-left">
								<div class="product-thumb">
									<a class="product-img" href="produk-'.$r[id_produk].'-'.$r[produk_seo].'.html">
									
									<div title="'.$r[nama_produk].'" class="gambar_fb cari" style="background-image: url(foto_produk/'.$gbr[NamaGambar].')"></div>
									</a>
									<a title="Detail Produk" href="produk-'.$r[id_produk].'-'.$r[produk_seo].'.html" class="btn-quick-view">Detail Produk </a>
								</div>
							</div>
							<div class="product-right">
								<div class="product-name teks">
									<a href="produk-'.$r[id_produk].'-'.$r[produk_seo].'.html">'.$r[nama_produk].'</a>
								</div>
								<div class="price-box teks">
									'.$rego.'
								</div>
								<div class="product-button">
									<a class="button-radius btn-add-cart" title="Beli" href="aksi.php?module=keranjang&act=tambah&id='.$r[id_produk].'"> Beli <span class="icon"></span></a>
								</div>
							</div>
						</div>
					</div>
				</li>
				';
				}
	echo '	
			</ul>
		</div>
		
		<div class="sortPagiBar">
			
			<div class="sortPagiBar-inner">
				<nav>
				  <ul class="pagination">
				';
				  $jmldata     = mysql_num_rows(mysql_query("SELECT * FROM produk WHERE id_kategori ='$_GET[id]'"));
				  $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
				  $linkHalaman = $p->navHalaman($_GET[halkategoriproduk], $jmlhalaman);
				  if ($jmldata > $batas) {
					echo $linkHalaman;	
				  }
				echo'
				  </ul>
				</nav>
			</div>
		</div>
	</div>
</div>
';
} else {
	echo "<script>window.location=('./')</script>";	
}
?>
