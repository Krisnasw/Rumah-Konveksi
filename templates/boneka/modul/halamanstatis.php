<div id="main-content">
<?php

	$sql  = mysql_query("SELECT * FROM halamanstatis WHERE id_halaman='$_GET[id]'");
	$r    = mysql_fetch_array($sql);
	echo '

	<div class="row-fluid">
		<div class="span12">
			<div class="breadcrumb clearfix">
				<a href="./">Home</a>
				<span>/</span>
				<span class="current-page">'.$r[judul].'</span>
			</div>
		</div><!--span12-->
	</div><!--row-fluid-->
	
	<div id="main-col">
		<div id="contact-box">
			<h3><span class="title-line"></span><span class="title-text">'.$r[judul].'</span></h3> 
			
				<article class="entry-item">
					<img src="files/'.$r[gambar].'" alt="'.$r[judul].'" title="'.$r[judul].'" />
				</article><br>
				
				'.$r[isi_halaman].'
			 
		</div>
	</div>
	';
	include"kanan.php"; ?>
	
</div><!--main-content-->