<?php
session_start();
include '../../config.php';
if(!isset ($_SESSION['nama']) ){
	header("Location:../../index.php");
}
if (isset($_POST['delete'])) {
	$id = $_POST['id_kategori'];
	$query = "DELETE FROM tb_kategori WHERE id_kategori='$id' ";
	$hasil = mysqli_query($conn, $query);
	if ($hasil== true) {
        header('Location: data_kategori.php');
	} else {
		echo '<script>alert("Data Gagal Tersimpan")</script>';
		die ("Gagal menginput data: ".mysqli_errno($conn)." - ".mysqli_error($conn));
	}
}
?>
