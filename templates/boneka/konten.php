<?php
// Halaman utama (Home)
if ($_GET[module]=='home'){
	include "modul/home.php";
}
elseif ($_GET[module]=='semuaproduk'){
	include "modul/produk.php";
}
//Hubungi Kami
elseif ($_GET[module]=='hubungikami'){
	include "modul/hubungi.php";
}
//Detail Produk
elseif ($_GET[module]=='detailproduk'){
	include "modul/detailproduk.php";
}
// Modul profil
elseif ($_GET[module]=='profilkami'){
	include "modul/profil.php";
}
elseif ($_GET[module]=='login'){
	include "modul/login.php";
}
elseif ($_GET[module]=='forgot-password'){
	include "modul/forget.php";
}
elseif ($_GET[module]=='reset'){
	include "modul/reset_pass.php";
}
elseif ($_GET[module]=='proses-reset'){
	include "modul/proses_repass.php";
}
elseif ($_GET[module]=='account'){
	include "modul/account.php";
}
elseif ($_GET[module]=='history'){
	include "modul/history.php";
}
elseif ($_GET[module]=='detailkategori'){
  include "modul/detailkategori.php";
}
elseif ($_GET[module]=='kategori'){
  include "modul/kategori.php";
}
elseif ($_GET[module]=='kategoriproduk'){
  include "modul/kategoriproduk.php";
}
elseif ($_GET[module]=='subkategoriproduk'){
  include "modul/subkategoriproduk.php";
}
elseif ($_GET[module]=='keranjangbelanja'){
	include "modul/cart.php";
}
elseif ($_GET[module]=='artikel'){
	include "modul/berita.php";
}
elseif ($_GET[module]=='detailartikel'){
	include "modul/detailartikel.php";
}
elseif ($_GET[module]=='halamanstatis'){
	include "modul/halamanstatis.php";
}
// Modul hasil pencarian produk 
elseif ($_GET['module']=='hasilcari'){
    include "modul/cari.php";
}
// Modul checkout
elseif ($_GET['module']=='cekout'){
    include "modul/checkout.php";
}
// Modul Konfirmasi
elseif ($_GET['module']=='konfirmasi'){
    include "modul/konfirmasi.php";
}

//Modul Custom Upload
elseif ($_GET['module']=='custom') {
	include "modul/custom.php";
}

?>
