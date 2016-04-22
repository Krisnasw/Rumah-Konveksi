<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title><?php include "dina_titel.php"; ?></title>
        <meta content="<?php include "dina_meta1.php"; ?>" name="description">
        <meta content="<?php include "dina_meta2.php"; ?>" name="keywords">
        <meta name="robots" content="INDEX,FOLLOW" />
        <meta name="author" content="admin" />

		<meta name="viewport" content="width=device-width, initial-scale=1">
		<?php echo '
		<link rel="stylesheet" type="text/css" href="'.$f[folder].'/assets/css/reset.css" />';?>
    <link rel="stylesheet" type="text/css" href="<?php echo "$f[folder]/"; ?>assets/lib/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo "$f[folder]/"; ?>assets/lib/font-awesome/css/font-awesome.min.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo "$f[folder]/"; ?>assets/lib/owl.carousel/owl.carousel.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo "$f[folder]/"; ?>assets/lib/jquery-ui/jquery-ui.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo "$f[folder]/"; ?>assets/css/animate.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo "$f[folder]/"; ?>assets/css/global.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo "$f[folder]/"; ?>assets/css/style.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo "$f[folder]/"; ?>assets/css/responsive.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo "$f[folder]/"; ?>assets/css/option3.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo "$f[folder]/"; ?>assets/css/option2.css" />
	
    <link rel="stylesheet" type="text/css" href="<?php echo "$f[folder]/"; ?>assets/css/aksamedia-cta.css" />
		
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
			
	<?php
		echo '<link href="files/'.$ridentitas[favicon].'" rel="icon" />
	<link rel="apple-touch-icon" href="files/'.$ridentitas[favicon].'">
	<link rel="apple-touch-icon" sizes="72x72" href="files/'.$ridentitas[favicon].'">
	<link rel="apple-touch-icon" sizes="114x114" href="files/'.$ridentitas[favicon].'">';
			
		if($_GET['module'] == 'detailproduk'){
			$qOpenGraph = mysql_query("SELECT produk_seo,nama_produk FROM produk WHERE id_produk='$_GET[id]'");
			$rOpenGraph = mysql_fetch_array($qOpenGraph);
			$qgbr = mysql_query("SELECT NamaGambar FROM imagesproduk WHERE idProduk='$_GET[id]'");
			$rgbr = mysql_fetch_array($qgbr);
			
			echo '
				<meta property="og:url" content="'.$ridentitas[alamat_website].'/produk-'.$_GET[id].'-'.$rOpenGraph[produk_seo].'.html" /> 
				<meta property="og:title" content="'.$rOpenGraph[nama_produk].'" />
				<meta property="og:description" content="'; include "dina_meta1.php"; echo'" /> 
				<meta property="og:image" content="'.$ridentitas[alamat_website].'/foto_produk/'.$rgbr[NamaGambar].'" />        
			';
		}
		else{
			echo '
				<meta property="og:url" content="'.$ridentitas[alamat_website].'" /> 
				<meta property="og:title" content="';include "dina_titel.php"; echo'" />
				<meta property="og:description" content="'; include "dina_meta1.php"; echo'" />     
			';  
		}
		echo '
    </head>';
	 echo'
