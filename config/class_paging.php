<?php
// class paging untuk halaman administrator
class Paging{
// Fungsi untuk mencek halaman dan posisi data
function cariPosisi($batas){
if(empty($_GET[halaman])){
	$posisi=0;
	$_GET[halaman]=1;
}
else{
	$posisi = ($_GET[halaman]-1) * $batas;
}
return $posisi;
}

// Fungsi untuk menghitung total halaman
function jumlahHalaman($jmldata, $batas){
$jmlhalaman = ceil($jmldata/$batas);
return $jmlhalaman;
}

// Fungsi untuk link halaman 1,2,3 (untuk admin)
function navHalaman($halaman_aktif, $jmlhalaman){
$link_halaman = "";

// Link halaman 1,2,3, ...
for ($i=1; $i<=$jmlhalaman; $i++){
  if ($i == $halaman_aktif){
    $link_halaman .= "<b>$i</b> | ";
  }
else{
  $link_halaman .= "<li><a href=$_SERVER[PHP_SELF]?module=$_GET[module]&halaman=$i>$i</a></li> | ";
}
$link_halaman .= " ";
}
return $link_halaman;
}
}

// class paging untuk halaman kategori
class PagingAccount{
	// Fungsi untuk mencek halaman dan posisi data
	function cariPosisi($batas){
		if(empty($_GET['halhistory'])){
			$posisi=0;
			$_GET['halhistory']=1;
		}
		else{
			$posisi = ($_GET['halhistory']-1) * $batas;
		}
		return $posisi;
	}

	// Fungsi untuk menghitung total halaman
	function jumlahHalaman($jmldata, $batas){
		$jmlhalaman = ceil($jmldata/$batas);
		return $jmlhalaman;
	}

	// Fungsi untuk link halaman 1,2,3
	function navHalaman($halaman_aktif, $jmlhalaman){
		$link_halaman = "";

		// Link ke halaman pertama (first) dan sebelumnya (prev)
		if($halaman_aktif > 1){
			$prev = $halaman_aktif-1;
			$link_halaman .= " <li><a href='halhistory-1.html'><<</a></li>
							 <li><a href='halhistory-$prev.html'>&lt;</a></li>";
		}
		else{
			$link_halaman .= " ";
		}

		// Link halaman 1,2,3, …
		$angka = ($halaman_aktif > 3 ? " <li><a href='#'>...</a></li>" : " ");
			for ($i=$halaman_aktif-2; $i<$halaman_aktif; $i++){
				if ($i < 1)
				continue;
				$angka .= " <li><a href='halhistory-$i.html'>$i</a></li>  ";
			}
			$angka .= "<li class='active'><a href='#'> $halaman_aktif </a></li>";

			for($i=$halaman_aktif+1; $i<($halaman_aktif+3); $i++){
				if($i > $jmlhalaman)
				break;
				$angka .= " <li><a href='halhistory-$i.html'>$i</a></li> ";
			}
			$angka .= ($halaman_aktif+2<$jmlhalaman ? " <li><a href='#'>...</a></li>
			<li><a href='halhistory-$jmlhalaman.html'>$jmlhalaman</a></li>" : " ");

			$link_halaman .= "$angka";

			// Link ke halaman berikutnya (Next) dan terakhir (>>)
			if($halaman_aktif < $jmlhalaman){
				$next = $halaman_aktif+1;
				$link_halaman .= " <li><a href='halhistory-$next.html'>&gt;</a></li>
					<li><a href='halhistory-$jmlhalaman.html'>>></a></li>";
			}
			else{
				$link_halaman .= " ";
			}
		return $link_halaman;
	}
}

// class paging untuk halaman kategori
class PagingKate{
	// Fungsi untuk mencek halaman dan posisi data
	function cariPosisi($batas){
		if(empty($_GET['halkategori'])){
			$posisi=0;
			$_GET['halkategori']=1;
		}
		else{
			$posisi = ($_GET['halkategori']-1) * $batas;
		}
		return $posisi;
	}

	// Fungsi untuk menghitung total halaman
	function jumlahHalaman($jmldata, $batas){
		$jmlhalaman = ceil($jmldata/$batas);
		return $jmlhalaman;
	}

