<?php
  session_start();
  session_destroy();
  echo "<script>alert('Anda telah keluar dari Halaman Login'); window.location = './'</script>";
?>
