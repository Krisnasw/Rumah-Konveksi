<?php
echo '
	<div class="col-xs-12 col-sm-4 col-md-3">';
					
		echo'			
		<div class="block block-sidebar">
			<div class="block-head">
				<h5 class="widget-title">Kategori Produk</h5>
			</div>
			<div class="block-inner">
				<div class="block-list-category">
					<ul class="tree-menu">';
					$kategori = mysql_query("SELECT * FROM kategoriproduk");
					while ($rkategori = mysql_fetch_array($kategori)) {
						$subkategori = mysql_query("SELECT * FROM subkategori WHERE id_main = '$rkategori[id_kategori]'");
						$jmlsub = mysql_num_rows($subkategori);
						echo '
						<li>
							<a href="kategoriproduk-'.$rkategori[id_kategori].'-'.$rkategori[kategori_seo].'.html">'.$rkategori[nama_kategori].'</a>
							<ul style="display: none;">';
							while ($rsub = mysql_fetch_array($subkategori)) { 
							
								echo '
								<li><span></span>
									<a href="subkategoriproduk-'.$rsub[id_subkategori].'-'.$rsub[subkategori_seo].'.html">'.$rsub[nama_sub].'
								</a></li>';
							}
							echo '
							</ul>
						</li>
						';
					}
					echo '
					</ul>
				</div>
			</div>
		</div>
					<!--<div class="block block-widget">
						<div class="block-head">
							<h5 class="widget-title">Kategori Artikel</h5>
						</div>
						<div class="block-inner">
							<ul class="list-link">';
							$kategori = mysql_query("SELECT * FROM kategori");
							while ($rkategori = mysql_fetch_array($kategori)) {
								echo '
								<li>
									<a href="kategori-'.$rkategori[id_kategori].'-'.$rkategori[kategori_seo].'.html">'.$rkategori[nama_kategori].'</a>									
								</li>
								';
							}
							echo '
							</ul>
						</div>
					</div>					
		<div class="block-sidebar-img banner-hover">
			<a href="#"><img src="files/326x300.JPG" alt="Banner"></a>
		</div>-->
	</div>
';
?>	