	// Fungsi untuk link halaman 1,2,3
	function navHalaman($halaman_aktif, $jmlhalaman){
		$link_halaman = "";

		// Link ke halaman pertama (first) dan sebelumnya (prev)
		if($halaman_aktif > 1){
			$prev = $halaman_aktif-1;
			$link_halaman .= " <li><a href='halkategori-$_GET[id]-1.html'><<</a></li>
							 <li><a href='halkategori-$_GET[id]-$prev.html'>&lt;</a></li>";
		}
		else{
			$link_halaman .= " ";
		}

		// Link halaman 1,2,3, …
		$angka = ($halaman_aktif > 3 ? " <li><a href='#'>...</a></li>" : " ");
			for ($i=$halaman_aktif-2; $i<$halaman_aktif; $i++){
				if ($i < 1)
				continue;
				$angka .= " <li><a href='halkategori-$_GET[id]-$i.html'>$i</a></li>  ";
			}
			$angka .= "<li class='active'><a href='#'> $halaman_aktif </a></li>";

			for($i=$halaman_aktif+1; $i<($halaman_aktif+3); $i++){
				if($i > $jmlhalaman)
				break;
				$angka .= " <li><a href='halkategori-$_GET[id]-$i.html'>$i</a></li> ";
			}
			$angka .= ($halaman_aktif+2<$jmlhalaman ? " <li><a href='#'>...</a></li>
			<li><a href='halkategori-$_GET[id]-$jmlhalaman.html'>$jmlhalaman</a></li>" : " ");

			$link_halaman .= "$angka";

			// Link ke halaman berikutnya (Next) dan terakhir (>>)
			if($halaman_aktif < $jmlhalaman){
				$next = $halaman_aktif+1;
				$link_halaman .= " <li><a href='halkategori-$_GET[id]-$next.html'>&gt;</a></li>
					<li><a href='halkategori-$_GET[id]-$jmlhalaman.html'>>></a></li>";
			}
			else{
				$link_halaman .= " ";
			}
		return $link_halaman;
	}
}
// class paging untuk halaman kategori
class PagingKateProduk{
	// Fungsi untuk mencek halaman dan posisi data
	function cariPosisi($batas){
		if(empty($_GET['halkategoriproduk'])){
			$posisi=0;
			$_GET['halkategoriproduk']=1;
		}
		else{
			$posisi = ($_GET['halkategoriproduk']-1) * $batas;
		}
		return $posisi;
	}

	// Fungsi untuk menghitung total halaman
	function jumlahHalaman($jmldata, $batas){
		$jmlhalaman = ceil($jmldata/$batas);
		return $jmlhalaman;
	}

	// Fungsi untuk link halaman 1,2,3
	function navHalaman($halaman_aktif, $jmlhalaman){
		$link_halaman = "";

		// Link ke halaman pertama (first) dan sebelumnya (prev)
		if($halaman_aktif > 1){
			$prev = $halaman_aktif-1;
			$link_halaman .= " <li><a href='halkategoriproduk-$_GET[id]-1.html'><<</a></li>
							 <li><a href='halkategoriproduk-$_GET[id]-$prev.html'>&lt;</a></li>";
		}
		else{
			$link_halaman .= " ";
		}

		// Link halaman 1,2,3, …
		$angka = ($halaman_aktif > 3 ? " <li><a href='#'>...</a></li>" : " ");
			for ($i=$halaman_aktif-2; $i<$halaman_aktif; $i++){
				if ($i < 1)
				continue;
				$angka .= " <li><a href='halkategoriproduk-$_GET[id]-$i.html'>$i</a></li>  ";
			}
			$angka .= "<li class='active'><a href='#'> $halaman_aktif </a></li>";

			for($i=$halaman_aktif+1; $i<($halaman_aktif+3); $i++){
				if($i > $jmlhalaman)
				break;
				$angka .= " <li><a href='halkategoriproduk-$_GET[id]-$i.html'>$i</a></li> ";
			}
			$angka .= ($halaman_aktif+2<$jmlhalaman ? " <li><a href='#'>...</a></li>
			<li><a href='halkategoriproduk-$_GET[id]-$jmlhalaman.html'>$jmlhalaman</a></li>" : " ");

			$link_halaman .= "$angka";

			// Link ke halaman berikutnya (Next) dan terakhir (>>)
			if($halaman_aktif < $jmlhalaman){
				$next = $halaman_aktif+1;
				$link_halaman .= " <li><a href='halkategoriproduk-$_GET[id]-$next.html'>&gt;</a></li>
					<li><a href='halkategoriproduk-$_GET[id]-$jmlhalaman.html'>>></a></li>";
			}
			else{
				$link_halaman .= " ";
			}
		return $link_halaman;
	}
}

// class paging untuk halaman kategori
class PagingsubKateProduk{
	// Fungsi untuk mencek halaman dan posisi data
	function cariPosisi($batas){
		if(empty($_GET['halsubkategoriproduk'])){
			$posisi=0;
			$_GET['halsubkategoriproduk']=1;
		}
		else{
			$posisi = ($_GET['halsubkategoriproduk']-1) * $batas;
		}
		return $posisi;
	}