<body class="option2">';	
	?>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/id_ID/sdk.js#xfbml=1&version=v2.4";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

	<!-- header -->
	<header id="header">
		<div class="container">
			<!-- main header -->
			<div class="row">
				<div class="main-header">
					<div class="row">
						<div class="col-sm-12 col-md-2 col-lg-2">
							<div class="logo">
							<?php
							echo '<a href="./"><img src="files/'.$ridentitas[logo].'" alt="'.$ridentitas[meta_deskripsi].'"></a>';
							?>					
							</div>
						</div>
						<div class="col-sm-12 col-md-6 col-lg-7">
							<div class="advanced-search box-radius">
								<form class="form-inline" method="POST" action="hasil-pencarian.html">
									<div class="form-group search-category">
										<select id="category-select" class="search-category-select" name="kategori">
											<option value="0">All Categories</option>
									<?php
									$kategori = mysql_query("SELECT * FROM kategoriproduk");
									while ($rkategori = mysql_fetch_array($kategori)) {
										echo '<option value="'.$rkategori[id_kategori].'">'.$rkategori[nama_kategori].'</option>';
									}
									?>	
										</select>
									</div>
									<div class="form-group search-input">
										<input type="text" name="search" placeholder="Cari Disini ...">
									</div>
									<button type="submit" class="btn-search"><i class="fa fa-search"></i></button>
								</form>
							</div>
						</div>												
				<div class="col-sm-7 col-md-4 col-lg-3 kolor">
							<div class="block block-header-right knan">
								<ul class="list-link">
									
									<li class="item item-cart block-wrap-cart">
									<?php $sid = session_id();
											$n = 0;
				$sql = mysql_query("SELECT * FROM orders_temp ot LEFT JOIN produk p 
									ON ot.id_produk=p.id_produk WHERE ot.id_session='$sid'");
				$jum = mysql_num_rows($sql);
				
				while($ri=mysql_fetch_array($sql)){
				
					$jumlah = $jumlah + $ri[jumlah]; 
					$gbrproduk  = mysql_query("SELECT * FROM imagesproduk WHERE idProduk = '$ri[id_produk]'");
					$gbr = 	mysql_fetch_array($gbrproduk);
					
					$disc        = ($ri[diskon]/100)*$ri[harga];
					$hargadisc   = number_format(($ri[harga]-$disc),0,",",".");

					$subtotal    = ($ri[harga]-$disc) * $ri[jumlah];
					$total       = $total + $subtotal;  
					$subtotal_rp = format_rupiah($subtotal);
					$total_rp    = format_rupiah($total);
					if ($ri[diskon] == 0) {
						$harga = format_rupiah($ri[harga]);
					} else { $harga = $hargadisc; }
						
					$produk [] = '
			                                <li class="product-info">
			                                    <div class="p-left">
			                                        <a href="aksi.php?module=keranjang&act=hapus&id='.$ri[id_orders_temp].'" class="remove_link"></a>
			                                        <a href="#">
			                                        <img class="img-responsive" src="foto_produk/small_'.$gbr[NamaGambar].'" alt="'.$ri[nama_produk].'">
			                                        </a>
			                                    </div>
			                                    <div class="p-right">
			                                        <p class="p-name">'.$ri[nama_produk].'</p>
			                                        <p class="product-price">Rp.'.$harga.'</p>
			                                        <p>Qty: '.$ri[jumlah].'</p>
			                                    </div>
			                                </li>
					';
					$n++;
				}
				if ($jum > 0) { 
					$item = '
						<span class="total">'.$jumlah.' Items &nbsp; </span> 
						<span class="total"> Rp. '.$total_rp.' ,-</span>
					';
					$incart = '<h5 class="mini-cart-head">'.$jumlah.' Items in my cart</h5>';
					$belanjaan = '
						<div class="toal-cart">
							<span>Total</span>
							<span class="toal-price pull-right">Rp. '.$total_rp.' ,-</span>
						</div>
						<div class="cart-buttons">
							<a href="check-out" class="button-radius btn-check-out">Checkout<span class="icon"></span></a>
						</div>					
					';
				} else { 
					$item = '<span class="total">0 Item &nbsp; </span>';
					$incart = '<h5 class="mini-cart-head">Cart Kosong</h5>';
					$belanjaan = '&nbsp;';
				}
									?>
										<a href="keranjang-belanja.html">
											<span class="icon cart"></span>
											<span class="line1">Keranjang Belanja<br><strong><?php echo $item; ?></strong></span>
										</a>
                                        <div class="block-mini-cart">
                                            <div class="mini-cart-content">
                                            <h5 class="mini-cart-head"><?php echo $incart; ?></h5>
                                            <div class="mini-cart-list">
                                                <ul>

                                                    <?php 
                                                    	for ($i=0;$i<=$jum;$i++) {
				echo $produk[$i];				
				}
                                                    ?>
                                                    
                                                </ul>
                                                </div>
                                                <?php echo $belanjaan; ?>
                                            </div>
                                        </div>
									</li>
								</ul>
							</div>
						</div>
								</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- ./main header -->
		</div>
		<div class="container">
			<div class="row">
				<!-- main menu-->
				<div class="main-menu">
					<div class="container">
						<div class="row">
							
						</div>
					</div>
				</div>
				<!-- ./main menu-->
			</div>
		</div>
	</header>
	<!-- ./header -->
	<?php 
		include 'konten.php'; 
		// $c = mysql_query("SELECT * FROM footer_promo WHERE id='12'");
		// $x = mysql_fetch_array($c);

		// $left = mysql_fetch_array(mysql_query("SELECT * FROM footer_promo WHERE id='11'"));
		// $left_down = mysql_fetch_array(mysql_query("SELECT * FROM footer_promo WHERE id='10'"));
	?>
	
	<!-- <div class="container">
		<div class="row">
			

			<div class="block block-banner2">
                <div class="row">
                    <div class="box-left col-sm-12 col-md-8">
                        <div class="col-sm-6">
                            <div class="inner">
                                <h4><b><?php echo $x['judul']; ?></b></h4>
                                <div class="content-text">
                                    <p><?php echo $x['deskripsi']; ?></p>
                                </div>
                                <a href="<?php echo $x['url']; ?>" target="_blank" class="button-radius">Shop now<span class="icon"></span></a>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <a href="#"><img src="foto_footer/<?php echo $x['gambar']; ?>" alt="Banner"></a>
                        </div>
                    </div>
                    <div class="box-right col-sm-12 col-md-4">
                        <div class="item i1">
                            <div class="row">
                                <div class="col-sm-8">
                                   	<h4><b><?php echo $left['judul']; ?></b></h4>
                                    <div class="content-text">
                                        <p><?php echo $left['deskripsi']; ?></p>
                                    </div>
                                    <a href="<?php echo $left['url']; ?>" target="_blank" class="button-radius">Shop now<span class="icon"></span></a>
                                </div>
                                <div class="col-sm-4">
                                    <img src="foto_footer/<?php echo $left['gambar']; ?>" alt="b8">
                                </div>
                            </div>
                        </div>
                        <div class="item i2" style="background: url('foto_footer/<?php echo $left_down['gambar']; ?>') no-repeat right center;">
                            <div class="row">
                                <div class="col-sm-6">
                                   	<h4><b><?php echo $left_down['judul']; ?></b></h4>
                                    <a href="<?php echo $left_down['url']; ?>" target="_blank"  class="button-radius">Shop now<span class="icon"></span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


		</div>
	</div> -->
	<!-- footer -->
	<footer id="footer">
		<!-- <div class="footer-top">
			<div class="container">
				<div class="row">
					<div class="row">
						<div class="col-sm-12 col-md-4">
							<div class="block footer-block-box">
								<div class="block-head">
									<div class="block-title">
										<div class="block-icon">
											<img src="files/location-icon.png" alt="store icon">
										</div>
										<div class="block-title-text text-sm">Temukan </div>
										<div class="block-title-text text-lg">Toko Boneka</div>
									</div>
								</div>
								<div class="block-inner">
									<div class="block-info clearfix">
										Tulis E-mail anda, tim kami akan segera mengirimkan proposal penawaran terbaik bagi anda.
									</div>
									<div class="block-input-box box-radius clearfix">
										<input type="text" class="input-box-text" placeholder="Zip code, City, Country">
										<button class="block-button">Kirim</button>
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-12 col-md-4">
							<div class="block footer-block-box">
								<div class="block-head">
									<div class="block-title">
										<div class="block-icon">
											<img src="files/email-icon.png" alt="store icon">
										</div>
										<div class="block-title-text text-sm">SUBSCRIBE TO</div>
										<div class="block-title-text text-lg">EMAILS Toko Boneka </div>
									</div>
								</div>
								<div class="block-inner">
									<div class="block-info clearfix">
										Tulis E-mail anda, tim kami akan segera mengirimkan proposal penawaran terbaik bagi anda.
									</div>
									<div class="block-input-box box-radius clearfix">
										<input type="text" class="input-box-text" placeholder="Email address">
										<button class="block-button">Kirim</button>
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-12 col-md-4">
							<div class="block footer-block-box">
								<div class="block-head">
									<div class="block-title">
										<div class="block-icon">
											<img src="files/partners-icon.png" alt="store icon">
										</div>
										<div class="block-title-text text-sm">our</div>
										<div class="block-title-text text-lg">partners</div>
									</div>
								</div>
								<div class="block-inner">
									<div class="block-owl">
										<ul class="kt-owl-carousel list-partners" data-nav="true" data-autoplay="true" data-loop="true" data-items="1">
											<li class="partner"><a href="#"><img src="files/330x85.JPG" alt="partner"></a></li>
											<li class="partner"><a href="#"><img src="files/330x85.JPG" alt="partner"></a></li>
											<li class="partner"><a href="#"><img src="files/330x85.JPG" alt="partner"></a></li>
										</ul>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div> -->
		<div class="footer-middle">
			<div class="container">
				<div class="row">
					<div class="row">
						<div class="col-md-3 col-sm-4 block-link-wapper">
							<div class="block-link">
								<ul class="list-link">
									<li class="head"><a href="#">Kategori Produk</a></li>
									<?php
										$a = mysql_query("SELECT * FROM kategoriproduk ORDER BY id_kategori DESC LIMIT 0,7");
										while($b = mysql_fetch_array($a)){
									?>
										<li><a href="<?php echo 'kategoriproduk-'.$b[id_kategori].'-'.$b[kategori_seo].''; ?>.html" ><?php echo $b['nama_kategori'];?></a></li>
									<?php } ?>
								</ul>
							</div>
						</div>
						<div class="col-md-3 col-sm-4 block-link-wapper">
							<div class="block-link">
								<ul class="list-link">
									<li class="head"><a href="#">Menu</a></li>
									<?php
									$q=mysql_query("SELECT * FROM mainmenu WHERE aktif='Y' ORDER BY no_urut");
									while ($r=mysql_fetch_array($q)) {
									?>
									<li><a href="<?php echo $r['link'];?>"><?php echo $r['nama_menu'];?></a></li>
									<?php } ?>
								 </ul>
							</div>
						</div>
						<!-- <div class="col-md-3 col-sm-4 block-link-wapper">
							<div class="block-link">
									<div class="fb-page" data-href="#" data-height="215px" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true" data-show-posts="false"><div class="fb-xfbml-parse-ignore"><blockquote cite="#"><a href="#">Produk Bangsa</a></blockquote></div></div>
							</div>
						</div> -->
						<div class="col-md-3 col-sm-4 block-link-wapper">
							<div class="block-link">
									<iframe src="#" width="300" height="200" frameborder="0" style="border:0" allowfullscreen></iframe>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div class="footer-bottom">
			<div class="container">
				<div class="row">
					<div class="block-coppyright">
						Copyright © 2016 <a href="#" target="_blank">Intive Studio</a>. All Rights Reserved.
					</div>
					<div class="block-shop-phone">
						<div class="block-social">
							<ul class="list-social">
				<?php		
					$sosial = mysql_query("SELECT * FROM sosial WHERE aktif='Y'");
					while($rsosial=mysql_fetch_array($sosial)){ 
					echo '<li><a href="'.$rsosial[link].'" target="_blank"><i class="fa fa-'.$rsosial[nama].'"></i></a></li>';
					}
				?>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</footer>
	
	<!-- ./footer -->
	<a href="#" class="scroll_top" title="Scroll to Top" style="display: inline;">Scroll</a>
		
	<script type="text/javascript" src="<?php echo "$f[folder]/"; ?>assets/lib/jquery/jquery-1.11.2.min.js"></script>	
	<script type="text/javascript" src="<?php echo "$f[folder]/"; ?>assets/lib/bootstrap/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?php echo "$f[folder]/"; ?>assets/lib/jquery.bxslider/jquery.bxslider.min.js"></script>
	<script type="text/javascript" src="<?php echo "$f[folder]/"; ?>assets/lib/owl.carousel/owl.carousel.min.js"></script>
	<script type="text/javascript" src="<?php echo "$f[folder]/"; ?>assets/lib/jquery-ui/jquery-ui.min.js"></script>
	<!-- COUNTDOWN -->
	<script type="text/javascript" src="<?php echo "$f[folder]/"; ?>assets/lib/countdown/jquery.plugin.js"></script>
	<script type="text/javascript" src="<?php echo "$f[folder]/"; ?>assets/lib/countdown/jquery.countdown.js"></script>
	<!-- ./COUNTDOWN -->
	<script type="text/javascript" src="<?php echo "$f[folder]/"; ?>assets/js/jquery.actual.min.js"></script>
	<script type="text/javascript" src="<?php echo "$f[folder]/"; ?>assets/js/script.js"></script>	
		<!-- cta -->
	<script type="text/javascript" src="<?php echo "$f[folder]/"; ?>assets/js/aksamedia-cta.js"></script>
	<script type="text/javascript">
	<?php		
		$cta = mysql_query("SELECT * FROM cta");
		$rcta=mysql_fetch_array($cta);
	?>
		var pin ='<?php echo $rcta[pin] ?>';
		var telp ='<?php echo $rcta[telp_indosat] ?>';
		var mail ='<?php echo $rcta[email] ?>';
	</script>
	
</body>
</html>