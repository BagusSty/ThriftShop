<?php
session_start();
include '../../config.php';
if(!isset ($_SESSION['nama']) ){
	header("Location:../../index.php");
}

if (isset($_POST['update'])) {
	$id = $_POST['id_kategori'];
	$kategori = $_POST['kategori'];
	$qry = "UPDATE tb_kategori SET nama_kategori='$kategori' WHERE id_kategori='$id'";
	$input = mysqli_query($conn,$qry);
	if ($input== true) {
		header('Location: data_kategori.php');
		echo '<script>alert("Data Tersimpan")</script>';
	} else {
		echo '<script>alert("Data Gagal Tersimpan")</script>';
		die ("Gagal menginput data: ".mysqli_errno($conn)." - ".mysqli_error($conn));
	}
}
?>