	// Fungsi untuk menghitung total halaman
	function jumlahHalaman($jmldata, $batas){
		$jmlhalaman = ceil($jmldata/$batas);
		return $jmlhalaman;
	}

	// Fungsi untuk link halaman 1,2,3
	function navHalaman($halaman_aktif, $jmlhalaman){
		$link_halaman = "";

		// Link ke halaman pertama (first) dan sebelumnya (prev)
		if($halaman_aktif > 1){
			$prev = $halaman_aktif-1;
			$link_halaman .= " <li><a href='halsubkategoriproduk-$_GET[id]-1.html'><<</a></li>
							 <li><a href='halsubkategoriproduk-$_GET[id]-$prev.html'>&lt;</a></li>";
		}
		else{
			$link_halaman .= " ";
		}

		// Link halaman 1,2,3, …
		$angka = ($halaman_aktif > 3 ? " <li><a href='#'>...</a></li>" : " ");
			for ($i=$halaman_aktif-2; $i<$halaman_aktif; $i++){
				if ($i < 1)
				continue;
				$angka .= " <li><a href='halsubkategoriproduk-$_GET[id]-$i.html'>$i</a></li>  ";
			}
			$angka .= "<li class='active'><a href='#'> $halaman_aktif </a></li>";

			for($i=$halaman_aktif+1; $i<($halaman_aktif+3); $i++){
				if($i > $jmlhalaman)
				break;
				$angka .= " <li><a href='halsubkategoriproduk-$_GET[id]-$i.html'>$i</a></li> ";
			}
			$angka .= ($halaman_aktif+2<$jmlhalaman ? " <li><a href='#'>...</a></li>
			<li><a href='halsubkategoriproduk-$_GET[id]-$jmlhalaman.html'>$jmlhalaman</a></li>" : " ");

			$link_halaman .= "$angka";

			// Link ke halaman berikutnya (Next) dan terakhir (>>)
			if($halaman_aktif < $jmlhalaman){
				$next = $halaman_aktif+1;
				$link_halaman .= " <li><a href='halsubkategoriproduk-$_GET[id]-$next.html'>&gt;</a></li>
					<li><a href='halsubkategoriproduk-$_GET[id]-$jmlhalaman.html'>>></a></li>";
			}
			else{
				$link_halaman .= " ";
			}
		return $link_halaman;
	}
}

// class paging untuk halaman pencarian 
class Pagingcari{
// Fungsi untuk mencek halaman dan posisi data
function cariPosisi($batas){
if(empty($_GET[halcari])){
	$posisi=0;
	$_GET[halcari]=1;
}
else{
	$posisi = ($_GET[halcari]-1) * $batas;
}
return $posisi;
}

// Fungsi untuk menghitung total halaman
function jumlahHalaman($jmldata, $batas){
$jmlhalaman = ceil($jmldata/$batas);
return $jmlhalaman;
}

// Fungsi untuk link halaman 1,2,3 
function navHalaman($halaman_aktif, $jmlhalaman){
$link_halaman = "";

// Link halaman 1,2,3, ...
for ($i=1; $i<=$jmlhalaman; $i++){
  if ($i == $halaman_aktif){
    $link_halaman .= "<b>$i</b>";
  }
else{
  $link_halaman .= "<li><a href=halcari-$i.html>$i</a></li>";
}
$link_halaman .= " ";
}
return $link_halaman;
}
}

// class paging untuk produk
class Paging2{
	// Fungsi untuk mencek halaman dan posisi data
	function cariPosisi($batas){
		if(empty($_GET['halproduk'])){
			$posisi=0;
			$_GET['halproduk']=1;
		}
		else{
			$posisi = ($_GET['halproduk']-1) * $batas;
		}
		return $posisi;
	}

