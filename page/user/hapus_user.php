<?php
session_start();
include '../../config.php';
if(!isset ($_SESSION['nama']) ){
	header("Location:../../index.php");
}
if (isset($_POST['delete'])) {
	$id = $_POST['id_user'];
	$query = "DELETE FROM tb_user WHERE id_user='$id' ";
	$hasil = mysqli_query($conn, $query);
	if ($hasil== true) {
        header('Location: data_user.php');
	} else {
		echo '<script>alert("Data Gagal Tersimpan")</script>';
		die ("Gagal menginput data: ".mysqli_errno($conn)." - ".mysqli_error($conn));
	}
}
?>