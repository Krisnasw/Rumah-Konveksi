-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 04, 2016 at 03:26 PM
-- Server version: 5.5.47-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `boneka_baru`
--

-- --------------------------------------------------------

--
-- Table structure for table `album`
--

CREATE TABLE IF NOT EXISTS `album` (
  `id_album` int(5) NOT NULL AUTO_INCREMENT,
  `jdl_album` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `album_seo` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `gbr_album` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `aktif` enum('Y','N') COLLATE latin1_general_ci NOT NULL DEFAULT 'Y',
  `keterangan` text COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id_album`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `artikel`
--

CREATE TABLE IF NOT EXISTS `artikel` (
  `id_artikel` int(5) NOT NULL AUTO_INCREMENT,
  `id_kategori` int(5) NOT NULL,
  `judul` varchar(50) NOT NULL,
  `artikel_seo` varchar(250) NOT NULL,
  `deskripsi` text NOT NULL,
  `gambar` varchar(100) NOT NULL,
  `tgl_posting` date NOT NULL,
  `dibaca` int(5) NOT NULL,
  PRIMARY KEY (`id_artikel`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `artikel`
--

INSERT INTO `artikel` (`id_artikel`, `id_kategori`, `judul`, `artikel_seo`, `deskripsi`, `gambar`, `tgl_posting`, `dibaca`) VALUES
(1, 3, 'Indonesia Perlu Membangun Karakter', 'indonesia-perlu-membangun-karakter', '<p style="text-align: justify;"><span style="color: #333333;">Wawancara Heppy Trenggono dengan Majalah Ummi</span><br /><span style="color: #333333;">sumber: <a title="beli indonesia" href="http://beliindonesia.com" target="_blank"><span style="color: #333333;">www.beliindonesia.com</span></a></span></p>\r\n<p style="text-align: justify;"><span style="color: #333333;">Pengusaha muda ini pernah bangkrut dengan menanggung utang hingga 62 miliar rupiah justru setelah ia hijrah pada cara bisnis yang islami. Kini dibawah bendera PT. UNITED BALIMUDA, Heppy Trenggono sukses mengelola ratusan hektar kebun kelapa sawit di Sumatera dan Kalimantan, serta menggagas gerakan Beli Indonesia.</span></p>\r\n<p style="text-align: justify;"><strong><span style="color: #333333;">Anda bangkrut justru saat mencoba menerapkan bisnis Islami, pendapat Anda ?</span></strong></p>\r\n<p style="text-align: justify;"><span style="color: #333333;">Ini saya maknai sebagai ujian. Saya pikir Allah ingin tahu apakah saya benar-benar hijrah untuk mencari Dia atau hanya sekedar cara agar bisnis saya jadi bagus? Saya berpikir,kita berbisnis dengan cara semau kita bisa bangkrut juga, tidak sukses juga. Kalau kita bangkrut dalam keadaan kita tidak taat,kan,dua kali rugi jadinya.</span></p>\r\n<p style="text-align: justify;"><strong><span style="color: #333333;">Bagaimana United Balimuda berpera n dalam pembangunan bangsa?</span></strong></p>\r\n<p style="text-align: justify;"><span style="color: #333333;">Keberadaan Balimuda harus menjadi bagian dari pengabdian kita kepada bangsa. Ia harus menjadi tangga kita untuk pulang kembali ke Tuhan kita dan menjadi bagian dari pembangunan karakter bangsa. Kenapa bangsa indonesia hari ini tidak kemana &ndash; mana ? karena kita tidak membangun karakter! Yang kita tahu itu pembangunan merek, bukan pembangunan karakter. Ini sangat berbahaya.</span></p>\r\n<p style="text-align: justify;"><span style="color: #333333;">Karakter itu terdiri dari tiga hal : jati diri,keyakinan, dan nilai yang dibela. Seberapa sadar orang tentang jati dirinya itu membentuk karakter. Jadi, bangsa Indonesia hari ini tidak sadar tentang jati dirinya.Makanya kita tidak sadar ketika berbelanja, ini produk asing atau produk Indonesia?</span></p>\r\n<p style="text-align: justify;"><span style="color: #333333;">Kita juga tidak punya keyakinan bahwa ekonomi Indonesia ditentukan oleh produk Indonesia sendiri, bukan produk asing. Nilai juga begitu, dulu Indonesia merdeka karena ada nilai yang dibela;merdeka. Hari ini apa yang dibela ? tidak ada. Kenapa di Indonesia semua tambang energi itu tidak ada yang milik Indonesia ? karena tidak jelas apa yang dibela.</span></p>\r\n<p style="text-align: justify;"><span style="color: #333333;">Inilah yang diperjuangkan oleh Gerakan Beli Indonesia, membangkitkan karakter bangsa. Artinya membangkitkan tiga hal tersebut. Serta, mengajak masyarakat untuk memakai produk Indonesia selama masih ada.</span></p>\r\n<p style="text-align: justify;"><strong><span style="color: #333333;">Apakah syariah dapat menjadi solusi bagi masalah bangsa ?</span></strong></p>\r\n<p style="text-align: justify;"><span style="color: #333333;">Jelas! Tapi, jangan cuma diucapkan, tidak laku. Jalani saja. Syariah itu bukan sebuah label, bukan merek, bahkan bukan sekadar akad. Syariah itu mentalitas , karakter.</span></p>\r\n<p style="text-align: justify;"><span style="color: #333333;">Umat Islam harus memiliki karakter keislamannya. Sadar tidak kalau kita ini Muslim? Kalau sadar,hiduplah dengan cara Muslim. Saya membangun IIBF (Indonesia Islamic Bisnis Forum) agar umat Islam dalam berbisnis tidak meninggalkan karakternya sebagai Muslim.</span></p>\r\n<p style="text-align: justify;"><span style="color: #333333;">Syariah itu konsekuensi, kalau Anda Muslim, Anda meyakini nilai Islam, maka Anda harusnya membela Islam. Kalau karakter Muslim itu jelas,maka syariah di Indonesia tidak akan menjadi sebuah pertanyaan .</span></p>', '475067maxresdefault.jpg', '2014-07-15', 8),
(2, 3, 'Bangsa Kita Terseret Logika Pembangunan Merk', 'bangsa-kita-terseret-logika-pembangunan-merk', '<p>Surabaya, 15/07/2014. Ketika akan menjadi seorang pejabat public seperti bupati, gubernur atau bahkan presiden, yang pertama sekali dijadikan timnya adalah ahli pembangun opini, apakah itu tim survey, tim publik opini atau apapun namanya yang berhubungan dengan pembangunan citra atau merek. Maka survey yang dilakukan oleh tim itu adalah survey tentang persepsi public terhadap diri sang calon. Dan jika persepsinya masih negatif akan dillakukan berbagai upaya untuk membalikkan keadaan sehingga persepsi publik menjadi positif. Media menjadi alat utama untuk membangun persepsi itu, baik media sosial maupun media mainstream seperti TV, surat kabar ataupun radio.<br /><br />&ldquo;Seharusnya yang disurvey bukan masyarakat tetapi calon pejabatnya itu,&rdquo; kata Pemimpin Gerakan Beli Indonesia, Heppy Trenggono, di depan pengusaha Jawa Timur di Surabaya, Selasa malam. Menurut Heppy, masyarakat itu harus tahu dengan orang yang akan dipilihnya, bagaimana kehidupan sehari-harinya, keluarganya, kebiasaannya, hubungan dengan tetangga, sikapnya pada kaum miskin dan lain-lain yang memberikan gambaran utuh tentang calon itu. Sehingga masyarakat tidak salah memilih karena tahu persis figure orang yang akan dipilihnya. &ldquo;Banyak pejabat terpilih justru karena orang tidak mengenalnya. Di kampungnya sendiri malah tidak ada yang milih. Mengapa? Karena orang tahu dengan karakter aslinya,&rdquo; jelas Heppy.<br /><br />Menjawab pertanyaan salah seorang peserta tentang Indonesia ke depan dengan kondisi yang ada hari ini, Heppy mengatakan bahwa Indonesia masih harus menempuh perjalanan panjang. &ldquo;Hal pokok yang harusnya kita bangun untuk membangun bangsa ini justru kita tinggalkan,&rdquo; tegasnya. Bangsa kita, lanjut Heppy sudah terseret pada logika pembangunan Merek atau Citra. Maraknya orang memasang foto dirinya di baliho dan papan reklame adalah indikasi bahwa kita hanya fokus pada pembangunan merek. &ldquo;Makanya jujur, sederhana , amanah, dan berbagai sifat mulia lainnya itu hanya ada di papan iklan. Tetapi apakah itu semua itu sungguh-sungguh ada dalam diri orangnya? Belum tentu,&rdquo; sambungnya. Ada tidaknya sifat-sifat mulia itu dalam diri orangnya bukan hal penting lagi, karena yang penting masyarakat memiliki persepsi bahwa yang bersangkutan seperti yang ada dalam baliho itu.<br /><br />Apakah kita tidak boleh membangun merek atau citra? &ldquo;Boleh-boleh saja tetapi yang jauh lebih penting dari pembangunan merek adalah pembangunan karakter,&rdquo; kata Heppy. Karakter inilah yang akan menentukan masa depan sebuah bangsa. Jika kita membangun karakter maka citra akan muncul dengan sendiri, tetapi jika hanya membangun merek maka karakter tidak pernah bisa dibangun. Karakter itu harus original tidak bisa dibuat-buat apalagi hanya berbentuk gambar di papan reklame. Runtuhnya karakter kita sebagai sebuah bangsa membuat segala rencana dan rancangan untuk membangun negeri kita tidak ada yang jadi. Jembatan rapuh, jalan hanya seumur jagung, anggaran bocor dimana-mana, ekonomi biaya tinggi, pajak masuk ke lorong gelap, anak muda enggan bekerja keras dan lain-lain yang muaranya itu hanya satu, Karakter yang runtuh.<br /><br />&ldquo;Membangun karakter itu adalah tugas utama seorang pemimpin,&rdquo; jelas Heppy. Dan pemimpin yang bisa membangun karakter hanyalah pemimpin yang berkarakter. Maka, jika ada pertanyaan seberapa cepat Indonesia akan bangkit menjadi bangsa besar, kaya, berprestasi dan disegani? Jawabnya, secepat kita menemukan seorang pemimpin kuat yang berkarakter. Semakin cepat kita menemukannya, maka secepat itu pula kita akan bangkit keluar dari keterpurukan ini. (2as)<br /><br />Sumber Website: www.beliindonesia.com</p>', '321716kuala-lumpur.jpeg', '2014-07-16', 12),
(3, 3, 'Salam dari Amerika untuk IIBF', 'salam-dari-amerika-untuk-iibf', '<p>Wa&rsquo;alaikum salam wr.wb.,<br /><br />Pak Heppy yang saya hormati, terimakasih telah memberikan pencerahan tentang keadaan Indonesia sekarang. Pada dasarnya kami yang di sini juga mempunyai concern yang sama. Semoga di waktu yang akan datang kita bisa bersinergi dan bisa berkontribusi langsung seperti Bapak dan teman2 di IIBF.<br /><br />Kalau Pak Heppy dengan Beli Indonesia maka kita yang di US hampir semua barang yang tersedia di toko adalah made in China (Beli China). Saya berpikir apa yang salah dengan bangsa kita? Saya yakin manufacturing di Indonesia tidak ada kendala?<br /><br />Anggota IMSA tersebar di seluruh US dan Canada. Dan mereka adalah orang-orang berpendidikan (S1, S2, dan S3) dan banyak pakar2 di segala bidang. Saya sebenarnya mempunyai harapan bahwa kita yang ada di sini bisa mempunyai karya nyata untuk membangun Indonesia. Akan tetapi belum tahu bagaimana bentuknya?<br /><br />Karena anggota IMSA tersebar di seluruh US/Canada, salah satu cara kita berkomunikasi adalah dengan melalui internet/telepon. Jadi apabila kita mengadakan pengajian mingguan/bulanan atau presentasi ilmiah atau kegiatan yang lain, maka kita menggunakan teknologi tsb (webinar, gotomeeting, free conference, etc). Kalau Pak Heppy berkenan dan ada waktu, mungkin kita bisa setup teleconference ataupun semacam presentasi tentang informasi-informasi apa saja yang bisa Pak Heppy share dengan kita yang ada di US dan Insya Allah nantinya ada suatu follow entah bagaimana bentuknya guna memajukan di Indonesia.<br /><br />Sekian terlebih dahulu, salam dari kami juga untuk teman-teman yang ada di IIBF.<br /><br />Wassalamu&rsquo;alaikum wr.wb.,<br /><br />Arief Iswanto<br /><br />sumber: website www.beliindonesia.com</p>', '247344img1417986699306.jpg', '2014-09-16', 5),
(4, 3, 'Bebek Goreng Tugu Pahlawan', 'bebek-goreng-tugu-pahlawan', '<p>Bebek Goreng Tugu Pahlawan Surabaya. Bebek Goreng Tugu Pahlawan Surabaya. Bebek Goreng Tugu Pahlawan Surabaya.Bebek Goreng Tugu Pahlawan Surabaya.Bebek Goreng Tugu Pahlawan Surabaya.Bebek Goreng Tugu Pahlawan Surabaya.Bebek Goreng Tugu Pahlawan Surabaya.Bebek Goreng Tugu Pahlawan Surabaya</p>', '556152img-20140813-wa0021.jpg', '2015-01-22', 7),
(5, 1, 'Taman Bungkul Surabaya', 'taman-bungkul-surabaya', '<p>Taman Bungkul Surabaya. Taman Bungkul Surabaya. Taman Bungkul Surabaya. Taman Bungkul Surabaya. Taman Bungkul Surabaya. Taman Bungkul Surabaya. Taman Bungkul Surabaya. Taman Bungkul Surabaya. Taman Bungkul Surabaya.Taman Bungkul Surabaya. Taman Bungkul Surabaya. Taman Bungkul Surabaya</p>', '597259by Adam Plezer on Vimeo-com.jpg', '2015-01-21', 19),
(6, 0, 'Air Mengalir', 'air-mengalir', '<p>sungguh indah sekali pemandangan di depan laut di sanur. sungguh indah sekali pemandangan di depan laut di sanur. sungguh indah sekali pemandangan di depan laut di sanur. sungguh indah sekali pemandangan di depan laut di sanur. sungguh indah sekali pemandangan di depan laut di sanur</p>', '7568961362922670777.jpeg', '2015-08-13', 31);

-- --------------------------------------------------------

--
-- Table structure for table `banner`
--

CREATE TABLE IF NOT EXISTS `banner` (
  `id_banner` int(5) NOT NULL AUTO_INCREMENT,
  `judul` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `url` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `gambar` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `tgl_posting` date NOT NULL,
  PRIMARY KEY (`id_banner`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=13 ;

--
-- Dumping data for table `banner`
--

INSERT INTO `banner` (`id_banner`, `judul`, `url`, `gambar`, `tgl_posting`) VALUES
(10, 'banner', '#', '274x204.jpg', '2015-08-12'),
(11, 'banner', '#', '274x204.jpg', '2015-09-11'),
(12, 'banner', '#', '274x204.jpg', '2015-09-11');

-- --------------------------------------------------------

--
-- Table structure for table `cta`
--

CREATE TABLE IF NOT EXISTS `cta` (
  `id_cta` int(5) NOT NULL AUTO_INCREMENT,
  `pin` varchar(100) NOT NULL,
  `telp_telkomsel` varchar(100) NOT NULL,
  `telp_indosat` varchar(100) NOT NULL,
  `email` varchar(250) NOT NULL,
  PRIMARY KEY (`id_cta`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `cta`
--

INSERT INTO `cta` (`id_cta`, `pin`, `telp_telkomsel`, `telp_indosat`, `email`) VALUES
(1, '54ED3B99', '081233995580', '0816510299', 'info.aksamedia@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `email`
--

CREATE TABLE IF NOT EXISTS `email` (
  `id_email` int(5) NOT NULL,
  `email` varchar(100) NOT NULL,
  `header` text NOT NULL,
  `footer` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `email`
--

INSERT INTO `email` (`id_email`, `email`, `header`, `footer`) VALUES
(1, 'alazazi.costumerservice@gmail.com', '<p>\r\nSelamat Datang Di Al-Azazi.\r\n</p>\r\n<p>\r\nIni adalah FORM ORDER anda\r\n</p>\r\n ', '<p>\r\nTerima Kasih Silakan Transfer Ke Rekening Yeng Telah Kami Tentukan \r\n</p>\r\n<p>\r\nMandiri 135.00.55.222457 Dan BCA 40.90.46.4570 An Fauzi Kurniawan\r\n</p>\r\n<p>\r\nSetelah Itu Lakukan Konfirmasi Pembayaran Melalui Via Web Kami. dengan salin atau klik link berikut :<br>\r\n<a href="http://alazazi.co.id/konfirmasi" target="_blank">http://alazazi.co.id/konfirmasi</a>\r\n<br>\r\nDan Barang Akan Di Proses Setelah Anda Melakukan Konfirmasi Pembayaran \r\n</p>\r\n ');

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE IF NOT EXISTS `event` (
  `id_news` int(11) NOT NULL AUTO_INCREMENT,
  `judul` varchar(255) NOT NULL,
  `artikel_seo` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `tgl_posting` date NOT NULL,
  `dibaca` int(5) NOT NULL,
  PRIMARY KEY (`id_news`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`id_news`, `judul`, `artikel_seo`, `deskripsi`, `gambar`, `tgl_posting`, `dibaca`) VALUES
(3, 'Pengeboran dan Peledakan', 'pengeboran-dan-peledakan', '<p>Pengeboran dan Peledakan</p>', '4305721.jpg', '2015-08-13', 1),
(4, 'Pengolahan Mineral', 'pengolahan-mineral', '<p>Pengolahan Mineral</p>', '9810188.jpg', '2015-08-13', 6);

-- --------------------------------------------------------

--
-- Table structure for table `footer`
--

CREATE TABLE IF NOT EXISTS `footer` (
  `id_footer` int(5) NOT NULL AUTO_INCREMENT,
  `nama_menu` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  PRIMARY KEY (`id_footer`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `footer`
--

INSERT INTO `footer` (`id_footer`, `nama_menu`, `link`) VALUES
(1, 'Cara Pembelian', 'statis-1-cara-pembelian.html'),
(2, 'Tentang Kami', 'statis-2-tentang-kami.html');

-- --------------------------------------------------------

--
-- Table structure for table `footer_promo`
--

CREATE TABLE IF NOT EXISTS `footer_promo` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `judul` varchar(100) NOT NULL,
  `deskripsi` text NOT NULL,
  `url` varchar(100) NOT NULL,
  `gambar` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `footer_promo`
--

INSERT INTO `footer_promo` (`id`, `judul`, `deskripsi`, `url`, `gambar`) VALUES
(10, 'Dapatkah Harga Terbaik', '<p>Toko boneka dengan tampilan mobile site yang nyaman. Dapatkan diskon setiap pembelian selama bulan september.</p>', 'http://getbootstrap.com/', '68817269-x-113.jpg'),
(11, 'Dapatkah Harga Terbaik', '<p>Toko boneka dengan tampilan mobile site yang nyaman. Dapatkan diskon setiap pembelian selama bulan september.</p>', 'http://getbootstrap.com/', '29046689x150.jpg'),
(12, 'Dapatkah Harga Terbaik', '<p>Toko boneka dengan tampilan mobile site yang nyaman. Dapatkan diskon setiap pembelian selama bulan september.</p>', 'http://getbootstrap.com/', '91094326x300.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE IF NOT EXISTS `gallery` (
  `id_gallery` int(5) NOT NULL AUTO_INCREMENT,
  `id_album` int(5) DEFAULT NULL,
  `jdl_gallery` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `gallery_seo` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `gbr_gallery` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `keterangan` text COLLATE latin1_general_ci NOT NULL,
  `id_user` int(5) NOT NULL,
  `tgl` date NOT NULL,
  PRIMARY KEY (`id_gallery`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=21 ;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`id_gallery`, `id_album`, `jdl_gallery`, `gallery_seo`, `gbr_gallery`, `keterangan`, `id_user`, `tgl`) VALUES
(7, NULL, 'Bromo', 'bromo', '541687img-20150512-wa0016.jpg', '<p>menggunakan kamera dengan kualitas baik dan tentunya hasil nya juga terbaik. menggunakan kamera dengan kualitas baik dan tentunya hasil nya juga terbaik</p>', 2, '2015-08-14'),
(8, NULL, 'pemandangan indah', 'pemandangan-indah', '901885img-20140813-wa0017-2.jpg', '<p>menggunakan kamera dengan kualitas baik dan tentunya hasil nya juga terbaik. menggunakan kamera dengan kualitas baik dan tentunya hasil nya juga terbaik</p>', 2, '2015-08-14'),
(9, NULL, 'pemandangan bunga sakura', 'pemandangan-bunga-sakura', '852294wpid-20150110_111526-picsay.jpg', '<p>menggunakan kamera dengan kualitas baik dan tentunya hasil nya juga terbaik. menggunakan kamera dengan kualitas baik dan tentunya hasil nya juga terbaik</p>', 2, '2015-08-14'),
(10, NULL, 'Travel', 'travel', '445159samsung_1_8_sam_0775.jpg', '<p>menggunakan kamera dengan kualitas baik dan tentunya hasil nya juga terbaik. menggunakan kamera dengan kualitas baik dan tentunya hasil nya juga terbaik</p>', 2, '2015-08-14'),
(11, NULL, 'Mahameru', 'mahameru', '737182lavenderfieldsprovenceperancis1.jpg', '<p>menggunakan kamera dengan kualitas baik dan tentunya hasil nya juga terbaik. menggunakan kamera dengan kualitas baik dan tentunya hasil nya juga terbaik</p>', 2, '2015-08-14'),
(12, NULL, 'Surabaya', 'surabaya', '941589gigihiu-featured.jpg', '<p>menggunakan kamera dengan kualitas baik dan tentunya hasil nya juga terbaik. menggunakan kamera dengan kualitas baik dan tentunya hasil nya juga terbaik</p>', 2, '2015-08-14'),
(13, NULL, 'mojokerto', 'mojokerto', '41702214277293317501.jpg', '<p>menggunakan kamera dengan kualitas baik dan tentunya hasil nya juga terbaik. menggunakan kamera dengan kualitas baik dan tentunya hasil nya juga terbaik</p>', 2, '2015-08-14'),
(14, NULL, 'sungai bratang', 'sungai-bratang', '50610387.jpg', '<p>menggunakan kamera dengan kualitas baik dan tentunya hasil nya juga terbaik. menggunakan kamera dengan kualitas baik dan tentunya hasil nya juga terbaik</p>', 2, '2015-08-14'),
(15, NULL, 'Gunung', 'gunung', '1784661362922670777.jpeg', '<p>gunung hebat. gunung hebat.gunung hebat.gunung hebat.gunung hebat.gunung hebatgunung hebatgunung hebatgunung hebatgunung hebat.gunung hebat.gunung hebat.gunung hebat.gunung hebat.gunung hebat.gunung hebat.gunung hebat.gunung hebatgunung hebat.gunung hebat.gunung hebat</p>', 11, '2015-08-16'),
(16, NULL, 'Sungai', 'sungai', '454620by-adam-plezer-on-vimeo-com.jpg', '<p>sungai brantas. sungai brantas. sungai brantas.sungai brantas.sungai brantas.sungai brantas.sungai brantassungai brantas.sungai brantas.sungai brantas.sungai brantas.sungai brantas.sungai brantas.sungai brantas.sungai brantas.sungai brantas.sungai brantassungai brantassungai brantassungai brantas</p>', 11, '2015-08-16'),
(17, NULL, 'Hulu Sungai', 'hulu-sungai', '759368img-20140813-wa0021.jpg', '<p>hulu sungai. hulu sungai. hulu sungai. hulu sungai. hulu sungai.hulu sungai.hulu sungai.hulu sungaihulu sungai.hulu sungai.hulu sungai.hulu sungaihulu sungai.hulu sungai.hulu sungai.hulu sungai.hulu sungai.hulu sungai.hulu sungaihulu sungai.hulu sungai.hulu sungai.hulu sungai.hulu sungaihulu sungai</p>', 12, '2015-08-16'),
(18, NULL, 'Pertama Nusantara', 'pertama-nusantara', '226074kuala-lumpur.jpeg', '<p>permata nusantara. permata nusantara.permata nusantara.permata nusantara.permata nusantarapermata nusantarapermata nusantarapermata nusantara.permata nusantarapermata nusantarapermata nusantara.permata nusantara.permata nusantara.permata nusantara.permata nusantara.permata nusantara</p>', 12, '2015-08-16'),
(19, NULL, 'Ciliwung', 'ciliwung', '268829maxresdefault.jpg', '<p>CIliwung bagus.CIliwung bagus.CIliwung bagus.CIliwung bagus.CIliwung bagusCIliwung bagus.CIliwung bagus.CIliwung bagus.CIliwung bagus.CIliwung bagusCIliwung bagusCIliwung bagus.CIliwung bagus.CIliwung bagus.CIliwung bagus.CIliwung bagus.CIliwung bagus.CIliwung bagus.CIliwung bagus</p>', 12, '2015-08-16'),
(20, NULL, 'Kemah', 'kemah', '730926img1417986699306.jpg', '<p>dengan menggunakan kamera serba bisa, dengan resolusi yg tinggi, dan membuat nyaman penggunanya, merupakan kamera termahal di indonesia saat ini</p>', 12, '2015-08-16');

-- --------------------------------------------------------

--
-- Table structure for table `halamanstatis`
--

CREATE TABLE IF NOT EXISTS `halamanstatis` (
  `id_halaman` int(5) NOT NULL AUTO_INCREMENT,
  `judul` varchar(100) NOT NULL,
  `isi_halaman` text NOT NULL,
  `tgl_posting` date NOT NULL,
  `gambar` varchar(100) NOT NULL,
  PRIMARY KEY (`id_halaman`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `halamanstatis`
--

INSERT INTO `halamanstatis` (`id_halaman`, `judul`, `isi_halaman`, `tgl_posting`, `gambar`) VALUES
(1, 'Pengolahan Mineral', '<p>Pengolahan Mineral</p>', '2014-02-18', 'bcm-indonesia-2.jpg'),
(2, 'Pengeboran dan Peledakan', '<p>Pengeboran dan Peledakan</p>', '2015-01-29', 'bcm-indonesia-31.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `hubungi`
--

CREATE TABLE IF NOT EXISTS `hubungi` (
  `id_hubungi` int(5) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `email` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `subjek` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `pesan` text COLLATE latin1_general_ci NOT NULL,
  `tanggal` date NOT NULL,
  `jam` time NOT NULL,
  PRIMARY KEY (`id_hubungi`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `identitas`
--

CREATE TABLE IF NOT EXISTS `identitas` (
  `id_identitas` int(5) NOT NULL AUTO_INCREMENT,
  `nama_website` varchar(100) NOT NULL,
  `alamat_website` varchar(100) NOT NULL,
  `logo` varchar(100) NOT NULL,
  `meta_deskripsi` varchar(250) NOT NULL,
  `meta_keyword` varchar(250) NOT NULL,
  `favicon` varchar(50) NOT NULL,
  PRIMARY KEY (`id_identitas`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `identitas`
--

INSERT INTO `identitas` (`id_identitas`, `nama_website`, `alamat_website`, `logo`, `meta_deskripsi`, `meta_keyword`, `favicon`) VALUES
(1, 'Boneka Indonesia', 'http://localhost/boneka_baru', '123-x-46.png', '<p>Boneka Indonesia</p>', '<p>Boneka Indonesia</p>', 'bcm-indonesia-icon.ico');

-- --------------------------------------------------------

--
-- Table structure for table `imagesproduk`
--

CREATE TABLE IF NOT EXISTS `imagesproduk` (
  `idImages` int(11) NOT NULL AUTO_INCREMENT,
  `idProduk` int(11) NOT NULL,
  `NamaGambar` varchar(255) NOT NULL,
  PRIMARY KEY (`idImages`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `imagesproduk`
--

INSERT INTO `imagesproduk` (`idImages`, `idProduk`, `NamaGambar`) VALUES
(1, 1, '13250x2502.jpg'),
(2, 2, '48250x2501.jpg'),
(3, 3, '25210x2101.jpg'),
(4, 4, '2250x2503.jpg'),
(5, 4, '48foto-produk.jpg'),
(6, 5, '25210x2102.jpg'),
(7, 6, '44210x2104.jpg'),
(8, 6, '642931073_20141017011346.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE IF NOT EXISTS `kategori` (
  `id_kategori` int(5) NOT NULL AUTO_INCREMENT,
  `nama_kategori` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `kategori_seo` varchar(100) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id_kategori`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`, `kategori_seo`) VALUES
(1, 'Kuliner', 'kuliner'),
(2, 'Revisi', 'revisi'),
(3, 'Event', 'event');

-- --------------------------------------------------------

--
-- Table structure for table `kategoriproduk`
--

CREATE TABLE IF NOT EXISTS `kategoriproduk` (
  `id_kategori` int(5) NOT NULL AUTO_INCREMENT,
  `nama_kategori` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `kategori_seo` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `gambar` varchar(255) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id_kategori`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=21 ;

--
-- Dumping data for table `kategoriproduk`
--

INSERT INTO `kategoriproduk` (`id_kategori`, `nama_kategori`, `kategori_seo`, `gambar`) VALUES
(11, 'Boneka Wisuda', 'boneka-wisuda', ''),
(12, 'Boneka Barbie', 'boneka-barbie', ''),
(13, 'Boneka Manga', 'boneka-manga', ''),
(15, 'Boneka', 'boneka', ''),
(18, 'Boneka DC ', 'boneka-dc-', ''),
(19, 'Boneka Ultraman', 'boneka-ultraman', ''),
(20, 'Boneka lainnya', 'boneka-lainnya', '');

-- --------------------------------------------------------

--
-- Table structure for table `konfirmasi`
--

CREATE TABLE IF NOT EXISTS `konfirmasi` (
  `id_konfirmasi` int(5) NOT NULL AUTO_INCREMENT,
  `id_kustomer` int(5) NOT NULL,
  `kode_konfirmasi` varchar(100) NOT NULL,
  `dari_bank` varchar(100) NOT NULL,
  `ke_bank` varchar(100) NOT NULL,
  `pengirim` varchar(100) NOT NULL,
  `tgl` date NOT NULL,
  `jam` time NOT NULL,
  `jumlah` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  PRIMARY KEY (`id_konfirmasi`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `konfirmasi`
--

INSERT INTO `konfirmasi` (`id_konfirmasi`, `id_kustomer`, `kode_konfirmasi`, `dari_bank`, `ke_bank`, `pengirim`, `tgl`, `jam`, `jumlah`, `status`) VALUES
(5, 1, '3', 'Mandiri', 'Mandiri', 'andhika', '2015-06-08', '10:51:35', '115000', 'Baru Dibayar'),
(6, 1, '6', '13232132132132312', 'Mandiri', 'fauza', '2015-06-14', '20:44:40', '147500', 'Baru Dibayar'),
(7, 1, '10', 'mandiri', 'Mandiri', 'a', '2015-06-17', '15:25:07', '21000', 'Baru Dibayar'),
(8, 1, 'Kode Order 11', '4090464570', 'Mandiri', 'Fauza Kurniawan', '2015-06-25', '01:40:11', '125000', 'Baru Dibayar'),
(9, 1, '11', 'bca', 'Mandiri', 'Fauza Kurniawan', '2015-06-25', '01:41:03', '125000', 'Baru Dibayar'),
(10, 1, '13', '123456789', 'BCA', 'Suyatinah', '2015-06-25', '01:59:31', '197500', 'Baru Dibayar'),
(11, 1, '14', 'bri', 'BCA', 'musyafiah', '2015-06-25', '12:55:26', '285.000', 'Baru Dibayar'),
(12, 1, '15', '4090464570', 'Mandiri', 'Fauzik', '2015-06-26', '02:07:39', '112500', 'Baru Dibayar'),
(13, 1, '9', 'Mandiri', 'Mandiri', 'andhika', '2015-06-27', '09:34:04', '900000', 'Baru Dibayar'),
(14, 1, '16', 'Mandiri', 'Mandiri', 'tri', '2015-06-27', '09:41:38', '125999', 'Baru Dibayar'),
(15, 1, '16', 'Mandiri', 'Mandiri', 'tri', '2015-06-27', '10:02:04', '125999', 'Baru Dibayar'),
(16, 1, '17', '667899980', 'BCA', 'fauzik', '2015-06-27', '21:52:26', '122500', 'Baru Dibayar'),
(17, 1, '24', 'bri', 'BCA', 'musyafiah', '2015-06-29', '12:55:15', 'RP 447.500', 'Baru Dibayar');

-- --------------------------------------------------------

--
-- Table structure for table `kustomer`
--

CREATE TABLE IF NOT EXISTS `kustomer` (
  `id_kustomer` int(5) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `email` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `password` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `tgl_daftar` date NOT NULL,
  `alamat` text COLLATE latin1_general_ci NOT NULL,
  `telp` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `tgl_lahir` date NOT NULL,
  `kota` varchar(255) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id_kustomer`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `kustomer`
--

INSERT INTO `kustomer` (`id_kustomer`, `nama`, `email`, `password`, `tgl_daftar`, `alamat`, `telp`, `tgl_lahir`, `kota`) VALUES
(1, 'Guest', 'andhikatri3@yahoo.com', '09650211', '2015-05-04', 'surabaya', '085646607657', '0000-00-00', ''),
(3, 'Aksa Media', 'amuba88@gmail.com', '123456', '2015-06-11', '', '', '0000-00-00', ''),
(4, 'Nuraini', 'aini.nuru@yahoo.com', 'nuru007', '2015-06-30', 'D/A Warsita\r\nKantor BMKG Ternate (Stasiun Geofisika)\r\nJl. Bali Bunga Kel. Tabona \r\nTernate\r\n97717', '081239711179', '0000-00-00', ''),
(5, 'Vega Rosaria Dewi', 'vherosaria@gmail.com', 'dewirosariavega', '2015-07-01', 'Jalan Cempedak No B2/7 Pondok Jurang Mangu Indah, Pondok Aren, Tangerang Selatan, Banten 15222.', '085782053423', '0000-00-00', '');

-- --------------------------------------------------------

--
-- Table structure for table `mainmenu`
--

CREATE TABLE IF NOT EXISTS `mainmenu` (
  `id_main` int(5) NOT NULL AUTO_INCREMENT,
  `nama_menu` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `link` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `aktif` enum('Y','N') NOT NULL DEFAULT 'Y',
  `adminmenu` enum('Y','N') NOT NULL,
  `no_urut` int(11) NOT NULL,
  PRIMARY KEY (`id_main`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `mainmenu`
--

INSERT INTO `mainmenu` (`id_main`, `nama_menu`, `link`, `aktif`, `adminmenu`, `no_urut`) VALUES
(1, 'Home', './', 'Y', 'N', 1),
(5, 'About', 'profil-kami.html', 'Y', 'N', 2),
(4, 'Jasa Konsultan', '#', 'Y', 'N', 3),
(3, 'Portofolio', 'semua-album.html', 'N', 'N', 4),
(2, 'Gallery', 'gallery', 'Y', 'N', 5),
(6, 'Contact Us', 'hubungi-kami.html', 'Y', 'N', 6),
(7, 'Contact Us', 'hubungi-kami.html', 'N', 'N', 7),
(8, 'Register / Login', 'register.html', 'N', 'N', 8);

-- --------------------------------------------------------

--
-- Table structure for table `modul`
--

CREATE TABLE IF NOT EXISTS `modul` (
  `id_modul` int(5) NOT NULL AUTO_INCREMENT,
  `nama_modul` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `link` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `static_content` text COLLATE latin1_general_ci NOT NULL,
  `gambar` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `status` enum('user','admin') COLLATE latin1_general_ci NOT NULL,
  `aktif` enum('Y','N') COLLATE latin1_general_ci NOT NULL,
  `urutan` int(5) NOT NULL,
  `jam` text COLLATE latin1_general_ci NOT NULL,
  `meta_deskripsi` varchar(200) COLLATE latin1_general_ci NOT NULL,
  `meta_keyword` varchar(200) COLLATE latin1_general_ci NOT NULL,
  `alamat` text COLLATE latin1_general_ci NOT NULL,
  `kontak` text COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id_modul`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=72 ;

--
-- Dumping data for table `modul`
--

INSERT INTO `modul` (`id_modul`, `nama_modul`, `link`, `static_content`, `gambar`, `status`, `aktif`, `urutan`, `jam`, `meta_deskripsi`, `meta_keyword`, `alamat`, `kontak`) VALUES
(18, 'Kategori Produk', '?module=kategoriproduk', '', '', 'user', 'Y', 7, '', '', '', '', ''),
(42, 'Identitas Website', '?module=identitas', '', '', 'admin', 'Y', 4, '', '', '', '', ''),
(10, 'Manajemen Modul', '?module=modul', '', '', 'admin', 'N', 3, '', '', '', '', ''),
(31, 'Kategori', '?module=kategori', '', '', 'admin', 'N', 9, '', '', '', '', ''),
(43, 'Profil Website', '?module=profil', '<p>Boneka Indonesia</p>', 'bcm-indonesia-1.jpg', 'admin', 'Y', 2, '', '', '', '<p>Office HR Building 3rd Floor<br /> Jl. KH. Wahid Hasyim No. 5, Kebon Sirih - Jakarta 10340 <br /> Telp. 021-39174219 - 39174220 Fax. 021-3917425</p>', '<p>Telp. 021-39174219 - 39174210 <br /> Fax. 021-3917425</p>'),
(65, 'Konfirmasi', '?module=konfirmasi', '', '', 'user', 'N', 22, '', '', '', '', ''),
(46, 'Slider', '?module=slider', '', '', 'admin', 'Y', 10, '', '', '', '', ''),
(44, 'Hubungi Kami', '?module=hubungi', '', '', 'admin', 'Y', 16, '', '', '', '', ''),
(45, 'Produk', '?module=produk', '<div>\r\n<div>\r\n<br />\r\n</div>\r\n<div>\r\n1. Pilih Accesoris yang diinginkan\r\n</div>\r\n<div>\r\n<br />\r\n</div>\r\n<div>\r\n2. Konfirmasi ke Admin kami untuk cek ketersediaan barang / Produk yang dipilih dengan menghubungi&nbsp;\r\n</div>\r\n<div>\r\n<br />\r\n</div>\r\n<div>\r\ncall or sms<span style="white-space: pre" class="Apple-tab-span">	</span>: 081-233401686\r\n</div>\r\n<div>\r\nWhatsapp<span style="white-space: pre" class="Apple-tab-span">		</span>: +6281233401686\r\n</div>\r\n<div>\r\nPin BB<span style="white-space: pre" class="Apple-tab-span">		</span>: 29D91F92\r\n</div>\r\n<div>\r\n<br />\r\n</div>\r\n<div>\r\n3. Transfer Uang (sesuai harga kesepakatan) ke rekening kami:\r\n</div>\r\n<div>\r\n<span style="white-space: pre" class="Apple-tab-span">	</span>BCA KCP Kawi Malang\r\n</div>\r\n<div>\r\n<span style="white-space: pre" class="Apple-tab-span">	</span>No Rek 385 030 3681\r\n</div>\r\n<div>\r\n<span style="white-space: pre" class="Apple-tab-span">	</span>a.n ARDIAN DANNY PRAMONO\r\n</div>\r\n<div>\r\n<br />\r\n</div>\r\n<div>\r\n<span style="white-space: pre" class="Apple-tab-span">	</span>MANDIRI KCP Malang Merdeka\r\n</div>\r\n<div>\r\n<span style="white-space: pre" class="Apple-tab-span">	</span>No Rek 144.00.13809162\r\n</div>\r\n<div>\r\n<span style="white-space: pre" class="Apple-tab-span">	</span>a.n ARDIAN DANNY PRAMONO\r\n</div>\r\n<div>\r\n<br />\r\n</div>\r\n<div>\r\n4. setelah uang di trasnfer, mohon konfirmasi NAMA, ALAMAT, dan NO TELP/HP yang bisa dihubungi\r\n</div>\r\n<div>\r\n<br />\r\n</div>\r\n<div>\r\n5. Paket senapan / Accesoris akan segera kami packing dan kirim. adapun jadwal pengiriman paket:\r\n</div>\r\n<div>\r\n<span style="white-space: pre" class="Apple-tab-span">	</span>Pagi, pukul 10.00 - 12.00 WIB\r\n</div>\r\n<div>\r\n<span style="white-space: pre" class="Apple-tab-span">	</span>Sore, pukul 16.30 - 18.00 WIB\r\n</div>\r\n<div>\r\n<br />\r\n</div>\r\n<div>\r\nket\r\n</div>\r\n<div>\r\n* semua paket untuk jenis senapan angin / pistol angin menggunakan jasa pengiriman PT.POS INDONESIA, kecuali untuk paket accesoris bisa menggunakan jasa pengiriman PT.POS INDONESIA, JNE, TIKI, DAKOTA atau ELTEHA.\r\n</div>\r\n</div>\r\n<blockquote style="margin: 0px 0px 0px 40px; border: medium none; padding: 0px">\r\n	<span style="white-space: pre" class="Apple-tab-span">	</span>&nbsp;\r\n</blockquote>\r\n', 'gedung.jpg', 'admin', 'Y', 5, '', '', '', '', ''),
(47, 'Sub Kategori Produk', '?module=subkategori', '', '', 'admin', 'Y', 7, '', '', '', '', ''),
(48, 'Album', '?module=album', '', '', 'admin', 'N', 10, '', '', '', '', ''),
(49, 'Ganti Password', '?module=password', '', '', 'user', 'Y', 1, '', '', '', '', ''),
(53, 'News', '?module=artikel', '', '', 'admin', 'Y', 8, '', '', '', '', ''),
(52, 'Laporan', '?module=laporan', '', '', 'admin', 'N', 11, '', '', '', '', ''),
(57, 'Rekening', '?module=rekening', '', '', 'admin', 'N', 13, '', '', '', '', ''),
(59, 'Sub Kategori Produk 2', '?module=subsubkategori', '', '', 'user', 'N', 7, '', '', '', '', ''),
(60, 'Media Sosial', '?module=sosial', '', '', 'user', 'Y', 17, '', '', '', '', ''),
(61, 'Menu Footer', '?module=footer', '', '', 'user', 'N', 18, '', '', '', '', ''),
(62, 'Banner', '?module=banner', '', '', 'admin', 'Y', 19, '', '', '', '', ''),
(63, 'Manajemen Stok', '?module=stok', '', '', 'user', 'N', 20, '', '', '', '', ''),
(64, 'Keranjang Belanja', '?module=chart', '', '', 'user', 'N', 21, '', '', '', '', ''),
(66, 'Email', '?module=email', '', '', 'user', 'N', 23, '', '', '', '', ''),
(67, 'User', '?module=users', '', '', 'admin', 'N', 24, '', '', '', '', ''),
(68, 'Event', '?module=event', '', '', 'admin', 'Y', 9, '', '', '', '', ''),
(69, 'Halaman Statis', '?module=halamanstatis', '', '', 'admin', 'Y', 13, '', '', '', '', ''),
(70, 'Gallery', '?module=gallery', '', '', 'user', 'Y', 10, '', '', '', '', ''),
(71, 'Footer Promo', '?module=footer-promo', '', '', 'user', 'Y', 25, '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `id_orders` int(5) NOT NULL AUTO_INCREMENT,
  `kode_orders` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `status_order` varchar(50) COLLATE latin1_general_ci NOT NULL DEFAULT 'Baru',
  `tgl_order` date NOT NULL,
  `jam_order` time NOT NULL,
  `id_kustomer` int(5) NOT NULL,
  `id_session` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `nama_pemesan` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `email` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `alamat` text COLLATE latin1_general_ci NOT NULL,
  `telp` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `bank` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `nama_pengirim` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `jumlah_dibayar` int(9) NOT NULL,
  `provinsi` int(11) NOT NULL,
  `kota` int(11) NOT NULL,
  `kurir` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `biaya_ongkir` int(11) NOT NULL,
  PRIMARY KEY (`id_orders`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=79 ;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id_orders`, `kode_orders`, `status_order`, `tgl_order`, `jam_order`, `id_kustomer`, `id_session`, `nama_pemesan`, `email`, `alamat`, `telp`, `bank`, `nama_pengirim`, `jumlah_dibayar`, `provinsi`, `kota`, `kurir`, `biaya_ongkir`) VALUES
(76, '35', 'Baru', '2015-09-11', '13:51:34', 1, 'nue3nhj8o46rfjbhveejed9vr1', 'andhika', 'andhikatri3@yahoo.com', 'sby', '098765432sby', '', '', 147500, 0, 0, '', 0),
(77, '36', 'Baru', '2015-09-11', '17:14:42', 0, 'pmh9u95gorp5cisv8h608rl3j5', 'Dwi Yulianto', 'trafalgarlaw.dwi@gmail.com', 'kedungdoro 3/22', '08181818181', '', '', 120000, 0, 0, '', 0),
(78, '37', 'Baru', '2015-09-11', '17:26:05', 0, 'pmh9u95gorp5cisv8h608rl3j5', 'Dwi Yulianto', 'trafalgarlaw.dwi@gmail.com', 'test', '08181818181', '', '', 1035000, 0, 0, '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `orders_detail`
--

CREATE TABLE IF NOT EXISTS `orders_detail` (
  `id_orders` int(5) NOT NULL AUTO_INCREMENT,
  `id_produk` int(5) NOT NULL,
  `jumlah` int(5) NOT NULL,
  `id_kustomer` int(5) NOT NULL,
  `kode_orders` varchar(100) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id_orders`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=15 ;

--
-- Dumping data for table `orders_detail`
--

INSERT INTO `orders_detail` (`id_orders`, `id_produk`, `jumlah`, `id_kustomer`, `kode_orders`) VALUES
(1, 5, 2, 0, '28'),
(2, 5, 2, 0, '29'),
(3, 5, 2, 0, '30'),
(4, 5, 2, 0, '31'),
(5, 5, 2, 0, '32'),
(6, 5, 2, 0, '33'),
(7, 5, 2, 0, '34'),
(8, 5, 2, 1, '28'),
(9, 5, 1, 1, '34'),
(10, 3, 1, 1, '35'),
(11, 2, 1, 0, '36'),
(12, 4, 1, 0, '37'),
(13, 5, 2, 0, '37'),
(14, 6, 1, 0, '37');

-- --------------------------------------------------------

--
-- Table structure for table `orders_temp`
--

CREATE TABLE IF NOT EXISTS `orders_temp` (
  `id_orders_temp` int(5) NOT NULL AUTO_INCREMENT,
  `id_produk` int(5) NOT NULL,
  `id_session` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `jumlah` int(5) NOT NULL,
  `tgl_order_temp` date NOT NULL,
  `jam_order_temp` time NOT NULL,
  `stok_temp` int(5) NOT NULL,
  PRIMARY KEY (`id_orders_temp`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=25 ;

--
-- Dumping data for table `orders_temp`
--

INSERT INTO `orders_temp` (`id_orders_temp`, `id_produk`, `id_session`, `jumlah`, `tgl_order_temp`, `jam_order_temp`, `stok_temp`) VALUES
(24, 3, 'gpg98gssnef99ol77nvloh0mr4', 1, '2016-03-04', '14:48:10', 12);

-- --------------------------------------------------------

--
-- Table structure for table `partner`
--

CREATE TABLE IF NOT EXISTS `partner` (
  `id_partner` int(11) NOT NULL AUTO_INCREMENT,
  `nama_partner` varchar(255) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  PRIMARY KEY (`id_partner`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `partner`
--

INSERT INTO `partner` (`id_partner`, `nama_partner`, `gambar`, `deskripsi`) VALUES
(1, 'Keterangan 1', '512agent1.png', '<p>Keterangan 1</p>'),
(2, 'Keterangan 2', '310agent3.png', '<p>Keterangan 2</p>'),
(3, 'Keterangan 3', '901agent4.png', '<p>Keterangan 3</p>');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE IF NOT EXISTS `produk` (
  `id_produk` int(5) NOT NULL AUTO_INCREMENT,
  `id_kategori` int(5) NOT NULL,
  `id_subkategori` int(5) NOT NULL,
  `id_subsubkategori` int(5) NOT NULL,
  `nama_produk` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `produk_seo` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `deskripsi` text COLLATE latin1_general_ci NOT NULL,
  `harga` int(20) NOT NULL,
  `stok` int(5) NOT NULL,
  `berat` decimal(5,2) NOT NULL DEFAULT '0.00',
  `tgl_masuk` date NOT NULL,
  `gambar` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `dibeli` int(5) NOT NULL DEFAULT '1',
  `diskon` int(5) NOT NULL,
  `status` varchar(100) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id_produk`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=7 ;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `id_kategori`, `id_subkategori`, `id_subsubkategori`, `nama_produk`, `produk_seo`, `deskripsi`, `harga`, `stok`, `berat`, `tgl_masuk`, `gambar`, `dibeli`, `diskon`, `status`) VALUES
(1, 11, 24, 0, 'Produk 1', 'produk-1', '<p>Deskripsi singkat produk</p>', 150000, 12, 1.00, '2015-07-07', '', 1, 10, 'promo'),
(2, 12, 20, 0, 'Produk 2', 'produk-2', '', 120000, 12, 1.00, '2015-07-07', '', 11, 0, 'promo'),
(3, 12, 34, 0, 'Produk 3', 'produk-3', '', 147500, 12, 1.00, '2015-07-07', '', 7, 0, 'spesial'),
(4, 11, 19, 0, 'Produk 4', 'produk-4', '<p><span>Deskripsi singkat produk</span></p>', 100000, 12, 1.00, '2015-07-07', '', 9, 10, 'promo'),
(5, 13, 0, 0, 'produk 5', 'produk-5', '<p>wqwwwww</p>', 500000, 10, 10.00, '2015-09-09', '', 5, 10, 'baru'),
(6, 12, 0, 0, 'produk 6', 'produk-6', '<p>Top zipper closure, two pockets in the front, Slit patch pocket in the back. Detachable, adjustable shoulder strap. Interior: built-in padded compartment for a 14&rdquo; laptop, zipper</p>', 50000, 10, 10.00, '2015-09-09', '', 3, 10, 'baru');

-- --------------------------------------------------------

--
-- Table structure for table `rekening`
--

CREATE TABLE IF NOT EXISTS `rekening` (
  `id_rekening` int(5) NOT NULL AUTO_INCREMENT,
  `nama_pemilik` varchar(255) NOT NULL,
  `bank` varchar(255) NOT NULL,
  `no_rekening` varchar(255) NOT NULL,
  `keterangan` enum('Y','N') NOT NULL,
  PRIMARY KEY (`id_rekening`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `rekening`
--

INSERT INTO `rekening` (`id_rekening`, `nama_pemilik`, `bank`, `no_rekening`, `keterangan`) VALUES
(1, 'Fauzi Kurniawan', 'Mandiri', '135.00.55.222457', 'Y'),
(2, 'Fauzi Kurniawan', 'BCA', '40.90.46.4570', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `slider`
--

CREATE TABLE IF NOT EXISTS `slider` (
  `id_slider` int(11) NOT NULL AUTO_INCREMENT,
  `judul` varchar(50) NOT NULL,
  `teks` varchar(50) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `jenis_slider` int(11) NOT NULL,
  `status` enum('Y','N') NOT NULL,
  PRIMARY KEY (`id_slider`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `slider`
--

INSERT INTO `slider` (`id_slider`, `judul`, `teks`, `gambar`, `jenis_slider`, `status`) VALUES
(7, 'Slider', 'Slider', '840slider3.jpg', 1, 'Y'),
(8, 'Slider', 'Slider', '617slider2.jpg', 1, 'Y'),
(9, 'Slider', 'Slider', '511slider1.jpg', 1, 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `sosial`
--

CREATE TABLE IF NOT EXISTS `sosial` (
  `id_sosial` int(5) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `aktif` enum('Y','N') NOT NULL,
  PRIMARY KEY (`id_sosial`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `sosial`
--

INSERT INTO `sosial` (`id_sosial`, `nama`, `link`, `gambar`, `aktif`) VALUES
(1, 'facebook', 'https://www.facebook.com/produkbangsa', 'rizky-mobile-facebook.png', 'Y'),
(2, 'twitter', 'https://twitter.com/produk_bangsa', 'rizky-mobile-twitter.png', 'Y'),
(3, 'google-plus', 'https://plus.google.com/', 'rizky-mobile-google_plus.png', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `stok`
--

CREATE TABLE IF NOT EXISTS `stok` (
  `id_stok` int(5) NOT NULL AUTO_INCREMENT,
  `id_produk` int(5) NOT NULL,
  `penambahan_stok` int(5) NOT NULL,
  `tgl` date NOT NULL,
  PRIMARY KEY (`id_stok`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=10 ;

--
-- Dumping data for table `stok`
--

INSERT INTO `stok` (`id_stok`, `id_produk`, `penambahan_stok`, `tgl`) VALUES
(1, 10, 12, '2015-05-12'),
(2, 9, 12, '2015-05-12'),
(3, 10, 5, '2015-05-12'),
(4, 9, 10, '2015-05-12'),
(5, 8, 12, '2015-05-12'),
(6, 10, 5, '2015-05-12'),
(7, 10, 5, '2015-05-13'),
(8, 40, 4, '2015-05-27'),
(9, 309, 5, '2015-07-07');

-- --------------------------------------------------------

--
-- Table structure for table `subkategori`
--

CREATE TABLE IF NOT EXISTS `subkategori` (
  `id_subkategori` int(5) NOT NULL AUTO_INCREMENT,
  `nama_sub` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `subkategori_seo` varchar(255) NOT NULL,
  `link_sub` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `id_main` int(5) NOT NULL,
  `aktif` enum('Y','N') NOT NULL DEFAULT 'Y',
  PRIMARY KEY (`id_subkategori`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=35 ;

--
-- Dumping data for table `subkategori`
--

INSERT INTO `subkategori` (`id_subkategori`, `nama_sub`, `subkategori_seo`, `link_sub`, `id_main`, `aktif`) VALUES
(24, 'sub kategori 1.1', 'subkategori-1-1', NULL, 11, 'Y'),
(16, 'sub kategori 1.1', 'subkategori-1-1', NULL, 7, 'Y'),
(19, 'sub kategori 1.1', 'subkategori-1-1', NULL, 11, 'Y'),
(18, 'sub kategori 1.1', 'subkategori-1-1', NULL, 11, 'Y'),
(20, 'sub kategori 1.1', 'subkategori-1-1', NULL, 12, 'Y'),
(21, 'sub kategori 1.1', 'subkategori-1-1', NULL, 11, 'Y'),
(22, 'sub kategori 1.1', 'subkategori-1-1', NULL, 11, 'Y'),
(33, 'sub kategori 1.1', 'subkategori-1-1', NULL, 11, 'Y'),
(25, 'sub kategori 1.1', 'subkategori-1-1', NULL, 11, 'Y'),
(26, 'sub kategori 1.1', 'subkategori-1-1', NULL, 11, 'Y'),
(27, 'sub kategori 1.1', 'subkategori-1-1', NULL, 11, 'Y'),
(28, 'sub kategori 1.1', 'subkategori-1-1', NULL, 12, 'Y'),
(29, 'sub kategori 1.1', 'subkategori-1-1', NULL, 11, 'Y'),
(30, 'sub kategori 1.1', 'subkategori-1-1', NULL, 12, 'Y'),
(31, 'sub kategori 1.1', 'subkategori-1-1', NULL, 12, 'Y'),
(32, 'sub kategori 1.1', 'subkategori-1-1', NULL, 12, 'Y'),
(34, 'sub kategori 1.1', 'subkategori-1-1', NULL, 12, 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `submenu`
--

CREATE TABLE IF NOT EXISTS `submenu` (
  `id_sub` int(5) NOT NULL AUTO_INCREMENT,
  `nama_sub` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `link_sub` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `id_main` int(5) NOT NULL,
  `id_submain` int(11) NOT NULL,
  `aktif` enum('Y','N') NOT NULL DEFAULT 'Y',
  `adminsubmenu` enum('Y','N') NOT NULL,
  PRIMARY KEY (`id_sub`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=70 ;

--
-- Dumping data for table `submenu`
--

INSERT INTO `submenu` (`id_sub`, `nama_sub`, `link_sub`, `id_main`, `id_submain`, `aktif`, `adminsubmenu`) VALUES
(59, 'Pengolahan Mineral', 'statis-1-pengolahan-mineral.html', 4, 0, 'Y', 'N'),
(69, 'Pengeboran dan Peledakan', 'statis-2-pengeboran-dan-peledakan.html', 4, 0, 'Y', 'N');

-- --------------------------------------------------------

--
-- Table structure for table `subsubkategori`
--

CREATE TABLE IF NOT EXISTS `subsubkategori` (
  `id_subkategori` int(5) NOT NULL AUTO_INCREMENT,
  `nama_sub` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `subkategori_seo` varchar(255) NOT NULL,
  `link_sub` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `id_main` int(5) NOT NULL,
  `id_submain` int(11) NOT NULL,
  PRIMARY KEY (`id_subkategori`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `subsubkategori`
--

INSERT INTO `subsubkategori` (`id_subkategori`, `nama_sub`, `subkategori_seo`, `link_sub`, `id_main`, `id_submain`) VALUES
(2, 'Baterai', 'baterai', NULL, 3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `templates`
--

CREATE TABLE IF NOT EXISTS `templates` (
  `id_templates` int(5) NOT NULL AUTO_INCREMENT,
  `judul` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `pembuat` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `folder` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `aktif` enum('Y','N') COLLATE latin1_general_ci NOT NULL DEFAULT 'N',
  PRIMARY KEY (`id_templates`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=16 ;

--
-- Dumping data for table `templates`
--

INSERT INTO `templates` (`id_templates`, `judul`, `pembuat`, `folder`, `aktif`) VALUES
(14, 'aksamedia', 'aksamedia', 'templates/aksamedia', 'N'),
(15, 'aksamedia', 'aksa', 'templates/boneka', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id_users` int(5) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `password` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `nama_lengkap` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `email` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `no_telp` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `level` varchar(20) COLLATE latin1_general_ci NOT NULL DEFAULT 'user',
  `blokir` enum('Y','N') COLLATE latin1_general_ci NOT NULL DEFAULT 'N',
  `tgl` date NOT NULL,
  `gambar` varchar(255) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id_users`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=13 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_users`, `username`, `password`, `nama_lengkap`, `email`, `no_telp`, `level`, `blokir`, `tgl`, `gambar`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Admin', 'andhika.tri@gmail.com', '085646607657', 'admin', 'N', '2014-08-16', '1.jpg'),
(2, 'andhika', '21232f297a57a5a743894a0e4a801fc3', 'dwi yulianto', 'xanxusviper@gmail.com', '08356782040', 'user', 'N', '2015-08-13', '2931073_20141017011346.jpg');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