	// Fungsi untuk menghitung total halaman
	function jumlahHalaman($jmldata, $batas){
		$jmlhalaman = ceil($jmldata/$batas);
		return $jmlhalaman;
	}

	// Fungsi untuk link halaman 1,2,3
	function navHalaman($halaman_aktif, $jmlhalaman){
		$link_halaman = "";

		// Link ke halaman pertama (first) dan sebelumnya (prev)
		if($halaman_aktif > 1){
			$prev = $halaman_aktif-1;
			$link_halaman .= " <li><a href='halproduk-1.html'><<</a></li>
							 <li><a href='halproduk-$prev.html'>&lt;</a></li>";
		}
		else{
			$link_halaman .= " ";
		}

		// Link halaman 1,2,3, …
		$angka = ($halaman_aktif > 3 ? " <li><span> ... </span></li>" : " ");
			for ($i=$halaman_aktif-2; $i<$halaman_aktif; $i++){
				if ($i < 1)
				continue;
				$angka .= " <li><a href='halproduk-$i.html'>$i</a></li>  ";
			}
			$angka .= "<li class='active'><a href='#'> $halaman_aktif </a></li>";

			for($i=$halaman_aktif+1; $i<($halaman_aktif+3); $i++){
				if($i > $jmlhalaman)
				break;
				$angka .= " <li><a href='halproduk-$i.html'>$i</a></li> ";
			}
			$angka .= ($halaman_aktif+2<$jmlhalaman ? " <li><a href='#'>...</a></li>
			<li><a href='halproduk-$jmlhalaman.html'>$jmlhalaman</a></li>" : " ");

			$link_halaman .= "$angka";

			// Link ke halaman berikutnya (Next) dan terakhir (>>)
			if($halaman_aktif < $jmlhalaman){
				$next = $halaman_aktif+1;
				$link_halaman .= " <li><a href='halproduk-$next.html'>&gt;</a></li>
					<li><a href='halproduk-$jmlhalaman.html'>>></a></li>";
			}
			else{
				$link_halaman .= " ";
			}
		return $link_halaman;
	}
}
// class paging untuk halaman kategori
class PagingArtikel{
	// Fungsi untuk mencek halaman dan posisi data
	function cariPosisi($batas){
		if(empty($_GET['halartikel'])){
			$posisi=0;
			$_GET['halartikel']=1;
		}
		else{
			$posisi = ($_GET['halartikel']-1) * $batas;
		}
		return $posisi;
	}

	// Fungsi untuk menghitung total halaman
	function jumlahHalaman($jmldata, $batas){
		$jmlhalaman = ceil($jmldata/$batas);
		return $jmlhalaman;
	}

