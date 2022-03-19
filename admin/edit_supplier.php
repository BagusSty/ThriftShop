<?php
session_start();
include '../config.php';
if(!isset ($_SESSION['nama'])){
    header("Location:../index.php");
}

if (isset($_POST['simpan'])) {
    $id = $_POST['id_supplier'];
    $nama = $_POST['nama'];
    $nohp = $_POST['no_hp'];
    $alamat = $_POST['alamat'];
    $qry = "UPDATE tb_supplier SET nama_supplier='$nama', no_hp_supplier='$nohp',  alamat_supplier='$alamat' WHERE id_supplier='$id'";
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