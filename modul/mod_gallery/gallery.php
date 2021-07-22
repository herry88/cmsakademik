<?php
//apabila user blm login
if (empty(['namauser']) and empty(['passuser'])) {
    echo "<center>
    <h3>Untuk Mengakses halaman ini anda harus login dahulu</h3>
    <br>
    <a href=\"../../index.php\"><h3>Halaman Login</h3></a>
</center>";
} else {
?>
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Halaman Gallery</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <?php
        //file untuk proses simpan, update
        $aksi = "modul/mod_gallery/aksi_gallery.php";

        //mengatasi variabel yang blm di definisikan
        $act = isset($_GET['act']) ? $_GET['act'] : '';

        switch ($act) {
                //tampil data gallery
            default:
                echo "
        <section class=\"content\">
        <div class=\"card\">
          <div class=\"card-header\">
            <button class='btn btn-primary' onclick=window.location.href=\"?module=pagegallery&act=tambahgallery\">Tambah Data</button>
          </div>
          <div class=\"card-body\">
            <table class='table table-bordered'>
            <thead>
            <tr>
                <th>No</th>
                <th>Album</th>
                <th>Judul Gallery</th>
                <th>Photo</th>
                <th>Keterangan</th>
                <th>Tools</th>
            </tr>
            </thead>";
                //query sql tampil data
                $query = "SELECT * FROM galery ORDER BY id_galery";
                $tampil = mysqli_query($conn, $query);
                //deklarasikan variabel no
                $no = 1;
                while ($t = mysqli_fetch_array($tampil)) {
                    echo "<tbody>
              <tr>
                  <td class='text-center'>$no</td>
                  <td>$t[album]</td>
                  <td>$t[judul_galery]</td>
                  <td><img src='fotoguru/small_$t[foto]' width='100' height='75'></td>
                  <td>$t[keterangan]</td>
                  <td><a href='#' title='Edit' class='btn btn-warning text-white'><i class='fa fa-edit'></i>Edit</a>
                    <a href='#' title='Delete' class='btn btn-danger text-white'><i class='fa fa-trash'></i></a>
                  </td>
              </tr>";
                    $no++;
                }

                echo "
            </tbody>
            </table>
          </div>
        </div>
      </section>";

                break;

                //halaman tambah data guru
            case "tambahgallery":
                echo "
        <section class=\"content\">
        <div class=\"card\">
          <div class=\"card-header\">
            <h3 class=\"card-title\">Halaman Tambah Gallery</h3>
          </div>
          <div class=\"card-body\">
              <form action='$aksi?module=pagegallery&act=input' enctype='multipart/form-data' method='POST'>
                  <table class='table table-bordered'>
                      <tr>
                        <td>Album :</td>
                        <td><input type='text' name='album' class='form-control' autocomplete='off'></td>
                      </tr>
                      <tr>
                        <td>Judul Gallery :</td>
                        <td><input type='text' name='judul_galery' class='form-control' autocomplete='off'></td>
                      </tr>
                      <tr>
                        <td>Foto :</td>
                        <td>
                           <input type='file' class='form-control' name='fupload' >
                        </td>
                      </tr>
                      <tr>
                        <td>Keterangan :</td>
                        <td>
                            <input type='text' name='keterangan' class='form-control'>
                        </td>
                      </tr>
                      
                      <tr>
                        <td></td>
                        <td>
                          <button type='submit' class='btn btn-success'>Save</button>
                          <button type='button' class='btn btn-danger' onclick='self.history.back()'>Cancel</button>
                        </td>
                      </tr>


                  </table>
              </form>
          </div>
        </div>
      </section>";
                break;
        }
        ?>



    </div>


<?php } ?>