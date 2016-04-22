<div class="container">
		<div class="row">
			<div class="block block-breadcrumbs">
				<ul>
					<li class="home">
						<a href="./"><i class="fa fa-home"></i></a><span></span>
					</li>
					<li><a href="artikel">Artikel</a><span></span></li>
					<li>Artikel</li>
				</ul>
			</div>
			<div class="row">
			
				<?php include 'kanan.php' ;?>				
				
				<div class="col-sm-8 col-md-9">
					<div class="main-page">
						<div class="page-content clearfix">
		                    <ul class="blog-posts">
			                    <li class="post-item">
			                        <article class="entry">
			                            <div class="entry-ci">
										
		<?php 
			$det=mysql_query("SELECT * FROM artikel WHERE id_artikel='$_GET[id]'");
			$ra = mysql_fetch_array($det);
			$tgl = tgl_indo($ra[tgl_posting]);
			$baca = $ra[dibaca]+1;
			  // Apabila detail berita dilihat, maka tambahkan berapa kali dibacanya
			  
			mysql_query("UPDATE artikel SET dibaca=$baca WHERE id_artikel='$_GET[id]'"); 
			
											echo '
	                                    	<div class="entry-thumb image-hover2">
		                                        <a href="#">
		                                            <img src="foto_berita/'.$ra[gambar].'" title="'.$ra[judul].'" alt="'.$ra[judul].'"/>
		                                        </a>
		                                    </div>
											
	                                        <h3 class="entry-title"><a href="#">'.$ra[judul].'</a></h3>
	                                        <div class="entry-meta-data">
	                                            <span class="author">
	                                            <i class="fa fa-user"></i> 
	                                            by: <a href="#">Admin</a></span>
	                                           
	                                            <span class="date"><i class="fa fa-calendar"></i> '.$ra[tgl_posting].'</span>
	                                        </div>
	                                        <div class="entry-excerpt">
	                                           '.$ra[deskripsi].'
	                                        </div>
	                                        <div class="entry-excerpt">
											<p>Share this Post:
											</p>
	            <a href="https://api.addthis.com/oexchange/0.8/forward/facebook/offer?url='.$ridentitas['alamat_website'].'/artikel-'.$ra['id_artikel'].'-'.$ra['artikel_seo'].'.html"><img src="files/icon-facebook.png"></a>
				<a href="https://api.addthis.com/oexchange/0.8/forward/twitter/offer?url='.$ridentitas['alamat_website'].'/artikel-'.$ra['id_artikel'].'-'.$ra['artikel_seo'].'.html"><img src="files/icon-twitter.png"></a>
				<a href="https://api.addthis.com/oexchange/0.8/forward/google_plusone_share/offer?url='.$ridentitas['alamat_website'].'/artikel-'.$ra['id_artikel'].'-'.$ra['artikel_seo'].'.html"><img src="files/icon-google_plus.png"></a>
	                                        </div>
	                                    </div>';
		?>
			                        </article>
			                    </li>
			                </ul>
		                </div>
					</div>
				</div>
			</div>
		</div>
	</div>