<?php
session_start();
include '../config.php';
if(!isset ($_SESSION['nama'])){
    header("Location:../index.php");
}

if (isset($_POST['simpan'])) {
    $id = $_POST['id_barang'];
    $stok = $_POST['stok'];
    $hrg_pokok = $_POST['harga_pokok'];
    $hrg_jual = $_POST['harga_jual'];
    $qry = "UPDATE tb_barang SET stok='$stok', harga_pokok='$hrg_pokok',  harga_jual='$hrg_jual' WHERE id_barang='$id'";
    $input = mysqli_query($conn,$qry);
    if ($input== true) {
        echo '<script>alert("Data Tersimpan")</script>';
        header('location:data_barang.php');
    } else {
        echo '<script>alert("Data Gagal Tersimpan")</script>';
        die ("Gagal menginput data: ".mysqli_errno($conn)." - ".mysqli_error($conn));
    }
}
?>