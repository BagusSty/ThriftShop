<?php
session_start();
include '../../config.php';
if(!isset ($_SESSION['nama']) ){
  header("Location:../../index.php");
}
if (isset($_POST['edit'])) {
  $id = $_POST['id_user'];
  $nama = $_POST['nama'];
  $nohp = $_POST['no_hp'];
  $username = $_POST['username'];
  $password = md5($_POST['password']);
  $qry = "UPDATE tb_user SET nama='$nama', username='$username', no_hp='$nohp',  password='$password' WHERE id_user='$id'";
  $input = mysqli_query($conn,$qry);
  if ($input== true) {
    header('location:profil.php');
  } else {
    echo '<script>alert("Data Gagal Tersimpan")</script>';
    die ("Gagal menginput data: ".mysqli_errno($conn)." - ".mysqli_error($conn));
  }
}
?>