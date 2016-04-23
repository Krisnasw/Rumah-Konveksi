<?php
      $sql2 = mysql_query("select meta_keyword from identitas where id_identitas='1'");
      $j2   = mysql_fetch_array($sql2);
		  echo "$j2[meta_keyword]";
?>
