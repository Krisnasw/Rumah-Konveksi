<div class="container">
		<div class="row">
			<div class="row">
				<div class="col-sm-3 col-md-2">
					<!-- Block vertical-menu -->
					<div class="block block-vertical-menu">
						<div class="vertical-head">
							<h5 class="vertical-title">Kategori Produk</h5>
						</div>
						<div class="vertical-menu-content">
					                        <ul class="vertical-menu-list">
					                        <li class="vertical-menu1">
	                      					<a href="custom.html">
	                      						<img class="icon-menu" alt="Funky roots" src="<?php echo "$f[folder]/"; ?>data/2.png"> Custom
	                      					</a>
	                      					</li>
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
								?>
	                            <li>
                                    <a href="kategoriproduk-<?php echo $rkategori[id_kategori]; ?>-<?php echo $rkategori[kategori_seo]; ?>.html"><img class="icon-menu" alt="Funky roots" src="<?php echo "$f[folder]/"; ?>data/2.png"><?php echo $rkategori[nama_kategori]; ?></a>
                                    <?php 
                                    	if ($jmlsub > 0) {
                                    ?>
                                    <div class="vertical-dropdown-menu">
                                        <div class="vertical-groups">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="block-content-vertical-menu border-left">
                                                        <h3 class="head" style="background:#e664fe;"><?php echo $rkategori[nama_kategori]; ?></h3>
                                                        <div class="inner">
                                                        <ul class="vertical-menu-link">
                                                        <?php 
                                                        	while ($rsub = mysql_fetch_array($subkategori)) {
                                                        ?>
                                                            <li>
                                                                <a href="subkategoriproduk-<?php echo $rsub[id_subkategori]; ?>-<?php echo $rsub[subkategori_seo]; ?>.html">
                                                                    <span class="text"><?php echo $rsub[nama_sub]; ?></span>
                                                                    
                                                                </a>
                                                            </li>
                                                          <?php 
                                                          	}
                                                          ?>
                                                        </ul>
                                                    </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php } ?>
                                </li>
                                <?php 
                            		}
                                ?>
	                            
	                        </ul>
	                    </div>
					</div>
					<!-- ./Block vertical-menu -->
				</div>
			
				<div class="col-sm-9 col-md-7">
					<!-- Home slide -->
					<div class="block block-slider">
						<ul class="home-slider kt-bxslider">
						<?php 
							$slider = mysql_query("SELECT * FROM slider WHERE status='Y' LIMIT 4");
							while ($rslider = mysql_fetch_array($slider)) {
						?>
							<li><img src="foto_slider/<?php echo $rslider[gambar]; ?>" alt="<?php echo $rslider[judul]; ?>"></li>
						<?php 
							}
						?>
						</ul>
					</div>
					<!-- ./Home slide -->
				</div>
				<div class="col-sm-9 col-md-3">
					<div class="block-banner-right banner-hover">
					<?php 
						$banner = mysql_query("SELECT * FROM banner ORDER BY id_banner ASC LIMIT 2 ");
						while ($rbanner = mysql_fetch_array($banner)) {
					?>
						<a href="<?php echo $rbanner[url]; ?>"><img src="foto_banner/<?php echo $rbanner[gambar]; ?>" alt="<?php echo $rbanner[judul]; ?>" title="<?php echo $rbanner[judul]; ?>"></a>
					<?php 
						}
					?>
						
					</div>
				</div>
				<!-- block banner owl-->
				
				<!-- ./block banner owl-->
				<!-- block tabs -->
				<div class="col-sm-12">
					<div class="block block-tabs">
						<div class="block-head">
							<div class="block-title">
								<div class="block-title-text text-lg">Terlaris</div>
							</div>
							
						</div>
						<div class="block-inner">
							<div class="tab-container">
								<div id="tab-1" class="tab-panel active">
									<ul class="products kt-owl-carousel" data-margin="20" data-loop="true" data-nav="true" data-responsive='{"0":{"items":1},"600":{"items":3},"1000":{"items":5}}'>
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

									?>
										<li class="product">
											<div class="product-container">
												<div class="product-left">
													<div class="product-thumb">
														<a class="product-img" href="produk-<?php echo $r[id_produk]; ?>-<?php echo $r[produk_seo]; ?>.html">
														<div title="<?php echo $r[nama_produk]; ?>" class="gambar_fb" style="background-image: url(foto_produk/small_<?=$gbr[NamaGambar]; ?>)">
														</div>
														</a>
														<a title="Quick View" href="produk-<?php echo $r[id_produk]; ?>-<?php echo $r[produk_seo]; ?>.html" class="btn-quick-view">Detail</a>
													</div>
													<div class="product-status">
														<span class="new"><?php echo $r[status]; ?></span>
													</div>
												</div>
												<div class="product-right">
													<div class="product-name">
														<a href="produk-<?php echo $r[id_produk]; ?>-<?php echo $r[produk_seo]; ?>.html"><?php echo $r[nama_produk]; ?></a>
													</div>
													<div class="price-box">
														<?php echo $rego; ?>
													</div>
													
				                                    <div class="product-button">
				                                    	
				                                    	<a class="button-radius btn-add-cart" title="Beli" href="aksi.php?module=keranjang&act=tambah&id=<?php echo $r[id_produk]; ?>">Beli<span class="icon"></span></a>
				                                    </div>
												</div>
											</div>
										</li>
										<?php 
											}
										?>
										
										
										
									</ul>
								</div>

								
							</div>
						</div>
					</div>
				</div>
				<!-- ./block tabs -->

				<!-- Block hot deals2 -->
				<div class="col-sm-12">
					<div class="block-hot-deals2">
						<h3 class="title">promo</h3>
						<div class="row">
							<div class="col-sm-4 col-md-3">
								<div class="block-banner-right banner-hover">
					<?php 
						$bannerl = mysql_query("SELECT * FROM banner ORDER BY id_banner DESC LIMIT 1 ");
						while ($rbannerl = mysql_fetch_array($bannerl)) {
					?>
						<a href="<?php echo $rbannerl[url]; ?>"><img src="foto_banner/<?php echo $rbannerl[gambar]; ?>" alt="<?php echo $rbannerl[judul]; ?>" title="<?php echo $rbannerl[judul]; ?>"></a>
					<?php 
						}
					?>
						
					</div>
							</div>
							<div class="col-sm-8 col-md-9">
								<div class="tab-container">
									<div id="hotdeals-1" class="tab-panel active">
										<ul class="products kt-owl-carousel" data-margin="30" data-loop="true" data-nav="true" data-responsive='{"0":{"items":1},"600":{"items":2},"1000":{"items":3}}'>
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
											?>
											<li class="product">
												<div class="product-container">
													<div class="product-left">
														<div class="product-thumb">
															<a class="product-img" href="produk-<?php echo $rpromo[id_produk]; ?>-<?php echo $rpromo[produk_seo]; ?>.html">
															<div title="<?php echo $rpromo[nama_produk]; ?>" class="gambar_fb" style="background-image: url(foto_produk/small_<?php echo $gbr[NamaGambar]; ?>)"></div>
															<a title="Quick View" href="produk-<?php echo $rpromo[id_produk]; ?>-<?php echo $rpromo[produk_seo]; ?>.html" class="btn-quick-view">Detail</a>
														</div>
														<div class="product-status">
														<span class="new"><?php echo $rpromo[status]; ?></span>
													</div>
													</div>
													<div class="product-right">
														<div class="product-name">
															<a href="produk-<?php echo $rpromo[id_produk]; ?>-<?php echo $rpromo[produk_seo]; ?>.html"><?php echo $rpromo[nama_produk]; ?></a>
														</div>
														<div class="price-box">
															<?php echo $rego; ?>
														</div>
														
					                                    <div class="product-button">
					                                    	
					                                    	<a class="button-radius btn-add-cart" title="Beli" href="aksi.php?module=keranjang&act=tambah&id=<?php echo $r[id_produk]; ?>">Beli<span class="icon"></span></a>
					                                    </div>
													</div>
												</div>
											</li>
											<?php 
												}
											?>
											
										</ul>
									</div>

									
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- Block hot deals2 -->
                <!-- block banner -->
              
                <!-- ./block banner -->
				<!-- block tabs -->
				
				<!-- ./block tabs -->

			</div>
		</div>
	</div>