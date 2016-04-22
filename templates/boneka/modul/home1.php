<div class="container">
<div class="row">
	<div class="row">
		<div class="col-sm-4 col-md-3 col-lg-3">
			<!-- Block vertical-menu -->
			<div class="block block-vertical-menu">
				<div class="vertical-head">
					<h5 class="vertical-title">Kategori Produk</h5>
				</div>
				<div class="vertical-menu-content">
					<ul class="vertical-menu-list">
					<?php
						$kategori = mysql_query("SELECT * FROM kategoriproduk");
						while ($rkategori = mysql_fetch_array($kategori)) {
							$subkategori = mysql_query("SELECT * FROM subkategori WHERE id_main = '$rkategori[id_kategori]'");
							$jmlsub = mysql_num_rows($subkategori);
							if ($jmlsub > 0) {
								$class = 'class="parent"';
							} else {
								$class = '';
							}
							echo '
							<li class="vertical-menu1">
							<a '.$class.' href="kategoriproduk-'.$rkategori[id_kategori].'-'.$rkategori[kategori_seo].'.html">'.$rkategori[nama_kategori].'</a>
							';
							if ($jmlsub > 0) {
								echo '
								<div class="vertical-dropdown-menu">
								<div class="vertical-groups">
									<div class="row">
										<div class="col-sm-12">
											<div class="block-content-vertical-menu border">
												<h3 class="head">'.$rkategori[nama_kategori].'</h3>
												<div class="inner">
												<ul class="vertical-menu-link">';
												while ($rsub = mysql_fetch_array($subkategori)) { 
													echo '
													<li>
														<a href="subkategoriproduk-'.$rsub[id_subkategori].'-'.$rsub[subkategori_seo].'.html">
															<span class="text">'.$rsub[nama_sub].'</span>
														</a>
													</li>
													';
												}
												echo '
												</ul>
											</div>
											</div>
										</div>
									</div>
								</div>
								</div>
								';
							}
							echo '</li>';
						}
					?>	
					</ul>
				</div>
			</div>
			<!-- ./Block vertical-menu -->
		</div>
		<div class="col-sm-8 col-md-9 col-lg-7">
			<!-- Home slide -->
			<div class="block-slider">
				<ul class="home-slider kt-bxslider">
			<?php
				$slider = mysql_query("SELECT * FROM slider WHERE status='Y' LIMIT 4");
				while ($rslider = mysql_fetch_array($slider)) {
					echo '
					<li><img src="foto_slider/'.$rslider[gambar].'" alt="'.$rslider[judul].'"></li>';
				}
			?>	
				</ul>
			</div>
			<!-- ./Home slide -->
		</div>
		
		<div class="col-sm-8 col-md-12 col-lg-2">
			<div class="block block-banner-owl kt-owl-carousel" ata-margin="0" data-loop="true" data-nav="true" data-responsive='{"0":{"items":1},"600":{"items":1},"1000":{"items":1}}'>
				<div class="page-banner">
					<ul class="list-banner">
				<?php
				$banner = mysql_query("SELECT * FROM banner LIMIT 1");
				while ($rbanner = mysql_fetch_array($banner)) {
					echo '
					<li><a href="#"><img src="foto_banner/'.$rbanner[gambar].'" alt="'.$rbanner[judul].'"></a></li>';
				}
			?>
					</ul>
				</div>
				<!-- tidak di tampilkam -->
				<div class="page-banner">
					<ul class="list-banner">
						<li><a href="#"><img src="foto_banner/4.jpg" alt="banner"></a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
