<?php
session_start();
 include '../../config.php';
 if(!isset ($_SESSION['nama'])){
 	header("Location:../../index.php");
 }
if (!isset($_SESSION['cart'])) {
	header('Location: cart.php');
} else {
	$cart = unserialize(serialize($_SESSION['cart']));
	$total_item = 0;
	$total_bayar = 0;
    $waktu = date('Y-m-d H:i:s');
    $batas =  date('Y-m-d H:i:s') + 7*60*60*24;

	for ($i=0; $i<count($cart); $i++) {
		$total_item += $cart[$i]['nama_barang'];
		$total_bayar += $cart[$i]['harga'];
	}
	if (isset($_POST['simpan'])) {
		$id = $_POST['id_user'];
		$alamat = $_POST['alamat'];
		$pembayaran = $_POST['pembayaran'];
		$query = mysqli_query($conn, "INSERT INTO tb_transaksi(id_user,alamat,pembayaran,waktu_pesan,batas_bayar,total_barang,total_bayar,status) VALUES ('$id','$alamat','$pembayaran','$waktu', '$batas','$total_item','$total_bayar','Belum Dibayar')");

		$id_order = mysqli_insert_id($conn);
	}
	for ($i=0; $i<count($cart); $i++) {
		$id_barang = $cart[$i]['id_barang'];

		$query = mysqli_query($conn, "INSERT INTO tb_transaksi_detail (id_produk) VALUES ('$id_barang')");
	}
}
// unset session
unset($_SESSION['cart']);
$_SESSION['pesan'] = "Pembelian sedang diproses, terimakasih.";
header('Location: beranda_user.php');
?>