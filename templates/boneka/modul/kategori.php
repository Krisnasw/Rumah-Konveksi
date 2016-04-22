<?php
echo '
<div class="container">
	<div class="row">
	
		<div class="block block-breadcrumbs">
			<ul>
				<li class="home">
					<a href="./"><i class="fa fa-home"></i></a>
					<span></span>
				</li>
				<li><a href="#">Semua Artikel</a><span></span></li>
			</ul>
		</div>
	
		<div class="row">';
	include "kanan.php";	
		echo '
						
			<div class="col-xs-12 col-sm-8 col-md-9">
			
				<h3 class="page-title">
					<span>'.$r[nama_produk].'</span>
				</h3>
				<div class="category-products">
					<ul class="products list">';
					

	$p      = new PagingKate;
	$batas  = 2;
	$posisi = $p->cariPosisi($batas);

	$artikel = mysql_query("SELECT * FROM artikel WHERE id_kategori='$_GET[id]' LIMIT $posisi,$batas ");
	while ($rartikel = mysql_fetch_array($artikel))	{
		
			$isi_berita = strip_tags($rartikel[deskripsi]);
			$isi = substr($isi_berita,0,250);
			$link = "artikel-$rartikel[id_artikel]-$rartikel[artikel_seo].html";
					echo'
						<li class="product">
							<div class="product-container">
								<div class="inner row">
									<div class="product-left col-sm-4">
										<div class="product-thumb">
											<a class="product-img" href="#"><img src="foto_berita/'.$rartikel[gambar].'" alt="'.$rartikel[judul].'"></a>
											<a title="Detail" href="'.$link.'" class="btn-quick-view">Detail</a>
										</div>
									</div>
									<div class="product-right col-sm-8">
										<div class="product-name">
												<a href="'.$link.'">'.$rartikel[judul].'</a>
											</div>
										<div class="desc">
											'.$isi.'
										</div>
										<div class="desc">
											
			<a class="btn-add-cart" href="https://api.addthis.com/oexchange/0.8/forward/facebook/offer?url='.$ridentitas[alamat_website].'/'.$link.'" target="_blank"><img src="files/icon-facebook.png" border="0" alt="Facebook"/></a> &nbsp;
		
			<a class="btn-add-cart" href="https://api.addthis.com/oexchange/0.8/forward/twitter/offer?url='.$ridentitas[alamat_website].'/'.$link.'" target="_blank"><img src="files/icon-twitter.png" border="0" alt="Twitter" style="padding:0 10px 0 10px;"/></a> &nbsp;
		
			<a class="btn-add-cart" href="https://api.addthis.com/oexchange/0.8/forward/google_plusone_share/offer?url='.$ridentitas[alamat_website].'/'.$link.'" target="_blank"><img src="files/icon-google_plus.png" border="0" alt="Google+"/></a>
			
											</div>
										<div class="product-button">
											<a class="button" title="Detail" href="artikel-'.$rartikel[id_artikel].'-'.$rartikel[artikel_seo].'.html"> Detail </a>
										</div>
									</div>
								</div>
							</div>
						</li>';
		
	}
						echo'
					</ul>
					
					<div class="sortPagiBar-inner">
						<nav>
		                     <ul class="pagination">';
						
							  $jmldata     = mysql_num_rows(mysql_query("SELECT * FROM artikel WHERE id_kategori='$_GET[id]'"));
							  $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
							  $linkHalaman = $p->navHalaman($_GET[halkategori], $jmlhalaman);
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
</div>
';
?>	