<?php
session_start();
include '../../config.php';
if(!isset ($_SESSION['nama'])){
  header("Location:../../index.php");
}
if (!isset($_SESSION['cart']) && !isset($_POST['simpan'])) {
  header('Location: cart1.php');
} else {
  $cart = unserialize(serialize($_SESSION['cart']));
  $total_brg = 0;
  $total_bayar = 0;
  $id = $_POST['id_user'];
  $alamat = $_POST['alamat'];
  $pembayaran = $_POST['pembayaran'];
  $brg = mysqli_query($conn, "SELECT * FROM tb_barang");
  $dt_brg = $brg->fetch_assoc();
  $stok = $dt_brg['stok'];
  $waktu = date('Y-m-d H:i:s');
  $kode = 'TRS-'.date('dmy').rand(1,999999);

  for ($i=0; $i<count($cart); $i++) {
    $total_brg += $cart[$i]['pembelian'];
    $total_bayar += $cart[$i]['pembelian'] * $cart[$i]['harga'];
  }
  if ($stok>0) {
    // proses penyimpanan data
  $query = mysqli_query($conn, "INSERT INTO tb_transaksi(id_user,kode,alamat,pembayaran,waktu_pesan,batas_bayar,total_barang,total_bayar,status) VALUES ('$id','$kode','$alamat','$pembayaran','$waktu', '$waktu' + INTERVAL 7 DAY,'$total_brg','$total_bayar','Belum Dibayar')");

  $id_order = mysqli_insert_id($conn);

  for ($i=0; $i<count($cart); $i++) {
    $id_produk = $cart[$i]['id_produk'];
    $pembelian = $cart[$i]['pembelian'];
    $kurang = $stok-$pembelian;
    var_dump($kurang);

    $qry = mysqli_query($conn, "INSERT INTO tb_transaksi_detail(no_transaksi,id_barang,pembelian) VALUES ('$id_order','$id_produk','$pembelian')");
    if ($qry) {
         $update = mysqli_query($conn, "UPDATE tb_barang SET stok='$kurang' WHERE id_barang='$id_produk'");
    }
    // unset session
unset($_SESSION['cart']);
$_SESSION['pesan'] = "Pembelian sedang diproses, terimakasih.";
header('Location: beranda_user.php');
  }
} else {
    unset($_SESSION['cart']);
    $_SESSION['pesan'] = "Stok Habis";
    header('Location: beranda_user.php');
}
}