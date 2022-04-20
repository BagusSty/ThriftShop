<?php
session_start();
include '../../config.php';
if(!isset ($_SESSION['nama']) ){
	header("Location:../../index.php");
}

if (isset($_POST['edit'])) {
	$id = $_POST['id_barang'];
	$nama = $_POST['nama_barang'];
	$kategori = $_POST['nama_kategori'];
	$filename = $_FILES['gambar']['name'];
	//mengatur ekstensi foto
	$ext = pathinfo($filename, PATHINFO_EXTENSION);
	$ekstensi_diperbolehkan = array('png','jpg');
	$file_tmp = $_FILES['gambar']['tmp_name'];
	if(in_array($ext, $ekstensi_diperbolehkan) === true) {
		move_uploaded_file($file_tmp, '../../assets/file/'.$filename);
		$qry = "UPDATE tb_barang SET nama_barang='$nama', id_kategori='$kategori', gambar='$filename' WHERE id_barang='$id'";
		$input = mysqli_query($conn,$qry);
		if ($input== true) {
			header('Location: data_barang.php');
			echo '<script>alert("Data Tersimpan")</script>';
		} else {
			echo '<script>alert("Data Gagal Tersimpan")</script>';
			die ("Gagal menginput data: ".mysqli_errno($conn)." - ".mysqli_error($conn));
		}
	}
}
?>