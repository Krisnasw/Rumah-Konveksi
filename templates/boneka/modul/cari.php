
<?php
  // menghilangkan spasi di kiri dan kanannya
  $search = trim($_POST['search']);
  $kategori = $_POST['kategori'];
  // mencegah XSS
  $search = htmlentities(htmlspecialchars($search), ENT_QUOTES);
	
 $p      = new Pagingcari;
 $batas  = 2;
 $posisi = $p->cariPosisi($batas);  
  // pisahkan kata per kalimat lalu hitung jumlah kata
  $pisah_kata = explode(" ",$search);
  $jml_katakan = (integer)count($pisah_kata);
  $jml_kata = $jml_katakan-1;

// artikel / news
  $cari = "SELECT * FROM produk WHERE " ;
  if ($kategori != 0) {
	  $cari .= "id_kategori = '$kategori' AND ";
  }
	for ($i=0; $i<=$jml_kata; $i++){
	  $cari .= "nama_produk LIKE '%$pisah_kata[$i]%' OR deskripsi LIKE '%$pisah_kata[$i]%'";
	  // $cari .= "nama_produk LIKE '%$search%' OR deskripsi LIKE '%$search%'";
	  if ($i < $jml_kata ){ 
		$cari .= " OR ";
	  }
	}
  $cari .= " ORDER BY id_produk DESC ";
  
  $hasil  = mysql_query($cari);
  $ketemu = mysql_num_rows($hasil);
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
				<li>'.$n[nama_kategori].'Hasil Pencarian Kata "'.$_POST['search'].'"</li>
			</ul>
		</div>';
  if ($ketemu > 0){	 
	
		echo '
		<div class="category-products">
			<ul class="products row">';	
			while($r = mysql_fetch_array($hasil)){
				
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
				</li> ';
				}
	echo '	
			</ul>
		</div>';
	

  } 
  else {
	  echo '
		<div class="row">
			<div class="col-xs-12 col-sm-12">
				<h4 class="page-title">
					<span>Tidak ditemukan produk dengan nama "'.$_POST[search].'"</span>
				</h4>
			</div>
		</div>';
  }	  echo '</div>
</div>';
?>
