<?php
	include "config/koneksi.php";
	function antiinjection($data){
	  $filter_sql = mysql_real_escape_string(stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES))));
	  return $filter_sql;
	}

	$new_pass	  = antiinjection($_POST['new_pass']);
	$id	  = antiinjection($_POST['id']);

	mysql_query("UPDATE kustomer SET password='$new_pass' WHERE id_kustomer='$id'") or die (mysql_error());
	echo "<script>window.location='./'</script>";
?>