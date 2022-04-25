<?php
session_start();
include '../../config.php';
if(!isset ($_SESSION['nama']) ){
	header("Location:../../index.php");
}

if (isset($_POST['ya'])) {
	$no = $_POST['no'];
	$qry = "UPDATE tb_transaksi SET status='Sudah Dibayar' WHERE no_transaksi='$no'";
	$input = mysqli_query($conn,$qry);
	if ($input== true) {
		header('Location: invoice.php');
		echo '<script>alert("Pembayaran Terkonfirmasi")</script>';
	} else {
		echo '<script>alert("Pembayaran Gagal Terkonfirmasi")</script>';
		die ("Gagal menginput data: ".mysqli_errno($conn)." - ".mysqli_error($conn));
	}
} elseif (isset($_POST['batas']) == date('Y-m-d H:i:s')) {
	$no = $_POST['no'];
	$qry = "UPDATE tb_transaksi SET status='Kadaluarsa' WHERE no_transaksi='$no'";
	$input = mysqli_query($conn,$qry);
	if ($input== true) {
		header('Location: invoice.php');
		echo '<script>alert("Transaksi Kadaluarsa")</script>';
	} else {
		echo '<script>alert("Pembayaran Gagal Terkonfirmasi")</script>';
		die ("Gagal menginput data: ".mysqli_errno($conn)." - ".mysqli_error($conn));
	}
}
?>