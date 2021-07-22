<?php
session_start();
if(empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
  echo "<center>
    <h3>Untuk Mengakses halaman ini anda harus login dahulu</h3>
    <br>
    <a href=\"index.php\"><h3>Halaman Login</h3></a>
</center>";
} else{
  //masukkan file koneksi database
  include "../../config/conn.php";
  //deklarasikan variabel modul
  $module = $_GET['module'];
  $act = $_GET['act'];

  //input data
  if($module =='pagemodul' AND $act=='input'){
    //cari urutan terakhir
    $query = mysqli_query($conn, "SELECT * FROM modul ORDER BY urutan DESC LIMIT 1");
    $r = mysqli_fetch_array($query);
    $urutan = $r['urutan']+1;

    //deklarasikan form modul
    $nama_modul = $_POST['nama_modul'];
    $link = $_POST['link'];

    //function insert
    $save = "INSERT INTO modul(nama_modul, link,urutan)VALUES('$nama_modul','$link','$urutan')";
    mysqli_query($conn, $save);
    //redirect halaman data modul
    header("location:../../media.php?module=".$module);
  }
  //hapus data
  elseif($module=='pagemodul' AND $act =='hapus'){
    $hapus = mysqli_query($conn, "DELETE FROM modul WHERE id_modul ='$_GET[id]'");
    header("location:../../media.php?module=".$module);
  }
  //updatedata
  elseif($module=='pagemodul' AND $act =='update'){
    //deklarasikan variabel form
    $id = $_POST['id'];
    $urutan = $_POST['urutan'];
    $nama_modul = $_POST['nama_modul'];
    $link = $_POST['link'];
    $status = $_POST['status'];
    $aktif = $_POST['aktif'];

    //function update
    $update ="UPDATE modul SET nama_modul ='$nama_modul',
                               link = '$link',
                               urutan = '$urutan',
                               aktif = '$aktif',
                               status = '$status'
                               WHERE id_modul = '$id'";
    mysqli_query($conn, $update);
    header("location:../../media.php?module=".$module);
  }
}
?>
