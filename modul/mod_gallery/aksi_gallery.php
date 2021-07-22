<?php
session_start();
if (empty($_SESSION['namauser']) and empty($_SESSION['passuser'])) {
    echo "<center>
        <h3>Untuk Mengakses halaman ini anda harus login dahulu</h3>
        <br>
        <a href=\"../../index.php\"><h3>Halaman Login</h3></a>
    </center>";
} else {
    include "../../config/conn.php";
    include "../../config/thumbnail.php";

    $module = $_GET['module'];
    $act = $_GET['act'];
    //simpan foto
    if ($module == 'pagegallery' and $act == 'input') {
        //function untuk save data
        $lokasifile = $_FILES['fupload']['tmp_name'];
        $tipefile = $_FILES['fupload']['type'];
        $namafile = $_FILES['fupload']['name'];
        $acak = rand(1, 99);
        $namafoto = $acak . $namafile;

        //deklarasikan variabel form
        $album = $_POST['album'];
        $judul_galery = $_POST['judul_galery'];
        $keterangan = $_POST['keterangan'];

        //function simpan foto apabila tidak ada foto
        if (empty($lokasifile)) {
            $input = "INSERT INTO galery(album, judul_galery, keterangan)VALUES('$album','$judul_galery','$keterangan')";
            mysqli_query($conn, $input);
            header("location:../../media.php?module=" . $module);
        } //jika ada foto 
        else {
            //jika filenya tidak bertipe jpg
            if ($tipefile != "image/jpeg" and $tipefile != "image/pjpeg") {
                echo "<script>window.alert('Upload Gagal! pastikan formatnya JPG');
                    window.location=('../../media.php?module=pagegallery')
                </script>";
            } else {
                $folder = "../../fotoguru/";
                $ukuran = 180;
                upload_image($namafoto, $folder, $ukuran);
                $input = "INSERT INTO galery(album,
                                  judul_galery,
                                  foto,keterangan)VALUES('$album',
                                  '$judul_galery','$namafoto','$keterangan')";
                mysqli_query($conn, $input);
                // header("location:../../media.php?module=" . $module);
            }
        }
    }
}
