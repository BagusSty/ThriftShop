<?php
session_start();
include '../../config.php';
if(!isset ($_SESSION['nama']) ){
	header("Location:../../index.php");
}
if (isset($_POST['delete'])) {
	$id = $_POST['id_supplier'];
	$query = "DELETE FROM tb_supplier WHERE id_supplier='$id' ";
	$hasil = mysqli_query($conn, $query);
	if ($hasil== true) {
        header('Location: data_supplier.php');
	} else {
		echo '<script>alert("Data Gagal Tersimpan")</script>';
		die ("Gagal menginput data: ".mysqli_errno($conn)." - ".mysqli_error($conn));
	}
}
?>