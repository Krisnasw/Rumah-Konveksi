<?php
    // diskon  
    $harga     = format_rupiah($r[harga]);
    $disc      = ($r[diskon]/100)*$r[harga];
    $hargadisc = number_format(($r[harga]-$disc),0,",",".");

    $d=$r['diskon'];
    $hargatetap  = "<span class='price'><span class='amount'>Rp. $hargadisc</span></span>";
    $hargadiskon = "<span class='price'><del><span class='amount'>Rp. $harga</span></del> <ins><span class='amount'>Rp. $hargadisc,-</span></ins></span>
					";
    if ($d!=0){
      $divharga=$hargadiskon;
    }else{
      $divharga=$hargatetap;
    } 

?>
