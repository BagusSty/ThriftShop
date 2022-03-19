<?php
session_start();
include '../config.php';
if(!isset ($_SESSION['username'])){
    header("Location:../index.php");
}

if (isset($_POST['simpan'])) {
    $id = $_POST['id_user'];
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $nohp = $_POST['no_hp'];
    if ($_POST['jabatan']=='Pemilik') {
        $tipe_user = '1';
        $qry = "UPDATE tb_user SET nama='$nama', username='$username', no_hp='$nohp',  password='$password', tipe_user='$tipe_user' WHERE id_user='$id'";
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
        $tipe_user = '2';
         $qry = "UPDATE tb_user SET nama='$nama', username='$username', no_hp='$nohp',  password='$password', tipe_user='$tipe_user' WHERE id_user='$id'";
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
        $tipe_user = '3';
         $qry = "UPDATE tb_user SET nama='$nama', username='$username', no_hp='$nohp',  password='$password', tipe_user='$tipe_user' WHERE id_user='$id'";
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