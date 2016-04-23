<?php
include "../config/koneksi.php";

if ($_SESSION[leveluser]=='admin'){
  $sql=mysql_query("select * from modul where aktif='Y' order by urutan");
}
elseif($_SESSION[leveluser]=="user"){
  $sql=mysql_query("select * from modul where status='user' and aktif='Y' order by urutan"); 
}else{
	$sql=mysql_query("select * from modul where id_modul IN('49','67') order by urutan");
}
while ($m=mysql_fetch_array($sql)){  
	$icon = array(
		'Ganti Password' => 'icon-lock',
		'Profil' => 'icon-edit',
		'Profil Website' => 'icon-edit',
		'Edit Profilmu' => 'icon-edit',
		'Manajemen Modul' => 'icon-cog',
		'Keranjang Belanja' => 'icon-shopping-cart',
		'Kategori' => 'icon-tags',
		'Kategori Produk' => 'icon-tags',
		'Identitas Website' => 'icon-pencil',
		'Produk' => 'icon-th-large',
		'Order' => 'icon-shopping-cart',
		'Ongkos Kirim' => 'icon-plane',
		'Cara Pembelian' => 'icon-exclamation-sign',
		'Hubungi Kami' => 'icon-envelope',
		'Email' => 'icon-envelope',
		'Banner' => 'icon-flag',
		'Laporan' => 'icon-list-alt',
		'Media Sosial' => 'icon-comment',
		'Menu' => 'icon-list-alt',
		'Sub Menu' => 'icon-list',
		'Sub Kategori Produk 2' => 'icon-list',
		'Menu Footer' => 'icon-list',
		'User' => 'icon-comment',
		'Tambah Admin' => 'icon-comment',
		'Download Katalog' => 'icon-download-alt',
		'Slider' => 'icon-book',
		'Review Produk' => 'icon-star',
		'Partner' => 'icon-star',
		'Konfirmasi' => 'icon-star',
		'Artikel' => 'icon-file',
		'News' => 'icon-file',
		'Event' => 'icon-star',
		'Album' => 'icon-picture',
		'Gallery' => 'icon-picture',
		'Halaman Statis' => 'icon-file'
	); 
	if ($m[nama_modul] == 'Produk'){
		echo '<li><a class="ajax-link" href="'.$m[link].'"><i class="'.$icon[$m[nama_modul]].'"></i><span class="hidden-tablet"> '.$m[nama_modul].'</span>&nbsp;<span id="notifikasiproduk"></span></a></li>';
	}else if ($m[nama_modul] == 'Keranjang Belanja'){
		echo '<li><a class="ajax-link" href="'.$m[link].'"><i class="'.$icon[$m[nama_modul]].'"></i><span class="hidden-tablet"> '.$m[nama_modul].'</span><span id="notifikasichart"></span></a></li>';
	} else{
		if($icon[$m[nama_modul]] == ''){
			$icon[$m[nama_modul]] = 'icon-cog';
		}
		echo '<li><a class="ajax-link" href="'.$m[link].'"><i class="'.$icon[$m[nama_modul]].'"></i><span class="hidden-tablet"> '.$m[nama_modul].'</span></a></li>';
	}
}
?>
