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
		$nama = $_POST['nama'];
		$noHp = $_POST['no_Hp'];
		$alamat = $_POST['alamat'];
		$query = mysqli_query($koneksi, "INSERT INTO tb_order VALUES (null,'$nama','$noHp','$alamat','$total_item', '$total_bayar', '" . date('Y-m-d') . "')");

		$id_order = mysqli_insert_id($koneksi);
	}
	for ($i=0; $i<count($cart); $i++) {
		$id_produk = $cart[$i]['id_produk'];
		$pembelian = $cart[$i]['pembelian'];

		$query = mysqli_query($koneksi, "INSERT INTO tb_detail_order (id_order, id_produk, pembelian) VALUES ('$id_order', '$id_produk', '$pembelian')");
	}
}
// unset session
unset($_SESSION['cart']);
$_SESSION['pesan'] = "Pembelian sedang diproses, terimakasih.";
header('Location: cart.php');
?>