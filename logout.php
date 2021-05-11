<?php
//fungsi logout sistem
session_start();
session_destroy();
echo "
  <script>
    alert('Anda Telah Logout');window.location='index.php'
  </script>";
?>
