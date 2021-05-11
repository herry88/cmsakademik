<?php
//memanggil file conn
include "config/conn.php";

//fungsi untuk menghindari injeksi dari user yang jahil
function anti_injection($data){
  $filter = stripslashes(strip_tags(htmlspecialchars($data, ENT_QUOTES)));
  return $filter;
}
//deklarasikan variable form
$username = anti_injection($_POST['username']);
$password = anti_injection(md5($_POST['password']));

//menghindari sql injection
$injeksi_username = mysqli_real_escape_string($conn, $username);
$injeksi_password = mysqli_real_escape_string($conn, $password);

//memastikan username dan password berupa angka atau huruf
if(!ctype_alnum($injeksi_username) OR !ctype_alnum($injeksi_password)){
  echo "<h2>Anda tidak bisa login, tidak bisa diinjeksi</h2>";
} else{
  $query = "SELECT * FROM users WHERE username='$username' AND password='$password' AND blokir='N' ";
  $login = mysqli_query($conn, $query);
  $ketemu = mysqli_num_rows($login);
  $r = mysqli_fetch_array($login);
  if($ketemu > 0){
    session_start();
    //buat variabel session
    $_SESSION['namauser'] = $r['username'];
    $_SESSION['passuser'] = $r['password'];
    $_SESSION['level'] = $r['level'];

    //buat id_session yang unik dan mengupdatenya agar selalu berubah
    //agar user biasa sulit untuk mengganti password administrator
    $id_lama = session_id();
    session_regenerate_id();
    $id_baru = session_id();
    mysqli_query($conn, "UPDATE users SET id_session ='$id_baru' WHERE username = '$username'");

    echo "Selamat login berhasil";
  }
  else{
    echo "Login gagal username dan password salah<br>";
    echo "silahkan login kembali <a href='index.php'>Login Page</a>";
  }
}
