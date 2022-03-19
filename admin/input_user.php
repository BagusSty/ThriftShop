<?php
session_start();
include '../config.php';
if(!isset ($_SESSION['username'])){
    header("Location:../index.php");
}

if (isset($_POST['simpan'])) {
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $nohp = $_POST['no_hp'];
    if ($_POST['jabatan']=='Pemilik') {
        $qry = "INSERT INTO tb_user(nama,username,no_hp,password,tipe_user) VALUES ('$nama','$username','$nohp','$password','1')";
        $input = mysqli_query($conn,$qry);
        if ($input== true) {
            echo '<script>alert("Data Tersimpan")</script>';
            header('location:data_user.php');
        } else {
            echo '<script>alert("Data Gagal Tersimpan")</script>';
            die ("Gagal menginput data: ".mysqli_errno($conn)." - ".mysqli_error($conn));
        }
    }
    else if ($_POST['jabatan']=='Manager') {
        $qry = "INSERT INTO tb_user(nama,username,no_hp,password,tipe_user) VALUES ('$nama','$username','$nohp','$password','2')";
        $input = mysqli_query($conn,$qry);
        if ($input== true) {
            echo '<script>alert("Data Tersimpan")</script>';
            header('location:data_user.php');
        } else {
            echo '<script>alert("Data Gagal Tersimpan")</script>';
            die ("Gagal menginput data: ".mysqli_errno($conn)." - ".mysqli_error($conn));
        }
    }
    else if ($_POST['jabatan']=='Kasir') {
        $qry = "INSERT INTO tb_user(nama,username,no_hp,password,tipe_user) VALUES ('$nama','$username','$nohp','$password','3')";
        $input = mysqli_query($conn,$qry);
        if ($input== true) {
            echo '<script>alert("Data Tersimpan")</script>';
            header('location:data_user.php');
        } else {
            echo '<script>alert("Data Gagal Tersimpan")</script>';
            die ("Gagal menginput data: ".mysqli_errno($conn)." - ".mysqli_error($conn));
        }
    }
    else {
        echo '<script>alert("Data Gagal Tersimpan")</script>';
        die ("Gagal menginput data: ".mysqli_errno($conn)." - ".mysqli_error($conn));
    }
}
?>