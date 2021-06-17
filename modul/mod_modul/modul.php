<?php
//apabila user blm login
if (empty(['namauser']) and empty(['passuser'])) {
  echo "<center>
    <h3>Untuk Mengakses halaman ini anda harus login dahulu</h3>
    <br>
    <a href=\"index.php\"><h3>Halaman Login</h3></a>
</center>";
} else {
?>
  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Halaman Modul</h1>
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
    $aksi = "modul/mod_modul/aksi_modul.php";

    //mengatasi variabel yang blm di definisikan
    $act = isset($_GET['act']) ? $_GET['act'] : '';

    switch ($act) {
        //tampil data modul
      default:
        echo "
        <section class=\"content\">
        <div class=\"card\">
          <div class=\"card-header\">
            <button class='btn btn-primary' onclick=window.location.href=\"?module=pagemodul&act=tambahmodul\">Tambah Data</button>
          </div>
          <div class=\"card-body\">
            <table class='table table-bordered'>
            <thead>
            <tr>
                <th>Urutan Modul</th>
                <th>Nama Modul</th>
                <th>Link</th>
                <th>Aktif</th>
                <th>Tools</th>
            </tr>
            </thead>";
        //query sql tampil data
        $query = "SELECT * FROM modul ORDER BY urutan";
        $tampil = mysqli_query($conn, $query);
        while ($t = mysqli_fetch_array($tampil)) {
          echo "<tbody>
              <tr>
                  <td class='text-center'>$t[urutan]</td>
                  <td>$t[nama_modul]</td>
                  <td>$t[link]</td>
                  <td>$t[aktif]</td>
                  <td>&nbsp;</td>
              </tr>";
        }

        echo "
            </tbody>
            </table>
          </div>
        </div>
      </section>";

        break;

        //halaman tambah data modul
      case "tambahmodul":
        echo "
        <section class=\"content\">
        <div class=\"card\">
          <div class=\"card-header\">
            <h3 class=\"card-title\">Halaman Tambah Modul</h3>
          </div>
          <div class=\"card-body\">
              <form>
                  <table class='table table-bordered'>
                      <tr>
                        <td>Nama Modul :</td>
                        <td><input type='text' name='nama_modul' class='form-control' autocomplete='off'></td>
                      </tr>
                      <tr>
                        <td>Link :</td>
                        <td><input type='text' name='link' class='form-control' autocomplete='off'></td>
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
