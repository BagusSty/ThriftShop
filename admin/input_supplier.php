<?php
session_start();
include '../config.php';
if(!isset ($_SESSION['username'])){
    header("Location:../index.php");
}

if (isset($_POST['simpan'])) {
    $nama = $_POST['nama'];
    $nohp = $_POST['no_hp'];
    $alamat = $_POST['alamat'];
    $qry = "INSERT INTO tb_supplier(nama_supplier,no_hp_supplier,alamat_supplier) VALUES ('$nama','$nohp','$alamat')";
    $input = mysqli_query($conn,$qry);
    if ($input== true) {
        echo '<script>alert("Data Tersimpan")</script>';
        header('location:data_supplier.php');
    } else {
        echo '<script>alert("Data Gagal Tersimpan")</script>';
        die ("Gagal menginput data: ".mysqli_errno($conn)." - ".mysqli_error($conn));
    }
}
?>