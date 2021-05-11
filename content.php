<?php
  //apabila user blm login
  if(empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
      echo "
        <center>
          <h1>Untuk Mengakses modul ini anda harus login</h1><br>
          <a href='index.php'>Halaman Login</a>
        </center>
      ";
  }
  //apabila sudah login sesuai dengan level
  else{
    //panggil file connection
    include "config/conn.php";

    //akses halaman dashboard
    if($_GET['module']=='dashboard'){
      if($_SESSION['level']=='admin' OR $_SESSION['level']=='user'){
        include "modul/mod_dashboard/dashboard.php";
      }
    }

    else{
      echo "
      <div class=\"content-wrapper\">
      <div class=\"content-header\">
      <div class=\"container-fluid\">
        <div class=\"row mb-2\">
          <div class=\"col-sm-6\">
            <h1 class=\"m-0\">Under Construction</h1>
          </div><!-- /.col -->

        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
      </div>
      ";
    }

  }
