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
            <h1>Halaman Guru</h1>
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
    $aksi = "modul/mod_guru/aksi_guru.php";

    //mengatasi variabel yang blm di definisikan
    $act = isset($_GET['act']) ? $_GET['act'] : '';

    switch ($act) {
        //tampil data Guru
      default:
        echo "
        <section class=\"content\">
        <div class=\"card\">
          <div class=\"card-header\">
            <button class='btn btn-primary' onclick=window.location.href=\"?module=pageguru&act=tambahguru\">Tambah Data</button>
          </div>
          <div class=\"card-body\">
            <table class='table table-bordered'>
            <thead>
            <tr>
                <th>No</th>
                <th>Nama Guru</th>
                <th>Golongan</th>
                <th>Tahun Akademik</th>
                <th>Status</th>
                <th>Tools</th>
            </tr>
            </thead>";
        //query sql tampil data
        $query = "SELECT * FROM guru ORDER BY id_guru";
        $tampil = mysqli_query($conn, $query);
        //deklarasikan variabel no
        $no = 1;
        while ($t = mysqli_fetch_array($tampil)) {
          echo "<tbody>
              <tr>
                  <td class='text-center'>$no</td>
                  <td>$t[nama_guru]</td>
                  <td>$t[golongan]</td>
                  <td>$t[id_tahun_akademik]</td>
                  <td>$t[status]</td>
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
      case "tambahguru":
        echo "
        <section class=\"content\">
        <div class=\"card\">
          <div class=\"card-header\">
            <h3 class=\"card-title\">Halaman Tambah Guru</h3>
          </div>
          <div class=\"card-body\">
              <form action='$aksi?module=pageguru&act=input' method='POST'>
                  <table class='table table-bordered'>
                      <tr>
                        <td>Nama Guru :</td>
                        <td><input type='text' name='nama_guru' class='form-control' autocomplete='off'></td>
                      </tr>
                      <tr>
                        <td>Golongan :</td>
                        <td><input type='text' name='golongan' class='form-control' autocomplete='off'></td>
                      </tr>
                      <tr>
                        <td>Tahun Akademik :</td>
                        <td>
                            <select name='tahun_akademik' class='form-control'>
                                <option value='0'>-Pilih Data-</option>";
                                $query = mysqli_query($conn, "SELECT * FROM tahun_akademik WHERE id_tahun_akademik");
                                while($g = mysqli_fetch_array($query)){
                                    echo "<option value='$g[id_tahun_akademik]'>$g[nama_tahun_akademik]</option>";
                                }

                        echo"        
                            </select>
                        </td>
                      </tr>
                      <tr>
                        <td>Status :</td>
                        <td>
                            <select name='status' class='form-control'>
                                <option value='0'>--Pilih Data--</option>
                                <option value='aktif'>Aktif</option>
                                <option value='tidak aktif'>Tidak Aktif</option>
                            </select>
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
