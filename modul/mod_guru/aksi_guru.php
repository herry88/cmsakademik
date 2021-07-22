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
  if($module =='pageguru' AND $act=='input'){

    //deklarasikan form tahun akademik
    $nama_guru = $_POST['nama_guru'];
    $golongan = $_POST['golongan'];
    $tahun_akademik =  $_POST['tahun_akademik'];
    $status = $_POST['status'];

    //function insert
    $save = "INSERT INTO guru(nama_guru, golongan, id_tahun_akademik, status)VALUES('$nama_guru','$golongan','$tahun_akademik','$status')";
    mysqli_query($conn, $save);
    //redirect halaman data modul
    header("location:../../media.php?module=".$module);
  }
  //hapus data
  elseif($module=='pagetahunakademik' AND $act =='hapus'){
    $hapus = mysqli_query($conn, "DELETE FROM tahun_akademik WHERE id_tahun_akademik ='$_GET[id]'");
    header("location:../../media.php?module=".$module);
  }
  //updatedata
  elseif($module=='pagetahunakademik' AND $act =='update'){
    //deklarasikan variabel form
    $id = $_POST['id'];
    $nama_tahun_akademik = $_POST['nama_tahun_akademik'];
    $keterangan = $_POST['keterangan'];
    

    //function update
    $update ="UPDATE tahun_akademik SET nama_tahun_akademik ='$nama_tahun_akademik',
                               keterangan = '$keterangan'
                               WHERE id_tahun_akademik = '$id'";
    mysqli_query($conn, $update);
    header("location:../../media.php?module=".$module);
  }
}
?>
