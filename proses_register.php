<?php
session_start();
include 'config.php';


if (isset($_POST['submit'])) {
  $nama = $_POST['nama'];
  $username = $_POST['username'];
  $no_hp = $_POST['no_hp'];
  $password = md5($_POST['password']);

  $register = mysqli_query($conn,"INSERT INTO tb_user(nama,username,no_hp,password,tipe_user) VALUES ('$nama','$username','$no_hp','$password','3')");
  if ($register== true) {
    header('location:users/user/beranda_user.php');
    $_SESSION['nama'] = $nama;
  } else {
    echo '<script>alert("Data Gagal Tersimpan")</script>';
    die ("Gagal menginput data: ".mysqli_errno($conn)." - ".mysqli_error($conn));
  }
}
?>

