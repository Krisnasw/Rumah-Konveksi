<?php
if (isset($_GET['id'])){
	if ($_GET[module]=='detailproduk') {
		$sql = mysql_query("select nama_produk from produk where id_produk='$_GET[id]'");
		$j   = mysql_fetch_array($sql);
		if ($j) {
			echo "$j[nama_produk]";
		} 
	} 
	elseif ($_GET[module]=='detailartikel') {
		$sqld = mysql_query("select judul from artikel where id_artikel='$_GET[id]'");
		$jd   = mysql_fetch_array($sqld);
		if ($jd) {
			echo "$jd[judul]";
		} 
	}
	else{
	  $sql2 = mysql_query("select nama_website from identitas where id_identitas='1'");
	  $j2   = mysql_fetch_array($sql2);
		  echo "$j2[nama_website]";
	}
}
else{
      $sql2 = mysql_query("select meta_deskripsi from identitas where id_identitas='1'");
      $j2   = mysql_fetch_array($sql2);
		  echo "$j2[meta_deskripsi]";
}
?>
