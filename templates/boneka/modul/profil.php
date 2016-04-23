<div id="main-content">
	
	<div class="row-fluid">
		<div class="span12">
			<div class="breadcrumb clearfix">
				<a href="./">Home</a>
				<span>/</span>
				<span class="current-page">About Us</span>
			</div>
		</div><!--span12-->
	</div><!--row-fluid-->
	
	<div id="main-col">
		<div class="span12 widget-area-6">  
		<div class="widget kopa-entry-list-widget oke">		
			<h3 class="widget-title"><span class="title-line"></span><span class="title-text">About us</span></h3> 
			<?php 
				$sql  = mysql_query("SELECT * FROM modul WHERE id_modul='43'");
				$r    = mysql_fetch_array($sql);
				echo '
				<article class="entry-item">
					<div class="entry-thumb">
					<img src="files/'.$r[gambar].'" alt="'.$r[judul].'" title="'.$r[judul].'" />
					</div>
				</article><br>
				';
				echo $r['static_content']; 

			?> 
		</div>
		</div>
	</div>
	<?php include"kanan.php"; ?>
	
</div><!--main-content-->