<div class="container">
<div class="row">
	<div class="row">
		<div class="col-sm-4 col-md-3">
			<!-- specail -->
			<div class="block block-specail3">
				<div class="block-head">
					<h4 class="widget-title">Spesial</h4>
				</div>
				<div class="block-inner">
					<ul class="products kt-owl-carousel" data-margin="20" data-loop="true" data-nav="true" data-responsive='{"0":{"items":1},"600":{"items":2},"768":{"items":1}}'>
			<?php
				$produk = mysql_query("SELECT * FROM produk WHERE status='spesial' LIMIT 6");
				while($r = mysql_fetch_array($produk)){
					// echo $r[id_produk];
										
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
						<li class="product">
							<div class="product-container">
								<div class="product-left">
									<div class="product-thumb">
										<a class="product-img" href="produk-'.$r[id_produk].'-'.$r[produk_seo].'.html">
										
										<div title="'.$r[nama_produk].'" class="gambar_fb" style="background-image: url(foto_produk/'.$gbr[NamaGambar].')"></div>
										</a>
										<a title="Quick View" href="#" class="btn-quick-view">Quick View</a>
									</div>
									<div class="product-status">
										<span class="new">spesial</span>
									</div>
								</div>
								<div class="product-right">
									<div class="product-name">
										<a href="produk-'.$r[id_produk].'-'.$r[produk_seo].'.html">'.$r[nama_produk].'</a>
									</div>
									<div class="price-box">
										'.$rego.'
									</div>
									<div class="product-button">
										<a class="button-radius btn-add-cart" title="Beli" href="aksi.php?module=keranjang&act=tambah&id='.$r[id_produk].'"> Beli <span class="icon"></span></a>
									</div>
								</div>
							</div>
						</li>
					';
				}
			?>
					</ul>
				</div>
			</div>
			<div class="block block-specail3">
				<div class="block-head">
					<h4 class="widget-title">Promo</h4>
				</div>
				<div class="block-inner">
					<ul class="products kt-owl-carousel" data-margin="20" data-loop="true" data-nav="true" data-responsive='{"0":{"items":1},"600":{"items":2},"768":{"items":1}}'>
			<?php
				$produkpromo = mysql_query("SELECT * FROM produk WHERE status='promo' LIMIT 6");
				while($rpromo = mysql_fetch_array($produkpromo)){
					
					$gbrproduk  = mysql_query("SELECT * FROM imagesproduk WHERE idProduk = '$rpromo[id_produk]'");
					$gbr = 	mysql_fetch_array($gbrproduk);
					
					$harga     = format_rupiah($rpromo[harga]);
					$disc      = ($rpromo[diskon]/100)*$rpromo[harga];
					$hargadisc = number_format(($rpromo[harga]-$disc),0,",",".");
					if ($rpromo[diskon] == 0) {
						$rego =  '<span class="product-price">Rp. '.$harga.'</span>';
					} else {
						$rego =  '
						<span class="product-price">Rp. '.$hargadisc.'</span>
						<span class="product-price-old">Rp. '.$harga.'</span>
						';
					}
					echo '
						<li class="product">
							<div class="product-container">
								<div class="product-left">
									<div class="product-thumb" >
										<a class="product-img" href="produk-'.$rpromo[id_produk].'-'.$rpromo[produk_seo].'.html">
										
										<div title="'.$rpromo[nama_produk].'" class="gambar_fb" style="background-image: url(foto_produk/'.$gbr[NamaGambar].')"></div>
										</a>
										<a title="Quick View" href="#" class="btn-quick-view">Quick View</a>
									</div>
									<div class="product-status">
										<span class="new">'.$rpromo[status].'</span>
									</div>
								</div>
								<div class="product-right">
									<div class="product-button">
										<a class="button-radius btn-add-cart" title="Beli" href="aksi.php?module=keranjang&act=tambah&id='.$rpromo[id_produk].'"> Beli <span class="icon"></span></a>
									</div>
								</div>
							</div>
						</li>
					';
				}
			?>
					</ul>
				</div>
			</div>
			<!-- ./specail -->
			
		</div>
		<div class="col-sm-8 col-md-9">
			<!-- new-arrivals -->
			<div class="block3 block-new-arrivals">
				<div class="block-head">
					<h3 class="block-title">Terbaru</h3>
					
				</div>
				<div class="block-inner">
					<div class="tab-container">
						<div id="tab-1" class="tab-panel active">
							<ul class="products kt-owl-carousel" data-margin="20" data-loop="true" data-nav="true" data-responsive='{"0":{"items":1},"600":{"items":3},"768":{"items":2},"1000":{"items":3},"1200":{"items":4}}'>
					<?php
						$produk = mysql_query("SELECT * FROM produk ORDER BY id_produk DESC LIMIT 10");
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
								<span class="product-price">Rp. '.$hargadisc.'</span>
								<span class="product-price-old">Rp. '.$harga.'</span>
								';
							}
							echo '
								<li class="product">
									<div class="product-container">
										<div class="product-left">
											<div class="product-thumb tengah">
												<a class="product-img" href="produk-'.$r[id_produk].'-'.$r[produk_seo].'.html">
												<div class="" >
												<div title="'.$r[nama_produk].'" class="gambar_fb" style="background-image: url(foto_produk/'.$gbr[NamaGambar].')"></div>
												</div>
												</a>
												<a title="Detail Produk" href="produk-'.$r[id_produk].'-'.$r[produk_seo].'.html" class="btn-quick-view">Detail Produk </a>
											</div>
											<div class="product-status">
												<span class="new">Baru</span>
											</div>
										</div>
										<div class="product-right">
											<div class="product-name">
												<a href="produk-'.$r[id_produk].'-'.$r[produk_seo].'.html">'.$r[nama_produk].'</a>
											</div>
											<div class="price-box">
												'.$rego.'
											</div>
											<div class="product-button">
										<a class="button-radius btn-add-cart" title="Beli" href="aksi.php?module=keranjang&act=tambah&id='.$r[id_produk].'"> Beli <span class="icon"></span></a>
											</div>
										</div>
									</div>
								</li>
							';
						}
					?>			
							</ul>
						</div>
					</div>
				</div>
			</div>
			<!-- new-arrivals -->
			<!-- Hot deals -->
			<div class="block3 block-hotdeals">
				<div class="block-head">
					<h3 class="block-title">Terlaris</h3>
					<a class="link-all" href="#">View All</a>
				</div>
				<div class="block-inner">
					<ul class="products kt-owl-carousel" data-margin="20" data-loop="true" data-nav="true" data-responsive='{"0":{"items":1},"600":{"items":3},"768":{"items":2},"1000":{"items":3},"1200":{"items":4}}'>
					<?php
						$produk = mysql_query("SELECT * FROM produk ORDER BY dibeli DESC LIMIT 10");
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
								<span class="product-price">Rp. '.$hargadisc.'</span>
								<span class="product-price-old">Rp. '.$harga.'</span>
								';
							}
							echo '										
						<li class="product">
							<div class="product-container">
								<div class="product-left">
									<div class="product-thumb">
										<a class="product-img" href="produk-'.$r[id_produk].'-'.$r[produk_seo].'.html">
												<div title="'.$r[nama_produk].'" class="gambar_fb" style="background-image: url(foto_produk/'.$gbr[NamaGambar].')"></div>
												</a>
												<a title="Detail" href="produk-'.$r[id_produk].'-'.$r[produk_seo].'.html" class="btn-quick-view">Detail</a>
									</div>
									<div class="product-status">
										<span class="new">'.$r[status].'</span>
									</div>
								</div>
								<div class="product-right">
									<div class="product-name">
										<a href="produk-'.$r[id_produk].'-'.$r[produk_seo].'.html">'.$r[nama_produk].'</a>
									</div>
									<div class="price-box">
										'.$rego.'
									</div>
									<div class="product-button">
										<a class="button-radius btn-add-cart" title="Add to Cart" href="#">Buy<span class="icon"></span></a>
									</div>
								</div>
							</div>
						</li>
							';
						}
					?>		
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
</div>