<?php
include '../config.php';
if(!isset ($_SESSION['nama'])){
	header("Location:../index.php");
}

if (isset($_GET['id'])) {
	$id = $_GET['id'];
	$query = "DELETE FROM tb_barang WHERE id_barang='$id' ";
	$hasil = mysqli_query($conn, $query);
	if(!$hasil){
		die ("Gagal menghapus data: ".mysqli_errno($conn)." - ".mysqli_error($conn));
	} else {
		header('location:data_barang.php');
	}
}
?>