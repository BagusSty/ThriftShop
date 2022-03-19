<?php
session_start();
include '../config.php';
if(!isset ($_SESSION['nama'])){
    header("Location:../index.php");
}

if (isset($_POST['simpan'])) {
    $nama = $_POST['nama'];
    $kategori = $_POST['kategori'];
    $supplier = $_POST['supplier'];
    $stok = $_POST['stok'];
    $hrg_pokok = $_POST['harga_pokok'];
    $hrg_jual = $_POST['harga_jual'];
    $qry = "INSERT INTO tb_barang(nama_barang,id_kategori,id_supplier,stok,harga_pokok,harga_jual) VALUES ('$nama','$kategori',' $supplier', '$stok','$hrg_pokok','$hrg_jual' )";
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