<!-- ./header -->
<?php
$det=mysql_query("SELECT * FROM produk WHERE id_produk='$_GET[id]'");
$r = mysql_fetch_array($det);

$kategori=mysql_query("SELECT nama_kategori, kategori_seo FROM kategoriproduk   
			  WHERE id_kategori='$r[id_kategori]'");
$rkategori = mysql_fetch_array($kategori);
$subkategori=mysql_query("SELECT nama_sub, subkategori_seo FROM subkategori   
			  WHERE id_subkategori='$r[id_subkategori]'");
$rsubkategori = mysql_fetch_array($subkategori);
		
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
	
	$gbrproduk  = mysql_query("SELECT NamaGambar FROM imagesproduk WHERE idProduk = '$r[id_produk]'");
	$jumlahgbr  = mysql_num_rows($gbrproduk);
	$gbr = mysql_fetch_array($gbrproduk);
echo '
<div class="container">
	<div class="row">
		<div class="block block-breadcrumbs">
			<ul>
				<li class="home">
					<a href="./"><i class="fa fa-home"></i></a>
					<span></span>
				</li>
				<li><a href="kategoriproduk-'.$rkategori[id_kategori].'-'.$rkategori[kategori_seo].'.html">'.$rkategori[nama_kategori].'</a><span></span></li>
				<li><a href="subkategoriproduk-'.$r[id_subkategori].'-'.$rsubkategori[subkategori_seo].'.html">'.$rsubkategori[nama_sub].'</a><span></span></li>
				<li>'.$r[nama_produk].'</li>
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
					<ul class="products list">
						<li class="product">
							<div class="product-container">
								<div class="inner row">
									<div class="product-left col-sm-4">
										<div class="product-thumb">
											<a class="product-img" href="#" data-toggle="modal" data-target="#myModal">
											
											<div title="'.$r[nama_produk].'" class="gambar_fb detail" style="background-image: url(foto_produk/small_'.$gbr[NamaGambar].')"></div></a>
											<a title="Quick View" href="#" class="btn-quick-view" data-toggle="modal" data-target="#myModal">Quick View</a>
										</div>
										
									</div>

									<div class="product-right col-sm-8">
										
										<div class="price-box">
											<h3>'.$rego.'</h3>
										</div>
										<div class="desc">
											'.$r[deskripsi].'-----------------------------------------------------------------
											----------------------------------------------------------------------------------
											---------------------------------------------------------------------------------- 
										</div>
										<div class="desc">
											
			<a class="btn-add-cart" href="https://api.addthis.com/oexchange/0.8/forward/facebook/offer?url='.$ridentitas[alamat_website].'/produk-'.$r[id_produk].'-'.$r[produk_seo].'.html" target="_blank"><img src="files/icon-facebook.png" border="0" alt="Facebook"/></a> &nbsp;
		
			<a class="btn-add-cart" href="https://api.addthis.com/oexchange/0.8/forward/twitter/offer?url='.$ridentitas[alamat_website].'/produk-'.$r[id_produk].'-'.$r[produk_seo].'.html" target="_blank"><img src="files/icon-twitter.png" border="0" alt="Twitter" style="padding:0 10px 0 10px;"/></a> &nbsp;
		
			<a class="btn-add-cart" href="https://api.addthis.com/oexchange/0.8/forward/google_plusone_share/offer?url='.$ridentitas[alamat_website].'/produk-'.$r[id_produk].'-'.$r[produk_seo].'.html" target="_blank"><img src="files/icon-google_plus.png" border="0" alt="Google+"/></a>
			
											</div>
										<div class="product-button">
											<a class="button-radius btn-add-cart" title="Beli" href="aksi.php?module=keranjang&act=tambah&id='.$r[id_produk].'"> Beli <span class="icon"></span></a>
										</div>
									</div>
								</div>

							</div>
						</li>
						
					</ul>
				</div>
				
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">'.strtoupper($r[nama_produk]).'</h4>
      </div>
      <div class="modal-body">
        <center>
        <img src="foto_produk/'.$gbr[NamaGambar].'" title="'.$r[nama_produk].'" alt="'.$r[nama_produk].'"/>
        </center>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
       
      </div>
    </div>
  </div>
 </div>
';
?>	
