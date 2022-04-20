<?php
session_start();
include '../../config.php';
if(!isset ($_SESSION['nama']) ){
	header("Location:../../index.php");
}
if (isset($_POST['delete'])) {
	$id = $_POST['id_barang'];
	$query = "DELETE FROM tb_barang WHERE id_barang='$id' ";
	$hasil = mysqli_query($conn, $query);
	if ($hasil== true) {
        header('Location: data_barang.php');
	} else {
		echo '<script>alert("Data Gagal Tersimpan")</script>';
		die ("Gagal menginput data: ".mysqli_errno($conn)." - ".mysqli_error($conn));
	}
}
?>