	// Fungsi untuk link halaman 1,2,3
	function navHalaman($halaman_aktif, $jmlhalaman){
		$link_halaman = "";

		// Link ke halaman pertama (first) dan sebelumnya (prev)
		if($halaman_aktif > 1){
			$prev = $halaman_aktif-1;
			$link_halaman .= " 
							 <li> <li><a class='prev page-numbers' href='halartikel-$prev.html'>Previous</a></li></li>";
		}
		else{
			$link_halaman .= " ";
		}

		// Link halaman 1,2,3, …
		$angka = ($halaman_aktif > 3 ? " <span>...." : " ");
			for ($i=$halaman_aktif-2; $i<$halaman_aktif; $i++){
				if ($i < 1)
				continue;
				$angka .= " <li><li><a class='page-numbers' href='halartikel-$i.html'>$i</a></li></li>  ";
			}
			$angka .= "<li><li class='active'><a href='#'> $halaman_aktif </a></li></li>";

			for($i=$halaman_aktif+1; $i<($halaman_aktif+3); $i++){
				if($i > $jmlhalaman)
				break;
				$angka .= " <li><li><a class='page-numbers' href='halartikel-$i.html'>$i</a></li></li> ";
			}
			$angka .= ($halaman_aktif+2<$jmlhalaman ? " <li><span class='page-numbers dots' href='#'>...</span></li>
			<li><li><a class='page-numbers' href='halartikel-$jmlhalaman.html'>$jmlhalaman</a></li></li>" : " ");

			$link_halaman .= "$angka";

			// Link ke halaman berikutnya (Next) dan terakhir (>>)
			if($halaman_aktif < $jmlhalaman){
				$next = $halaman_aktif+1;
				$link_halaman .= " <li style='margin-right: 0px;'><li><a class='next page-numbers' href='halartikel-$next.html'>Next</a></li></li>
					";
			}
			else{
				$link_halaman .= " ";
			}
		return $link_halaman;
	}
}

class PagingEvent{
	// Fungsi untuk mencek halaman dan posisi data
	function cariPosisi($batas){
		if(empty($_GET['halevent'])){
			$posisi=0;
			$_GET['halevent']=1;
		}
		else{
			$posisi = ($_GET['halevent']-1) * $batas;
		}
		return $posisi;
	}

	// Fungsi untuk menghitung total halaman
	function jumlahHalaman($jmldata, $batas){
		$jmlhalaman = ceil($jmldata/$batas);
		return $jmlhalaman;
	}

	// Fungsi untuk link halaman 1,2,3
	function navHalaman($halaman_aktif, $jmlhalaman){
		$link_halaman = "";

		// Link ke halaman pertama (first) dan sebelumnya (prev)
		if($halaman_aktif > 1){
			$prev = $halaman_aktif-1;
			$link_halaman .= " 
							 <li><li><a class='prev page-numbers' href='halevent-$prev.html'>Preview</a></li></li>";
		}
		else{
			$link_halaman .= " ";
		}

		// Link halaman 1,2,3, …
		$angka = ($halaman_aktif > 3 ? " <span>...." : " ");
			for ($i=$halaman_aktif-2; $i<$halaman_aktif; $i++){
				if ($i < 1)
				continue;
				$angka .= " <li><li><a class='page-numbers' href='halevent-$i.html'>$i</a></li></li>  ";
			}
			$angka .= "<li><li class='active'><a href='#'> $halaman_aktif </a></li></li>";

			for($i=$halaman_aktif+1; $i<($halaman_aktif+3); $i++){
				if($i > $jmlhalaman)
				break;
				$angka .= " <li><li><a class='page-numbers' href='halevent-$i.html'>$i</a></li></li> ";
			}
			$angka .= ($halaman_aktif+2<$jmlhalaman ? " <li><span class='page-numbers dots' href='#'>...</span></li>
			<li><li><a class='page-numbers' href='halevent-$jmlhalaman.html'>$jmlhalaman</a></li></li>" : " ");

			$link_halaman .= "$angka";

			// Link ke halaman berikutnya (Next) dan terakhir (>>)
			if($halaman_aktif < $jmlhalaman){
				$next = $halaman_aktif+1;
				$link_halaman .= " <li><li><a class='next page-numbers' href='halevent-$next.html'>Next</a></li></li>
					";
			}
			else{
				$link_halaman .= " ";
			}
		return $link_halaman;
	}
}

// class paging untuk halaman 
class PagingAlbum{
	// Fungsi untuk mencek halaman dan posisi data
	function cariPosisi($batas){
		if(empty($_GET['halalbum'])){
			$posisi=0;
			$_GET['halalbum']=1;
		}
		else{
			$posisi = ($_GET['halalbum']-1) * $batas;
		}
		return $posisi;
	}

	// Fungsi untuk menghitung total halaman
	function jumlahHalaman($jmldata, $batas){
		$jmlhalaman = ceil($jmldata/$batas);
		return $jmlhalaman;
	}

