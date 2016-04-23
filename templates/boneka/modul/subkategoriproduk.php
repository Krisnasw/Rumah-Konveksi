<?php
	$id = $_GET[id];
// Tampilkan nama kategori
  $rqsub = mysql_query("SELECT id_main, nama_sub from subkategori where id_subkategori='$id'");
  $nsub = mysql_fetch_array($rqsub);	
  
// Tampilkan nama kategori
  $rq = mysql_query("SELECT * from kategoriproduk where id_kategori='$nsub[id_main]'");
  $n = mysql_fetch_array($rq);	

echo '
<div class="container">
	<div class="row">
		<div class="block block-breadcrumbs">
			<ul>
				<li class="home">
					<a href="./"><i class="fa fa-home"></i></a>
					<span></span>
				</li>
				<li><a href="semua-produk.html"> Produk</a><span></span></li>
				<li><a href="kategoriproduk-'.$n[id_kategori].'-'.$n[kategori_seo].'.html"> '.$n[nama_kategori].'</a><span></span></li>
				<li>'.$nsub[nama_sub].'</li>
			</ul>
		</div>
		
		<div class="category-products">
			<ul class="products row">
';
				$k = 1;
		  $p      = new PagingsubKateProduk;
		  $batas  = 8;
		  $posisi = $p->cariPosisi($batas);
		  $subproduk = mysql_query("SELECT * FROM produk where id_subkategori='$id' ORDER BY id_produk DESC LIMIT $posisi,$batas");
		  
			while($r = mysql_fetch_array($subproduk)){
					
				$gbrproduk  = mysql_query("SELECT * FROM imagesproduk WHERE idProduk = '$r[id_produk]'");
				$gbr = 	mysql_fetch_array($gbrproduk);
				$harga     = format_rupiah($r[harga]);
				$disc      = ($r[diskon]/100)*$r[harga];
				$hargadisc = number_format(($r[harga]-$disc),0,",",".");
					
				if ($r[diskon] == 0) {
					$rego =  '<span class="product-price">Rp. '.$harga.'</span>';
				} else {
					$rego =  '
					<span class="product-price">Rp. '.$hargadisc.'</span>
					<span class="product-price-old">Rp. '.$harga.'</span>
					';
				}
			
				echo '
				<li class="product col-xs-12 col-sm-4 col-md-3">
					<div class="product-container">
						<div class="inner">
							<div class="product-left">
								<div class="product-thumb">
									<a class="product-img" href="produk-'.$r[id_produk].'-'.$r[produk_seo].'.html"><img src="foto_produk/'.$gbr[NamaGambar].'" alt="'.$r[nama_produk].'"></a>
									<a title="Detail Produk" href="produk-'.$r[id_produk].'-'.$r[produk_seo].'.html" class="btn-quick-view">Detail Produk </a>
								</div>
							</div>
							<div class="product-right">
								<div class="product-name">
									<a href="produk-'.$r[id_produk].'-'.$r[produk_seo].'.html">'.$r[nama_produk].'</a>
								</div>
								<div class="price-box">
									'.$rego.'
								</div>
								<div class="product-star">
									<i>&nbsp;</i>
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
				  $jmldata     = mysql_num_rows(mysql_query("SELECT * FROM produk WHERE id_subkategori ='$id'"));
				  $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
				  $linkHalaman = $p->navHalaman($_GET[halsubkategoriproduk], $jmlhalaman);
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
?>