<?php
include "../config/koneksi.php";
include "../config/library.php";
include "../config/fungsi_indotgl.php";
include "../config/fungsi_combobox.php";
include "../config/class_paging.php";
include "../config/fungsi_rupiah.php";

// Bagian Home
if ($_GET[module]=='home'){
  if ($_SESSION['leveluser']=='admin' || $_SESSION['leveluser']=='moderator' || $_SESSION['leveluser']=='user'){
	echo '
			<div>
				<ul class="breadcrumb">
					<li>
						<a href="#">Home</a> <span class="divider">/</span>
					</li>
					<li>
						<a href="#">Dashboard</a>
					</li>
				</ul>
			</div>
			
			<div class="row-fluid">
				<div class="box span12">
					<div class="box-header well">
						<h2><i class="icon-info-sign"></i> Selamat Datang</h2>
						<div class="box-icon">
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
							<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<p>Hai <b>'.$_SESSION[namalengkap].'</b>, selamat datang di halaman ini.<br> Silahkan klik menu pilihan yang berada 
						di sebelah kiri untuk mengelola content website.</p>
						<p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>
						<p align=right>Login : '.$hari_ini.', '.tgl_indo(date("Y m d")).' | '.date("H:i:s").' WIB</p>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
	
	';
  }
}

// Bagian Modul
elseif ($_GET[module]=='modul'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_modul/modul.php";
  }
}

// Bagian identitas
elseif ($_GET[module]=='identitas'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_identitas/identitas.php";
  }
}
// Bagian Kategori
elseif ($_GET[module]=='kategori'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_kategori/kategori.php";
  }
}
// Bagian subKategori
elseif ($_GET[module]=='subkategori'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_subkategori/subkategori.php";
  }
}
// Bagian Produk
elseif ($_GET[module]=='produk'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_produk/produk.php";
  }
}
// Bagian sosial
elseif ($_GET[module]=='sosial'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_sosial/sosial.php";
  }
}

// Bagian Profil
elseif ($_GET[module]=='profil'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_profil/profil.php";
  }
}

elseif ($_GET[module]=='profilmu'){
  if ($_SESSION['leveluser']=='admin' || $_SESSION['leveluser']=='user'){
    include "modul/mod_profilmu/profilmu.php";
  }
}

// Bagian 
elseif ($_GET[module]=='hubungi'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_hubungi/hubungi.php";
  }
}

// Bagian Banner
elseif ($_GET[module]=='banner'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_banner/banner.php";
  }
}

// Bagian Password
elseif ($_GET[module]=='password'){
  if ($_SESSION['leveluser']=='admin' || $_SESSION['leveluser']=='user' || $_SESSION['leveluser']=='moderator'){
    include "modul/mod_password/password.php";
  }
}

// Bagian Laporan
elseif ($_GET[module]=='laporan'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_laporan/laporan.php";
  }
}
// Bagian Album
elseif ($_GET[module]=='album'){
  if ($_SESSION['leveluser']=='admin' || $_SESSION['leveluser']=='user'){
    include "modul/mod_album/album.php";
  }
}
elseif ($_GET[module]=='gallery'){
  if ($_SESSION['leveluser']=='admin' || $_SESSION['leveluser']=='user'){
    include "modul/mod_gallery/gallery.php";
  }
}
// Bagian Slider
elseif ($_GET[module]=='slider'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_slider/slider.php";
  }
}
// Bagian Artikel
elseif ($_GET[module]=='artikel'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_artikel/artikel.php";
  }
}
// Bagian Partner
elseif ($_GET[module]=='partner'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_partner/partner.php";
  }
}
// Bagian halaman Statis
elseif ($_GET[module]=='halamanstatis'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_halamanstatis/halamanstatis.php";
  }
}
elseif ($_GET[module]=='albumkategori'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_albumkategori/albumkategori.php";
  }
}
elseif ($_GET[module]=='kategoriproduk'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_kategoriproduk/kategoriproduk.php";
  }
}

elseif ($_GET[module]=='menupengunjung'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_menupengunjung/menupengunjung.php";
  }
}
elseif ($_GET[module]=='submenupengunjung'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_submenupengunjung/submenupengunjung.php";
  }
}
elseif ($_GET[module]=='subsubkategori'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_subsubkategori/subsubkategori.php";
  }
}
elseif ($_GET[module]=='footer'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_footer/footer.php";
  }
}
elseif ($_GET[module]=='stok'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_stok/stok.php";
  }
}
elseif ($_GET[module]=='chart'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_chart/chart.php";
  }
}
elseif ($_GET[module]=='konfirmasi'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_konfirmasi/konfirmasi.php";
  }
}
elseif ($_GET[module]=='email'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_email/email.php";
  }
}
elseif ($_GET[module]=='rekening'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_rekening/rekening.php";
  }
}
elseif ($_GET[module]=='cta'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_cta/cta.php";
  }
}
elseif ($_GET[module]=='users'){
  if ($_SESSION['leveluser']=='moderator'|| $_SESSION['leveluser']=='admin'){
    include "modul/mod_users/users.php";
  }
}
elseif ($_GET[module]=='event'){
  if ($_SESSION['leveluser']=='moderator'|| $_SESSION['leveluser']=='admin'){
    include "modul/mod_event/event.php";
  }
}elseif ($_GET[module]=='footer-promo'){
  if ($_SESSION['leveluser']=='moderator'|| $_SESSION['leveluser']=='admin'){
    include "modul/mod_footer_promo/footer_promo.php";
  }
}
// Apabila modul tidak ditemukan
else{
	echo "
		<div class='alert alert-error'>
			<button type='button' class='close' data-dismiss='alert'><i class='icon-remove'></i></button>
			<strong>Ops..!!!</strong> MODUL BELUM ADA ATAU BELUM LENGKAP
		</div>
	";
}
?>