	// Fungsi untuk link halaman 1,2,3
	function navHalaman($halaman_aktif, $jmlhalaman){
		$link_halaman = "";

		// Link ke halaman pertama (first) dan sebelumnya (prev)
		if($halaman_aktif > 1){
			$prev = $halaman_aktif-1;
			$link_halaman .= " <li><a href='halalbum-1.html'><<</a></li>
							 <li><a href='halalbum-$prev.html'>&lt;</a></li>";
		}
		else{
			$link_halaman .= " ";
		}

		// Link halaman 1,2,3, …
		$angka = ($halaman_aktif > 3 ? " <li><a href='#'>...</a></li>" : " ");
			for ($i=$halaman_aktif-2; $i<$halaman_aktif; $i++){
				if ($i < 1)
				continue;
				$angka .= " <li><a href='halalbum-$i.html'>$i</a></li>  ";
			}
			$angka .= "<li class='active'><a href='#'> $halaman_aktif </a></li>";

			for($i=$halaman_aktif+1; $i<($halaman_aktif+3); $i++){
				if($i > $jmlhalaman)
				break;
				$angka .= " <li><a href='halalbum-$i.html'>$i</a></li> ";
			}
			$angka .= ($halaman_aktif+2<$jmlhalaman ? " <li><a href='#'>...</a></li>
			<li><a href='halalbum-$jmlhalaman.html'>$jmlhalaman</a></li>" : " ");

			$link_halaman .= "$angka";

			// Link ke halaman berikutnya (Next) dan terakhir (>>)
			if($halaman_aktif < $jmlhalaman){
				$next = $halaman_aktif+1;
				$link_halaman .= " <li><a href='halalbum-$next.html'>&gt;</a></li>
					<li><a href='halalbum-$jmlhalaman.html'>>></a></li>";
			}
			else{
				$link_halaman .= " ";
			}
		return $link_halaman;
	}
}
// class paging untuk halaman 
class PagingGal{
	// Fungsi untuk mencek halaman dan posisi data
	function cariPosisi($batas){
		if(empty($_GET['halgallery'])){
			$posisi=0;
			$_GET['halgallery']=1;
		}
		else{
			$posisi = ($_GET['halgallery']-1) * $batas;
		}
		return $posisi;
	}

	// Fungsi untuk menghitung total halaman
	function jumlahHalaman($jmldata, $batas){
		$jmlhalaman = ceil($jmldata/$batas);
		return $jmlhalaman;
	}

	// Fungsi untuk link halaman 1,2,3
	function navHalaman($halaman_aktif, $jmlhalaman){
		$link_halaman = "";

		// Link ke halaman pertama (first) dan sebelumnya (prev)
		if($halaman_aktif > 1){
			$prev = $halaman_aktif-1;
			$link_halaman .= " <li><a href='halgallery-$_GET[id]-1.html'><<</a></li>
							 <li><a href='halgallery-$_GET[id]-$prev.html'>&lt;</a></li>";
		}
		else{
			$link_halaman .= " ";
		}

		// Link halaman 1,2,3, …
		$angka = ($halaman_aktif > 3 ? " <li><a href='#'>...</a></li>" : " ");
			for ($i=$halaman_aktif-2; $i<$halaman_aktif; $i++){
				if ($i < 1)
				continue;
				$angka .= " <li><a href='halgallery-$_GET[id]-$i.html'>$i</a></li>  ";
			}
			$angka .= "<li class='active'><a href='#'> $halaman_aktif </a></li>";

			for($i=$halaman_aktif+1; $i<($halaman_aktif+3); $i++){
				if($i > $jmlhalaman)
				break;
				$angka .= " <li><a href='halgallery-$_GET[id]-$i.html'>$i</a></li> ";
			}
			$angka .= ($halaman_aktif+2<$jmlhalaman ? " <li><a href='#'>...</a></li>
			<li><a href='halgallery-$_GET[id]-$jmlhalaman.html'>$jmlhalaman</a></li>" : " ");

			$link_halaman .= "$angka";

			// Link ke halaman berikutnya (Next) dan terakhir (>>)
			if($halaman_aktif < $jmlhalaman){
				$next = $halaman_aktif+1;
				$link_halaman .= " <li><a href='halgallery-$_GET[id]-$next.html'>&gt;</a></li>
					<li><a href='halgallery-$_GET[id]-$jmlhalaman.html'>>></a></li>";
			}
			else{
				$link_halaman .= " ";
			}
		return $link_halaman;
	}
}

?>
