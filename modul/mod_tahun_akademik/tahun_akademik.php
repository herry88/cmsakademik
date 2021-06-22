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
            <h1>Halaman Tahun Akademik</h1>
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
    $aksi = "modul/mod_tahun_akademik/aksi_tahun_akademik.php";

    //mengatasi variabel yang blm di definisikan
    $act = isset($_GET['act']) ? $_GET['act'] : '';

    switch ($act) {
        //tampil data modul
      default:
        echo "
        <section class=\"content\">
        <div class=\"card\">
          <div class=\"card-header\">
            <button class='btn btn-primary' onclick=window.location.href=\"?module=pagetahunakademik&act=tambahakademik\">Tambah Data</button>
          </div>
          <div class=\"card-body\">
            <table class='table table-bordered'>
            <thead>
            <tr>
                <th>No</th>
                <th>Nama Tahun Akademik</th>
                <th>Keterangan</th>
                <th>Tools</th>
            </tr>
            </thead>";
        //query sql tampil data
        $query = "SELECT * FROM tahun_akademik ORDER BY id_tahun_akademik";
        $tampil = mysqli_query($conn, $query);
        $no=1;
        while ($t = mysqli_fetch_array($tampil)) {
          echo "<tbody>
              <tr>
                  <td class='text-center'>$no</td>
                  <td>$t[nama_tahun_akademik]</td>
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

        //halaman tambah data tahun akademik
      case "tambahakademik":
        echo "
        <section class=\"content\">
        <div class=\"card\">
          <div class=\"card-header\">
            <h3 class=\"card-title\">Halaman Tambah Akademik</h3>
          </div>
          <div class=\"card-body\">
              <form action='$aksi?module=pagetahunakademik&act=input' method='POST'>
                  <table class='table table-bordered'>
                      <tr>
                        <td>Nama Tahun Akademik :</td>
                        <td><input type='text' name='nama_tahun_akademik' class='form-control' autocomplete='off'></td>
                      </tr>
                      <tr>
                        <td>Keterangan :</td>
                        <td><input type='text' name='keterangan' class='form-control' autocomplete='off'></td>
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

      case "editmodul":
        //query sql tampil data modul
        $query  = "SELECT * FROM modul WHERE id_modul = '$_GET[id]'";
        $hasil = mysqli_query($conn, $query);
        $r = mysqli_fetch_array($hasil);

        echo "
        <section class=\"content\">
        <div class=\"card\">
          <div class=\"card-header\">
            <h3 class=\"card-title\">Halaman Edit Modul</h3>
          </div>
          <div class=\"card-body\">
              <form action='$aksi?module=pagemodul&act=update' method='POST'>
                <input type='hidden' value='$r[id_modul]' name='id'>
                  <table class='table table-bordered'>
                      <tr>
                        <td>Nama Modul :</td>
                        <td><input type='text' name='nama_modul' value='$r[nama_modul]' class='form-control' autocomplete='off'></td>
                      </tr>
                      <tr>
                        <td>Link :</td>
                        <td><input type='text' name='link' value='$r[link]' class='form-control' autocomplete='off'></td>
                      </tr>
                      <tr>
                        <td>Urutan :</td>
                        <td><input type='text' name='urutan' value='$r[urutan]' class='form-control' autocomplete='off'></td>
                      </tr>";
                      //kondisi jika status admin
                      if($r['status'] == 'admin'){
                          echo "<tr>
                          <td>Status</td>
                          <td><input type='radio' name='status' value='admin' checked>Admin
                              <input type='radio' name='status' value='user'>User
                          </td>
                        </tr>";
                      } else{
                        echo"<tr>
                        <td>Status</td>
                        <td><input type='radio' name='status' value='admin'>Admin
                            <input type='radio' name='status' value='user' checked>User
                        </td>
                      </tr>";
                      }
                      if($r['aktif']=='Y'){
                        echo"<tr>
                        <td>Aktif</td>
                        <td><input type='radio' name='aktif' value='Y' checked>Ya
                            <input type='radio' name='aktif' value='N' >Tidak
                        </td>
                      </tr>";
                      } else{
                        echo"<tr>
                        <td>Aktif</td>
                        <td><input type='radio' name='aktif' value='Y' >Ya
                            <input type='radio' name='aktif' value='N' checked>Tidak
                        </td>
                      </tr>";
                      }
                      echo"
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
