<?php
include '../config.php';
if(!isset ($_SESSION['username'])){
    header("Location:../index.php");
}

if (isset($_GET['id'])) {
	$id = $_GET['id'];
	$query = "DELETE FROM tb_user WHERE id_user='$id' ";
	$hasil = mysqli_query($conn, $query);
	if(!$hasil){
		die ("Gagal menghapus data: ".mysqli_errno($conn)." - ".mysqli_error($conn));
	} else {
		header('location:data_user.php');
	}
}
?>