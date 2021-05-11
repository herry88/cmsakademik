<nav class="mt-2">
  <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
    <li class="nav-item">
      <a href="#" class="nav-link active">
        <i class="nav-icon fas fa-tachometer-alt"></i>
        <p>
          Dashboard
        </p>
      </a>
    </li>
    <?php
    include "config/conn.php";
    if ($_SESSION['level'] == 'admin') {
      $query = "SELECT * FROM modul WHERE aktif='Y' ORDER BY urutan";
      $hasil = mysqli_query($conn, $query);
      while ($m = mysqli_fetch_array($hasil)) {
        echo " <li class=\"nav-item\">
          <a href=\"$m[link]\" class=\"nav-link\">
            <i class=\"nav-icon fas fa-th\"></i>
            <p>
              $m[nama_modul]
            </p>
          </a>
        </li>";
      }
    } else {
      if ($_SESSION['level'] == 'user') {
        $query = "SELECT * FROM modul WHERE status='user' AND aktif='Y' ORDER BY urutan";
        $hasil = mysqli_query($conn, $query);
        while ($m = mysqli_fetch_array($hasil)) {
          echo "<li class=\"nav-item\">
          <a href=\"$m[link]\" class=\"nav-link\">
            <i class=\"nav-icon fas fa-th\"></i>
            <p>
              $m[nama_modul]
            </p>
          </a>
        </li>";
        }
      }
    }
    ?>

    <li class="nav-header">Logout</li>

    <li class="nav-item">
      <a href="logout.php" class="nav-link">
        <i class="nav-icon fas fa-th"></i>
        <p>
          Logout
        </p>
      </a>
    </li>


  </ul>
</nav>
